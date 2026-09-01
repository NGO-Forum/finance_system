<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MicrosoftAuthController extends Controller
{
    /**
     * Redirect user to Microsoft Login
     */
    public function redirect()
    {
        $tenantId = env('AZURE_TENANT_ID', 'common');
        $clientId = env('AZURE_CLIENT_ID');
        $redirectUri = env('AZURE_REDIRECT_URI');

        if (!$clientId) {
            return redirect()
                ->route('login')
                ->with('error', 'Microsoft Login is not configured.');
        }

        $state = Str::random(40);

        Session::put('oauth_state', $state);

        $query = http_build_query([
            'client_id' => $clientId,
            'response_type' => 'code',
            'redirect_uri' => $redirectUri,
            'response_mode' => 'query',
            'scope' => 'openid profile email User.Read',
            'state' => $state,
        ]);


        return redirect(
            "https://login.microsoftonline.com/{$tenantId}/oauth2/v2.0/authorize?{$query}"
        );
    }

    /**
     * Microsoft Callback
     */
    public function callback(Request $request)
    {
        if ($request->has('error')) {

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    $request->input('error_description', 'Microsoft authentication failed.')
                );
        }

        if ($request->input('state') !== Session::pull('oauth_state')) {

            return redirect()
                ->route('login')
                ->with('error', 'Invalid authentication state.');
        }

        $code = $request->input('code');

        if (!$code) {

            return redirect()
                ->route('login')
                ->with('error', 'Authorization code not found.');
        }

        $tenantId = env('AZURE_TENANT_ID', 'common');

        $tokenResponse = Http::asForm()->post(
            "https://login.microsoftonline.com/{$tenantId}/oauth2/v2.0/token",
            [
                'client_id' => env('AZURE_CLIENT_ID'),
                'client_secret' => env('AZURE_CLIENT_SECRET'),
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => env('AZURE_REDIRECT_URI'),
            ]
        );

        if ($tokenResponse->failed()) {

            return redirect()
                ->route('login')
                ->with('error', 'Unable to obtain Microsoft access token.');
        }

        $accessToken = $tokenResponse['access_token'];

        $graphResponse = Http::withToken($accessToken)
            ->get('https://graph.microsoft.com/v1.0/me');

        if ($graphResponse->failed()) {

            return redirect()
                ->route('login')
                ->with('error', 'Unable to retrieve Microsoft profile.');
        }

        $microsoftUser = $graphResponse->json();

        $email = strtolower(
            $microsoftUser['mail']
                ?? $microsoftUser['userPrincipalName']
                ?? ''
        );

        if (!$email) {

            return redirect()
                ->route('login')
                ->with('error', 'Microsoft account does not contain an email address.');
        }

        /**
         * Find Local User
         */
        $user = User::whereRaw('LOWER(email)=?', [$email])->first();

        if (!$user) {

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    "Your Microsoft account ({$email}) is not registered."
                );
        }

        /**
         * Update Name
         */
        if (empty($user->name) && !empty($microsoftUser['displayName'])) {

            $user->update([
                'name' => $microsoftUser['displayName'],
            ]);
        }

        /**
         * Login User
         */
        Auth::login($user, true);

        $request->session()->regenerate();

        if (in_array($user->role?->name, ['Admin', 'Finance'])) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('dashboard');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
