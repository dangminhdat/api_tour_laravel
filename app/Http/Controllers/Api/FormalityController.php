<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Services\FormalityService;

/**
 * Class FormalityController
 */
class FormalityController extends ApiController
{
    /**
     * protected $formality_service
     */
    protected $formality_service;

    /**
     * [__construct description]
     * @param FormalityService $service [description]
     */
    public function __construct(FormalityService $service)
    {
        $this->formality_service = $service;
    }
    
    /**
     * Show
     * @return object
     */
    public function index()
    {
        try
        {
            // all data type tour
            $formality = $this->formality_service->paginate();

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($formality),
                'list' => $formality
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
