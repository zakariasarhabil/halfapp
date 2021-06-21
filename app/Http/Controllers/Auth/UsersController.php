<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Marketer;
use App\OfficeOwner;
use App\RealState;
use App\Request as AppRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class UsersController extends Controller
{
//     public function register(Request $request)
//     {
//         $validator = Validator::make($request->all(), [
//             'name' => 'required',
//             'email' => 'required|email|unique:users',
//             'password' => 'required',
//             'password_confirmation' => 'required|same:password',
//         ]);
// if ($validator->fails()) {
//             return response()->json(['error'=>$validator->errors()], 401);
//         }


// $input = $request->all();
//         $input['password'] = bcrypt($input['password']);
//         $user = User::create($input);
//         $success['token'] =  $user->createToken('users')-> accessToken;
//         $success['name'] =  $user->name;
//             return response()->json(['success'=>$success]);
//     }



//     public function login(Request $request)
//     {
//         $email = $request->input('email');
//         $password = $request->input('password');

//         $validator = Validator::make($request->all(), [

//             'email' => 'required|email',
//             'password' => 'required',

//         ]);
//         if ($validator->fails()) {
//             return response()->json(['error'=>$validator->errors()], 401);
//         }


//         if(User::where('email',$email)->count() <= 0 ) return response( array( "message" => "Email number does not exist"  ), 400 );

//         $user = User::where('email',$email)->first();

//         if(password_verify($password,$user->password)){
//             // $user->last_login = Carbon::now();
//             $user->save();
//             return response( array( "message" => "Sign In Successful", "data" => [
//                 "users" => $user,

//                 // Below the user key passed as the second parameter sets the role
//                 // anyone with the auth token would have only user access rights
//                 "token" => $user->createToken('Personal Access Token',['users'])->accessToken
//             ]  ), 200 );
//         } else {
//             return response( array( "message" => "wrong credentials invalid username or password." ), 400 );
//         }
// }

// public function logout (Request $request) {
//     $token = $request->user()->token();
//     $token->revoke();
//     $response = ['message' => 'You have been successfully logged out!'];
//     return response($response, 200);
// }



    // public function AddAdmin(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required',

    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json(['error'=>$validator->errors()], 401);
    //     }


    //     $input = $request->all();
    //     $input['password'] = bcrypt($input['password']);
    //     $user = User::create($input);
    //     // $success['token'] =  $user->createToken('users')-> accessToken;
    //     $success['name'] =  $user->name;
    //         return response()->json([
    //             'success'=>$success,
    //             'Successfully created admin'
    //         ]);
    // }

    public function alladmin()
    {
        return view(
            'dashbord.alladmin',
            [
                'alladmin' => User::get(),
            ]
            );

    }

    public function showadmin($id)
    {
        $admin = User::findOrFail($id);
        return $admin;
    }


    public function destroyAdmin($id, Request $request)
    {
        User::destroy($id);
        $request->session()->flash('deleteadmin', 'Successfully deleted Admin!');
        return redirect()->route('alladmin');
    }
    public function AddAdmin(Request $request)
    {
        // dd($request->expired_at);
        $validatedData = $request->validate( [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'



        ]);


        $input = new User();
        $input->name = $request->name;
        $input->email = $request->email;
        $input->password = bcrypt($request->password);


        $input->save();
        $request->session()->flash('addadmin', 'Successfully created Admin!');
        return redirect()->back();


    }


    public function AddOfficeOwner(Request $request)
    {
        // dd($request->expired_at);
        $validatedData = $request->validate( [
            'name' => 'required',
            'email' => 'required|email|unique:office_owners',
            'password' => 'required',
            'expired_at' => 'required',
            'voucher' => 'image'


        ]);
        // if ($validator->fails()) {
        //     return response()->json(['error'=>$validator->errors()], 401);
        // }

        $input = new OfficeOwner();
        $input->name = $request->name;
        $input->email = $request->email;
        $input->password = bcrypt($request->password);
        $input->expired_at = Carbon::createFromFormat('d/m/Y', $request->expired_at);

        if($request->hasFile('voucher')) {

           
            $path = $request->file('voucher')->store('voucher');

            $input->voucher = ($path);

        }
        $input->save();
        $request->session()->flash('addoffice', 'Successfully created OfficeOwner!');
        return redirect()->back();

        // $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        // $user = OfficeOwner::create($input);
        // $success['token'] =  $user->createToken('users')-> accessToken;
        // $success['name'] =  $input->name;
        //     return response()->json([
        //         'success'=>$success,
        //         'Successfully created OfficeOwner!'
        //     ]);
    }
    public function alloffice()
    {
        return view(
            'dashbord.alloffice',
            [
               'alloffice' => OfficeOwner::orderBy('created_at', 'desc')->paginate(7),
            ]
        );


        // $admin = OfficeOwner::with('marketer')->get();
        /* $stand = Stand::all(); */
        /* ->where("user_id", "=",auth()->user()->id) */

        // return  response()->json([
        //     'office' => $admin,
        // ]);
    }
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);

        $searchinput = $request->search;

        $filteredUsers = OfficeOwner::where('name', 'like', '%' . $searchinput . '%')
                                ->orwhere('name', 'like', '%' . $searchinput . '%')->paginate(7);

            if ($filteredUsers->count()) {
                return view('dashbord.alloffice')->with([

                    'alloffice' => $filteredUsers
                ]);
            } else {
                return redirect()->back()->with('status', 'search failed please try again');
            }

    }

    public function showoffice($id)
    {
        $office = OfficeOwner::findOrFail($id);
        $marketer = $office->marketer()->count();
        $real_state = $office->realstate()->count();
        $req = $office->request()->count();
        return view(
            'dashbord.showoffice',
            [
                'office' =>  $office,
                'marketer' => $marketer,
                'real_state' => $real_state,
                'req' => $req
            ]
            );

        // $admin = OfficeOwner::with('marketer')->findOrFail($id);
        // return  response()->json([
        //     'office' => $admin,
        // ]);
    }

    public function showmarketer($id)
    {
        $admin = Marketer::with('office')->findOrFail($id);
        return  response()->json([
            'marketers' => $admin,
        ]);
    }

    public function allmarketer()
    {
        $admin = Marketer::with('office')->get();
        /* $stand = Stand::all(); */
        /* ->where("user_id", "=",auth()->user()->id) */

        return  response()->json([
            'marketers' => $admin,
        ]);
    }


    public function destroyoffice($id, Request $request)
    {
        $office = OfficeOwner::findOrFail($id);
        // $productImage = str_replace('http://localhost:8000/storage/', '', $office->voucher);


        $productImage = str_replace(env('APP_URL') . '/storage/', '', $office->voucher);

        Storage::delete($productImage);


        // $real_state = RealState::where('office_owners_id', "=" , $id)->get();

        // $files = $real_state->image()->pluck('path');
        // foreach ($files as $file) {

        //     Storage::delete($file);
        // }

        $office->delete();
        $request->session()->flash('deleteoffice', 'Successfully deleted OfficeOwner!');
        return redirect()->route('alloffice');
        // Storage::delete($office->voucher);
    }

    public function updateStatusOffice($id)
    {
        $office = OfficeOwner::findOrFail($id);

        if($office->is_active == true) {
            $office->is_active = false;
        }

        elseif( $office->is_active == false) {
           $office->is_active = true;
       }

        $office->save();
        return redirect()->back();
    }

    public function ReportAdmin()
    {
        return view(
            'dashbord.layout.sidebar',
            [
               'office' => OfficeOwner::get()->count(),
               'marketer' => Marketer::get()->count(),
               'real_state' => RealState::get()->count(),
               'req' => AppRequest::get()->count(),

            ]
        );

        // $office = OfficeOwner::get()->count();
        // $marketer = Marketer::get()->count();
        // $real_state = RealState::get()->count();
        // $req = AppRequest::get()->count();


        // return response( array( "message" => "Report For Admin", "data" => [
        //     "office" => $office,
        //     "Marketers" => $marketer,
        //     "Real_State" => $real_state,
        //     "request" => $req,
        // ]  ), 200 );
    }

    public function ReportAdminForOne($id)
    {

        $office = OfficeOwner::findOrFail($id);

        $marketer = $office->marketer()->count();
        $real_state = $office->realstate()->count();
        $req = $office->request()->count();

        return response( array( "message" => "Report For Admin", "data" => [
            "office" => $office->name,
            "Marketers" => $marketer,
            "Real_State" => $real_state,
            "request" => $req,
        ]  ), 200 );
    }


}
