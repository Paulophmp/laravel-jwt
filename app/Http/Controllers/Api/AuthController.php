<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function authenticate(Request $request)
    {
        $this->validateLogin($request);

        $credenciais = $this->credentials($request);

        $token = \JWTAuth::attempt($credenciais);
        return $this->responseToken($token);
    }

    private function responseToken($token)
    {
        return $token ? ['token' => $token] :
            response()->json([
                'error' => \Lang::get('auth.failed')
            ], 400);
    }

    public function logout()
    {
        \Auth::guard('api')->logout();

        return response()->json([], 204); //No content
    }

    public function refresh()
    {
        $token = \Auth::guard('api')->refresh();

        return ['token' => $token];
    }
}