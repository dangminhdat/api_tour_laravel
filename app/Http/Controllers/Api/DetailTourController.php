<?php

namespace App\Http\Controllers\Api;

use Core\Services\DetailTourService;
use Illuminate\Http\Request;

class DetailTourController extends ApiController
{
    protected $detail_service;

    public function __construct(DetailTourService $service)
    {
        $this->detail_service = $service;
        // check login
        $this->middleware('check_login', ['only' => [ 'store', 'update', 'destroy' ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $data = [
                "date_depart"   => $request->date_depart,
                "price_adults"  => $request->price_adults,
                "price_childs"  => $request->price_childs,
                "time_depart"   => $request->time_depart,
                "address_depart"=> $request->address_depart,
                "slot"          => $request->slot,
                "booked"        => 0,
                "deleted_at"    => false,
                "id_guide"      => $request->id_guide,
                "id_tour"       => $request->id_tour,
            ];

            if (!empty($request->id_hotel)) {
                $data['id_hotel'] = $request->id_hotel;
            }

            $detail_tour = $this->detail_service->store($data);
            
            $code = 200;
            $message = "Success!";
            $data = "Insert detail tour success";
        }
        catch(\Exception $e) {
            $code = 403;
            $message = "Access Denied Exception";
            $data = null;
        }

        return response()->json([
            "result_code"   => $code,
            "result_message"=> $message,
            "data"          => $data
        ], $code);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try
        {
            // all data tour
            $tour = $this->detail_service->find($id);

            $code = 200;
            $message = "Success";
            $data = $tour;
        } 
        catch(\Exception $e) {
            $code = 403;
            $message = "Access Denied Exception";
            $data = null;
        }
        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ], $code);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            // all data tour
            $tour = $this->detail_service->update($id, ["deleted_at" => true]);

            $code = 200;
            $message = "Success";
            $data = "Delete detail tour success!";
        } 
        catch(\Exception $e) {
            $code = 403;
            $message = "Access Denied Exception";
            $data = null;
        }
        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ], $code);
    }

    public function detail_day_other($id)
    {
        try
        {
            // all data tour
            $tour = $this->detail_service->detail_day_other($id);

            $code = 200;
            $message = "Success";
            $data = $tour;
        } 
        catch(\Exception $e) {
            $code = 403;
            $message = "Access Denied Exception";
            $data = null;
        }
        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ], $code);
    }
}
