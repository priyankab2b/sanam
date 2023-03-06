<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Google\Client;
use Google_Client;
use Google_Service_PeopleService;
use Google_Service_PlusService;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setRedirectUri(url('/auth/google/callback'));
        $client->addScope(Google_Service_PeopleService::USERINFO_PROFILE);
        $client->addScope(Google_Service_PeopleService::USERINFO_EMAIL);

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

        // dd($client);
        
        $service = new Google_Service_PeopleService($client);

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

    public function handleGoogleLogin(Request $request)
    {
        $client = new Client(['client_id' => config('google.client_id')]);
        $payload = $client->verifyIdToken($request->input('id_token'));

        if ($payload) {
            $googleUser = $client->getAccessToken()['id_token'];
            $user = User::where('email', $payload['email'])->first();

            if (!$user) {
                $user = new User();
                $user->name = $payload['name'];
                $user->email = $payload['email'];
                $user->password = bcrypt(str_random(16));
                $user->save();
            }

            auth()->login($user);

            return redirect('/home');
        } else {
            return redirect('/login')->withErrors(['google' => 'Google login failed']);
        }
    }


}
?>