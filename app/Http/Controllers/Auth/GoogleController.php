<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setRedirectUri(url('/auth/google/callback'));
        $client->addScope(Google_Service_People::USERINFO_PROFILE);
        $client->addScope(Google_Service_People::USERINFO_EMAIL);

        return redirect($client->createAuthUrl());
    }

    public function handleGoogleCallback()
    {
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(url('/auth/google/callback'));

        $token = $client->fetchAccessTokenWithAuthCode(request('code'));

        $client->setAccessToken($token['access_token']);

        $service = new Google_Service_People($client);

        $googleUser = $service->people->get('people/me', [
            'personFields' => 'names,emailAddresses',
        ]);

        // Check if the user already exists in the database
        $user = User::where('email', $googleUser->getEmail())->first();

        if (! $user) {
            // Create a new user account
            $user = new User();
            $user->name = $googleUser->getNames()[0]->getDisplayName();
            $user->email = $googleUser->getEmail();
            $user->password = bcrypt(Str::random(16));
            $user->save();
        }

        // Log the user in
        Auth::login($user);

        return redirect('/home');
    }
}
?>