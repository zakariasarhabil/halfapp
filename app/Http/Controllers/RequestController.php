<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request as RequestsRequest;
use App\Marketer;
use App\Request as AppRequest;
use Illuminate\Http\Request;
use Validator;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = AppRequest::where("office_owners_id", "=" ,auth()->user()->id)->with('office', 'marketer')->paginate(15);



        return $request;
    }

    public function new(){
        $request = AppRequest::where("office_owners_id", "=" ,auth()->user()->id)
                                ->where('status', "=" , "new")
                                ->with('office', 'marketer')->get();

        return $request;
    }

    public function send(){
        $request = AppRequest::where("office_owners_id", "=" ,auth()->user()->id)
                                ->where('status', "=" , "send")
                                ->with('office', 'marketer')->get();

        return $request;
    }

    public function Canceled(){
        $request = AppRequest::where("office_owners_id", "=" ,auth()->user()->id)
                                ->where('status', "=" , "Canceled")
                                ->with('office', 'marketer')->get();

        return $request;
    }

    public function Completed(){
        $request = AppRequest::where("office_owners_id", "=" ,auth()->user()->id)
                                ->where('status', "=" , "Completed")
                                ->with('office', 'marketer')->get();

        return $request;
    }



    public function indexmarketer()
    {
        $request = AppRequest::where("marketers_id", "=" ,auth()->user()->id)->paginate(15);

        return $request;
    }

    public function Canceledmarketer(){
        $request = AppRequest::where("marketers_id", "=" ,auth()->user()->id)
                                ->where('status', "=" , "Canceled")->get();

        return $request;
    }
    public function sendmarketer(){
        $request = AppRequest::where("marketers_id", "=" ,auth()->user()->id)
                                ->where('status', "=" , "send")->get();

        return $request;
    }
    public function Completedmarketer(){
        $request = AppRequest::where("marketers_id", "=" ,auth()->user()->id)
                                ->where('status', "=" , "Completed")->get();

        return $request;
    }

    public function newmarketer(){
        $request = AppRequest::where("marketers_id", "=" ,auth()->user()->id)
                                ->where('status', "=" , "new")->get();

        return $request;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['office_owners_id'] = $request->user()->id;

        $request = AppRequest::create($validatedData);

        return $request;




    }

    public function storemarketer(RequestsRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['marketers_id'] = $request->user()->id;
        $validatedData['office_owners_id'] = $request->user()->office->id;

        $request = AppRequest::create($validatedData);

        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = AppRequest::with('office', 'marketer')->findOrFail($id);
        return $admin;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsRequest $request, $id)
    {
        $req = AppRequest::findOrfail($id);

        $validatedData = $request->validated();
        $req->fill($validatedData);
        $req->save();

        return $req;

    }

    public function updateStatusRequest(Request $request, $id)
    {
        $req = AppRequest::findOrfail($id);
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:new,send,Canceled,Completed',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $req->status = $request->status;
        $req->save();

        return $req;

    }

    public function ChangeRequestToAnotherMareketer(Request $request, $id)
    {

        $req = AppRequest::findOrfail($id);
       $mark = $request->marketers_id;

       $validator = Validator::make($request->all(), [
        'marketers_id' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json(['error'=>$validator->errors()], 401);
    }

        if(Marketer::where('id',$mark)->count() <= 0 ) return response( array( "message" => "this marketer not found"  ), 400 );


            $req->marketers_id = $request->marketers_id;
            $req->save();



        return $req;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $req = AppRequest::findOrfail($id);
        $req->delete();
        return 'Successfully deleted  Request!';
    }
}
