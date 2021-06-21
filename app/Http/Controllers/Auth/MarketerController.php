<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Marketer;
use App\RealState;
use App\Request as AppRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class MarketerController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }


        if(Marketer::where('email',$email)->count() <= 0 ) return response( array( "message" => "Email number does not exist"  ), 400 );

        $user = Marketer::where('email',$email)->first();

        if(password_verify($password,$user->password)){
            // $user->last_login = Carbon::now();
            $user->save();


            if($user->office->is_active == false) {

                return response( array( "message" => "Your account has been suspended. Please contact administrator."  ), 400 );
            }

            if($user->office->expired_at < Carbon::now())
            {
                return response( array( "message" => "Your account has been suspended. Please contact administrator."  ), 400 );
            }



            return response( array( "message" => "Sign In Successful", "data" => [
                "marketer" => $user,

                // Below the user key passed as the second parameter sets the role
                // anyone with the auth token would have only user access rights
                "token" => $user->createToken('Personal Access Token',['marketer'])->accessToken
            ]  ), 200 );
        } else {
            return response( array( "message" => "wrong credentials invalid username or password." ), 400 );
        }
}



  public function logout (Request $request) {
    $token = $request->user()->token();
    $token->revoke();
    $response = ['message' => 'You have been successfully logged out!'];
    return response($response, 200);
}


public function ReportMarketer()
{

    $req = AppRequest::where("marketers_id", "=" ,auth()->user()->id)->get()->count();

    $real_state = RealState::where("creator", "=", auth()->user()->name)->get()->count();




    return response( array( "message" => "Report For Marketer", "data" => [

        "Request" => $req,
        "Real_State" => $real_state,

    ]  ), 200 );
}


public function notification(Request $request)
{
    $token = [];
    $id = $request->all()['id'];

    foreach ($id as $user) {
        $token[] = DB::table('marketers')->where('id', $user)
            ->get()->pluck('mobile_token')[0];
    }

    $url = 'https://fcm.googleapis.com/fcm/send';

    foreach ($token as $tok) {
        $notification = array('title' =>"" , 'text' => $request->all()['message']);
    $fields = array(
        'to' => $tok,
        'data' => $message = array(
            "title" => $request->all()['title'],
            "message" => $request->all()['message'],

        ),
        'notification' => $notification
    );

        $headers = array(
            'Authorization: key=*mykey*',
            'Content-type: Application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_exec($ch);
        curl_close($ch);
    }

    $res = ['error' => null, 'result' => "notification send"];

    return $res;
}
}
