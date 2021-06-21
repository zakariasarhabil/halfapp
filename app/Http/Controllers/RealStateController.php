<?php

namespace App\Http\Controllers;

use App\Http\Requests\RealState as RequestsRealState;
use App\image;
use App\RealState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class RealStateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $real_state = RealState::with('image')->take(1)->where("office_owners_id", "=" ,auth()->user()->id)->paginate(15);

        return $real_state;
    }

    public function indexmarketer()
    {
        $real_state = RealState::with('image')->take(1)->where("office_owners_id", "=" ,auth()->user()->office->id)->paginate(15);

        return $real_state;
    }

    /**
     * Show the form for crealing a new resource.
     *


    /**
     * Store a newly crealed resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsRealState $request)
    {

        $validatedData = $request->validated();

        $validatedData['creator'] = $request->user()->name;
        $validatedData['office_owners_id'] = $request->user()->id;

        $real_state = RealState::create($validatedData);

        if($request->hasFile('picture')) {

            $path = $request->file('picture')->store('picture');
            $ur = "https://halfapi.com/myapp/storage/app/public/";

            $image = new image();
            // $image->path = $path;
            $image->path = $path;
            $image->image_url =  $ur . $path;
            $image->name = $request->file('picture')->getClientOriginalName();
            $image->real_states_id = $real_state->id;
            // $image->path = Storage::url($path);

            $image->save();



        }

        return $real_state;


    }

    public function storemarketer(RequestsRealState $request)
    {

        $validatedData = $request->validated();

        $validatedData['creator'] = $request->user()->name;

        $validatedData['office_owners_id'] = $request->user()->office->id;

        $real_state = RealState::create($validatedData);
        if($request->hasFile('picture')) {

            $path = $request->file('picture')->store('picture');
            $ur = "https://halfapi.com/myapp/storage/app/public/";

            $image = new image();
            // $image->path = $path;
            $image->path = $path;
             $image->image_url =  $ur . $path;
            $image->name = $request->file('picture')->getClientOriginalName();
            $image->real_states_id = $real_state->id;
            // $image->path = Storage::url($path);

            $image->save();



        }
        return $real_state;


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = RealState::with('image')->findOrFail($id);
        return  response()->json([
            'real_state' => $admin,
        ]);
    }

    /**
     * Show the form for editing the specified resource.


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsRealState $request, $id)
    {
        $real_state = RealState::findOrfail($id);

        $validatedData = $request->validated();

        // $validatedData['creator'] = $request->user()->name;
        $validatedData['Edited_by'] = $request->user()->name;

        $real_state->fill($validatedData);
        $real_state->save();
        return  response()->json([
            'real_state' => $real_state,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $real_state = RealState::findOrFail($id);

        $files = $real_state->image()->pluck('path');
        foreach ($files as $file) {

            Storage::delete($file);
        }

        $real_state->delete();

        return 'Successfully deleted  Real State!';
    }

    public function DownloadPdf($id)
    {
        $real_state =  RealState::findOrFail($id);

        $data['id']  = $real_state->id;
        $data['creator']  = $real_state->creator;
         $data['type_offer'] = $real_state->type_offer;
         $data['type_RealState'] = $real_state->type_RealState;
          $data['space'] = $real_state->space;
          $data['price'] = $real_state->price;
          $data[ 'price_meter'] = $real_state->price_meter;
          $data['facade'] = $real_state->facade;
          $data['location'] = $real_state->location;
         $data['evaluation'] = $real_state->evaluation;
         $data[ 'age'] = $real_state->age;
         $data[ 'number_apartment'] = $real_state->number_apartment;
         $data[ 'furnished'] = $real_state->furnished;
         $data[ 'duplex'] = $real_state->duplex;
         $data[ 'driver_room'] = $real_state->driver_room;
         $data[ 'addition'] = $real_state->addition;
         $data[ 'cellar'] = $real_state->cellar;
         $data[ 'elevator'] = $real_state->elevator;
         $data[ 'magnifier'] = $real_state->magnifier;
         $data[ 'earth_type'] = $real_state->earth_type;
         $data[ 'annual_income'] = $real_state->annual_income;
         $data[ 'specification'] = $real_state->specification;
          $data['number_offices'] = $real_state->number_offices;
         $data[ 'type_owner'] = $real_state->type_owner;
         $data[ 'name_owner'] = $real_state->name_owner;
         $data['phone']  = $real_state->phone;
         $data['phone_two']  = $real_state->phone_two;
         $data['created_at'] = $real_state->created_at->format('Y-m-d');



		// $data = [
		// 	'foo' => 'bar'
		// ];
		$pdf = PDF::loadView('PdfRealState', $data);
		return $pdf->stream($real_state->id .'.pdf');



        // return view('PdfRealState', compact('real_state'));
    }


}
