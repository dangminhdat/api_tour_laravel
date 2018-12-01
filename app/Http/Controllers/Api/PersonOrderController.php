<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Services\PersonOrderService;
use JWTAuth;

class PersonOrderController extends ApiController
{
    protected $person_order_service;

    public function __construct(PersonOrderService $service)
    {
        $this->person_order_service = $service;
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
            $person_order = $this->person_order_service->paginate();

            $code = 200;
            $message = "Success!";
            $data = array(
                "total" => count($person_order),
                "list" => $person_order
            );
        }
        catch(\Exception $e) {
            $code = 403;
            $message = "Something error!!!";
            $data = null;
        }

        return response()->json([
            "result_code" => $code,
            "result_message" => $message,
            "data" => $data
        ], $code);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            $authorization = $request->header('authorization');

            JWTAuth::setToken($authorization);

            $profile = JWTAuth::authenticate();

            $data = [
                "name"          => $request->name,
                "email"         => $request->email,
                "phone"         => $request->phone,
                "address"       => $request->address,
                "note"          => $request->note,
                "num_adults"    => $request->num_adults,
                "num_childs"    => $request->num_childs,
                "date_ordered"  => date("Y-m-d"),
                "deleted_at"    => false,
                "id_detail_tour"=> $request->id_detail_tour,
                "id_user"       => $profile->id
            ];
            $person_order = $this->person_order_service->store($data);

            $code = 200;
            $message = "Success!";
            $data = "Insert success!";
        }
        catch(\Exception $e) {
            $code = 403;
            $message = "Something error!!!";
            $data = $e->getMessage();
        }

        return response()->json([
            "result_code" => $code,
            "result_message" => $message,
            "data" => $data
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
            $person_order = $this->person_order_service->find($id);

            if (!$person_order) {
                throw new \Exception("Not found", 1);
            }

            $code = 200;
            $message = "Success!";
            $data = $person_order;
        }
        catch(\Exception $e) {
            $code = 403;
            $message = "Something error!!!";
            $data = null;
        }

        return response()->json([
            "result_code" => $code,
            "result_message" => $message,
            "data" => $data
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
        try
        {
            $order = $this->person_order_service->find($id);

            if (!$order) {
                throw new \Exception("Not found", 1);
            }

            $data = [
                "name"          => $request->name?$request->name:$order->name,
                "email"         => $request->email?$request->email:$order->email,
                "phone"         => $request->phone?$request->phone:$order->phone,
                "address"       => $request->address?$request->address:$order->address,
                "note"          => $request->note?$request->note:$order->note,
                "num_adults"    => $request->num_adults?$request->num_adults:$order->num_adults,
                "num_childs"    => $request->num_childs?$request->num_childs:$order->num_childs,
                "date_ordered"  => date("Y-m-d")
            ];
            $person_order = $this->person_order_service->update($id, $data);

            $code = 200;
            $message = "Success!";
            $data = "Update success!";
        }
        catch(\Exception $e) {
            $code = 403;
            $message = "Something error!!!";
            $data = $e->getMessage();
        }

        return response()->json([
            "result_code" => $code,
            "result_message" => $message,
            "data" => $data
        ], $code);
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
            $person_order = $this->person_order_service->update($id, ['deleted_at' => true]);

            $code = 200;
            $message = "Success!";
            $data = "Delete success!";
        }
        catch(\Exception $e) {
            $code = 403;
            $message = "Something error!!!";
            $data = null;
        }

        return response()->json([
            "result_code" => $code,
            "result_message" => $message,
            "data" => $data
        ], $code);
    }

    public function get_tour_of_user(Request $request)
    {
        try
        {
            $authorization = $request->header('authorization');

            JWTAuth::setToken($authorization);

            $profile = JWTAuth::authenticate();

            $person_order = $this->person_order_service->get_tour_of_user($profile->id);

            $code = 200;
            $message = "Success!";
            $data = array(
                "total" => count($person_order),
                "list" => $person_order
            );
        }
        catch(\Exception $e) {
            $code = 403;
            $message = "Something error!!!";
            $data = $e->getMessage();
        }

        return response()->json([
            "result_code" => $code,
            "result_message" => $message,
            "data" => $data
        ], $code);
    }

    public function active_order(Request $request)
    {
        try
        {
            $order = $this->person_order_service->find($request->id);

            if (!$order) {
                throw new \Exception("Not found", 1);
            }

            $person_order = $this->person_order_service->update($order->id, ['status' => 2]);

            if (!$person_order) {
                throw new \Exception("Not found", 1);
            }

            $code = 200;
            $message = "Success!";
            $data = "Active order success!";
        }
        catch(\Exception $e) {
            $code = 403;
            $message = "Something error!!!";
            $data = $e->getMessage();
        }

        return response()->json([
            "result_code" => $code,
            "result_message" => $message,
            "data" => $data
        ], $code);
    }

    public function cancel_order(Request $request)
    {
        try
        {
            $order = $this->person_order_service->find($request->id);

            if (!$order) {
                throw new \Exception("Not found", 1);
            }

            $person_order = $this->person_order_service->update($order->id, ['status' => 0]);

            if (!$person_order) {
                throw new \Exception("Not found", 1);
            }

            $code = 200;
            $message = "Success!";
            $data = "Cancel order success!";
        }
        catch(\Exception $e) {
            $code = 403;
            $message = "Something error!!!";
            $data = $e->getMessage();
        }

        return response()->json([
            "result_code" => $code,
            "result_message" => $message,
            "data" => $data
        ], $code);
    }
}
