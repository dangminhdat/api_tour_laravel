<?php

namespace App\Http\Controllers\Api;

use Core\Services\DetailTourService;
use Illuminate\Http\Request;

/**
 * Class DetailTourController
 */
class DetailTourController extends ApiController
{
    /**
     * protected $detail_service
     */
    protected $detail_service;

    /**
     * [__construct description]
     * @param DetailTourService $service [description]
     */
    public function __construct(DetailTourService $service)
    {
        $this->detail_service = $service;
        // check login
        $this->middleware('check_login', ['only' => [ 'store', 'update', 'destroy' ]]);
    }

    /**
     * Save detail tour
     * @param Request $request
     * @return object
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
     * Show detail tour
     * @param int $id
     * @return object
     */
    public function show($id)
    {
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
     * Update detail tour
     * @param Request $request
     * @param int $id
     * @return object
     */
    public function update(Request $request, $id)
    {
        try
        {
            $details = $this->detail_service->get($id);

            if (!$details){
                throw new \Exception("Not found", 1);
            }

            $data = [
                "date_depart"   => $request->date_depart?$request->date_depart:$details->date_depart,
                "price_adults"  => $request->price_adults?$request->price_adults:$details->price_adults,
                "price_childs"  => $request->price_childs?$request->price_childs:$details->price_childs,
                "time_depart"   => $request->time_depart?$request->time_depart:$details->time_depart,
                "address_depart"=> $request->address_depart?$request->address_depart:$details->address_depart,
                "slot"          => $request->slot?$request->slot:$details->slot,
                "id_guide"      => $request->id_guide?$request->id_guide:$details->id_guide,
                "id_tour"       => $request->id_tour?$request->id_tour:$details->id_tour,
            ];

            if (!empty($request->id_hotel)) {
                $data['id_hotel'] = $request->id_hotel;
            }
            $detail_tour = $this->detail_service->update($id, $data);
            
            $code = 200;
            $message = "Success!";
            $data = "Update detail tour success";
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
     * Delete detail tour
     * @param int $id
     * @return object
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

    /**
     * Detail tour of day other
     * @param int $id
     * @return object
     */
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

    /**
     * Change order booked
     * @param Request $request
     * @return object
     */
    public function change_order(Request $request)
    {
        try
        {
            // all data tour
            $tour = $this->detail_service->change_order($request->id_detail_tour);

            $code = 200;
            $message = "Success";
            $data = "Success!";
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
     * Get detail tour
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        try
        {
            $detail = $this->detail_service->get($id);

            $code = 200;
            $message = "Success";
            $data = $detail;
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
