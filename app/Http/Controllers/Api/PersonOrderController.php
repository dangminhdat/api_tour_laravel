<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Services\PersonOrderService;

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
        //
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
        //
    }
}
