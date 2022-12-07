<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
/* use App\Helpers\JwtAuth;
 */use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Laravel\SerializableClosure\Serializers\Signed;
use Tymon\JWTAuth\Facades\JwtAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Payload;

class LoginUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $key;

    public function __construct()
    {
        $this->key = 'esta_es_mi_clave_secreta_del_proyecto_final_daw';
    }

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->firstOrFail();
        try{
            if(!$getToken=JWTAuth::attempt($credentials)){
                return response()->json([
                    'error' => 'invalid credentials'
                ], 400);
            }
        }catch(JWTException $exception){
            return response()->json([
                'error' => 'not token available' . $exception
            ], 500);
        }

        auth()->login($user, true);
        $jwt = new JWTAuth();
        if($jwt::user() && $request->authorize()){
            $jwt = new JWTAuth();
            //Comprobar si son correctas.
            $signup = false;
            if(is_object($user)){
                $signup = true;
            }

        /* if ($token = JWTAuth::attempt($credentials)) {
            return $this->respondWithToken($token);
        } */

            //Generar el token con los datos del usuario identificado.
            if($signup){
                $token = array(
                    'sub'         => $user->id,
                    'email'       => $user->email,
                    'name'        => $user->name,
                    'surname'     => $user->surname,
                    'iat'         => time(),
                    'exp'         => time() + 60 * 60
                );

                /* $jwt = JwtAuth::encode($getToken, $this->key, 'HS256'); */

                /* $publicKeyURL = 'https://www.googleapis.com/robot/v1/metadata/x509/securetoken@system.  gserviceaccount.com';
                $key = json_decode(file_get_contents($publicKeyURL), true);
                $decoded = JWTAuth::decode($jwt, $key, array('RS256')); */

                if(is_null($getToken)){
                    $data = $token;
                }else{
                    $data = $getToken;
                }
            }else {
                $data = array(
                    'status'   => 'error',
                    'message'  => 'Login incorrecto'
                );
            }
            //Devolver los datos decodificados o el token en función de un parámetro.
            return $this->respondWithToken($data, $user);
        }
        /* $data = [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
            'token' => $token,
            'image' => $user->image,
            'role'  => $user->role
        ];
        return response()->json($data, 200); */
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 60 * 60
        ]);
    }

}
