<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Services\TypeTourService;

/**
 * Class TypeTourController
 */
class TypeTourController extends ApiController
{
    /**
     * protected $typetour_service
     */
    protected $typetour_service;

    /**
     * [__construct description]
     * @param TypeTourService $service [description]
     */
    public function __construct(TypeTourService $service)
    {
        $this->typetour_service = $service;
    }

    /**
     * Show list type tour
     * @return object
     */
    public function index()
    {
        try
        {
            // all data type tour
            $type_tour = $this->typetour_service->paginate();

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($type_tour),
                'list' => $type_tour
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
