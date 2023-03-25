<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JwtAuth;
use Illuminate\Support\Facades\Auth;
use App\Http\Providers\AppServiceProvider;

class EmailController extends Controller
{

    public function sendEmail(Request $request){
        $data = $request->all();
        app()->instance('data', $data);
        $user = $request['user'];
        $products = $request['products'];
        $total = $request['total'];

        if($data){
            $_POST['user'] = $user;
            $_POST['products'] = $products;
            $_POST['total'] = $total;

            Mail::send('emails.email', $data, function ($message) use ($data) {
                $message->to('drlcoco@hotmail.com', $data['user']['name'])
                ->subject("Drive-Electric");
              });

              return response()->json([
                'Success' => 'Excelente email enviado a ',
                'code' => '200'
              ],200);
        }else{
            return response()->json([
                'Error' => 'Error, email no enviado..',
                'code' => '400',
              ],400);
        }
    }
}
