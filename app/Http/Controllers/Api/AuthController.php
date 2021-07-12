<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;

class AuthController extends Controller
{

    public function user(Request $request) {

        return response()->json(Auth::user(), 200);
    }

    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        try {
            //var_dump($request); exit;
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);

            return $response->getBody();

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            
            if ($e->getCode() === 400 || $e->getCode() === 401) {
                return response()->json('Sus datos de acceso son incorrrectos. ', $e->getCode());
            }

            return response()->json('Ocurrió un error en el servidor. ', $e->getCode());
        }
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        
        return response()->json('Logged out successfully', 200);
    }

}