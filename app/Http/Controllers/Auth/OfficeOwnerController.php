<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Marketer;
use App\OfficeOwner;
use App\RealState;
use App\Request as AppRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class OfficeOwnerController extends Controller
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


        if(OfficeOwner::where('email',$email)->count() <= 0 ) return response( array( "message" => "Email number does not exist"  ), 400 );



        $user = OfficeOwner::where('email',$email)->first();



        if(password_verify($password,$user->password)){
            // $user->last_login = Carbon::now();
            $user->save();

            if($user->is_active == false) {

                return response( array( "message" => "Your account has been suspended. Please contact administrator."  ), 400 );
            }


            if($user->expired_at < Carbon::now())
            {
                return response( array( "message" => "Your account has been suspended. Please contact administrator."  ), 400 );
            }



            return response( array( "message" => "Sign In Successful", "data" => [
                "officeowner" => $user,

                // Below the user key passed as the second parameter sets the role
                // anyone with the auth token would have only user access rights
                "token" => $user->createToken('Personal Access Token',['officeowner'])->accessToken
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




  public function AddMarketer(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'name' => 'required',
          'email' => 'required|email|unique:marketers',
          'password' => 'required',

      ]);
      if ($validator->fails()) {
          return response()->json(['error'=>$validator->errors()], 401);
      }


      $input = new Marketer();
      $input->name = $request->name;
      $input->email = $request->email;
      $input->password = bcrypt($request->password);
      $input->office_owners_id = $request->user()->id;
      $input->save();

      $success['name'] =  $input->name;
          return response()->json([
              'success'=>$success,
              'Successfully created Marketer!'
          ]);
  }

  public function destroymarketer($id)
  {
      Marketer::destroy($id);
      return 'Successfully deleted  Marketer!';
  }

  public function allmarketer()
  {
      $admin = Marketer::where("office_owners_id", "=" ,auth()->user()->id)->get();
      return  response()->json([
        'marketers' => $admin,
    ]);
      /* $stand = Stand::all(); */
      /* ->where("user_id", "=",auth()->user()->id) */


  }

  public function showmarketer($id)
  {
      $admin = Marketer::where("office_owners_id", "=" ,auth()->user()->id)->findOrFail($id);
      return  response()->json([
        'marketer' => $admin,
    ]);
  }




public function ReportOffice()
{


    $marketer = Marketer::where("office_owners_id", "=" ,auth()->user()->id)->get()->count();
    $req = AppRequest::where("office_owners_id", "=" ,auth()->user()->id)->get()->count();

    $real_state = RealState::where("office_owners_id", "=" ,auth()->user()->id)->get()->count();


    return response( array( "message" => "Report For Office Owners", "data" => [
        "office" => auth()->user()->name,
        "Marketers" => $marketer,
        "Real_State" => $real_state,
        "request" => $req,
    ]  ), 200 );
}

public function ReportOfficeOne($id)
{


    $marketer = Marketer::where("office_owners_id", "=" ,auth()->user()->id)->findOrFail($id);
    $req = $marketer->request()->count();
    $real_state = RealState::where("creator", "=", $marketer->name)->get()->count();

    return response( array( "message" => "Report For Office Owners", "data" => [
        // "office" => auth()->user()->name,
        "Marketers" => $marketer->name,
        "request" => $req,
        "Real States" => $real_state,
    ]  ), 200 );
}

public function notification(Request $request)
{
    $token = [];
    $id = $request->all()['id'];

    foreach ($id as $user) {
        $token[] = DB::table('office_owners')->where('id', $user)
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


