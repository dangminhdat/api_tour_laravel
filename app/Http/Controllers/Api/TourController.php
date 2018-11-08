<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Services\TourService;

class TourController extends ApiController
{
    protected $tour_service;

    public function __construct(TourService $service)
    {
        $this->tour_service = $service;
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
        try
        {
            // all data tour
            $tour = $this->tour_service->paginate();

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($tour),
                'list' => $tour
            );
        } 
        catch(\Exception $e) {
            $code = 403;
            $message = "Access Denied Exception";
            $data = $e->getMessage();
        }
        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ], $code);
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
            if (!$request->hasFile('images')) {
                throw new \Exception("No choose images", 1);
            }
            $data = array(
                "name"          => $request->name,
                "number_days"   => $request->number_days,
                "date_created"  => now(),
                "item_tour"     => $request->item_tour,
                "discount"      => $request->discount,
                "programs"      => $request->programs,
                "note"          => $request->note,
                "deleted_at"    => false,
                "id_type_tour"  => $request->id_type_tour
            );
            // all data tour
            $tour = $this->tour_service->store($data);

            $code = 200;
            $message = "Success";
            $data = "Insert tour success";
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            // all data tour
            $tour = $this->tour_service->find($id);

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($tour),
                'list' => $tour
            );
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
        //
    }

    /**
     * Get list tour by location
     * @return [type] [description]
     */
    public function tour_by_location($id)
    {
        try
        {
            // all data tour by location
            $tour = $this->tour_service->tour_by_location($id);

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($tour),
                'list' => $tour
            );
        } 
        catch(\Exception $e) {
            $code = 403;
            $message = "Access Denied Exception";
            $data = $e->getMessage();
        }
        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ], $code);
    }

    /**
     * Get list tour by sales
     * @return [type] [description]
     */
    public function tour_by_sales()
    {
        try
        {
            // all data tour by location
            $tour = $this->tour_service->tour_by_sales();

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($tour),
                'list' => $tour
            );
        } 
        catch(\Exception $e) {
            $code = 403;
            $message = "Access Denied Exception";
            $data = $e->getMessage();
        }
        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ], $code);
    }

    /**
     * Get list tour of type
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function tour_of_type($id)
    {
        try
        {
            // all data tour by location
            $tour = $this->tour_service->tour_of_type($id);

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($tour),
                'list' => $tour
            );
        } 
        catch(\Exception $e) {
            $code = 403;
            $message = "Access Denied Exception";
            $data = $e->getMessage();
        }
        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ], $code);
    }
}
