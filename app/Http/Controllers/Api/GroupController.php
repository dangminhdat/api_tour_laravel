<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Services\GroupService;

/**
 * Class GroupController
 */
class GroupController extends ApiController
{
    /**
     * protected $group_service
     */
    protected $group_service;

    /**
     * [__construct description]
     * @param GroupService $service [description]
     */
    public function __construct(GroupService $service)
    {
        $this->group_service = $service;
    }

    /**
     * Show group
     * @return object
     */
    public function index()
    {
        try
        {
            $group = $this->group_service->paginate();

            $code = 200;
            $message = "Success!";
            $data = array(
                "total" => count($group),
                "list" => $group
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show group by id
     * @param int $id
     * @return object
     */
    public function show($id)
    {
        try
        {
            $group = $this->group_service->find($id);

            $code = 200;
            $message = "Success!";
            $data = $group;
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
