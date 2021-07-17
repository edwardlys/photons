<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AccountService
{
    /**
     * Creates an account with user credentials
     *
     * @param string $name 
     * @param string $email
     * @param string $password
     * 
     * @return User|null
     */
    public function createAccount(string $name, string $email, string $password)
    {
        try {
            return User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password)
            ]);
        } catch (\Exception $e) {
            Log::error('Unable to create user');

            return null;
        }
    }

    /**
     * Request token for the following email and password
     *
     * @param string $email
     * @param string $password
     * 
     * @return array|null
     */
    public function requestToken(string $email, string $password)
    {
        try {
            $oauthResponse = Http::asForm()->post(env('PASSPORT_HOST') . '/oauth/token', [
                'grant_type' => 'password',
                'client_id' => env('PASSPORT_CLIENT_ID'),
                'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                'username' => $email,
                'password' => $password,
                'scope' => '',
            ]);
        } catch (\Exception $e) {
            Log::error('Server unable to validate credentials at the moment via Passport.');
            Log::error(json_encode($e->getMessage()));

            return null;
        }
        
        if ($oauthResponse->getStatusCode() == 200) {
            return $oauthResponse->json();
        }

        return null;
    }
}