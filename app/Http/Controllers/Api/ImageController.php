<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Services\ImageService;

class ImageController extends ApiController
{
    protected $image_service;

    public function __construct(ImageService $service)
    {
        $this->image_service = $service;
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
            // all data location
            $data_location = $this->image_service->paginate();

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($data_location),
                'list' => $data_location
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
        try
        {
            $image = [
                "description" => $request->description,
                "images"      => $_FILES['images'],
                "id_tour"     => $request->id_tour
            ];

            $this->image_service->store($image);

            $code = 200;
            $message = "Success!";
            $data = "Insert success!";
        }
        catch(\Exception $e) {
            $message = "Something error!!!";
            $code = 400;
            $data = $e->getMessage();
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
        //
        try
        {
            // all data location
            $data_location = $this->image_service->find($id);

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($data_location),
                'list' => $data_location
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
        try
        {
            $data = [
                "description" => $request->description
            ];

            $image = $this->image_service->update($id, $data);
            if (!$image) {
                throw new \Exception("Not found", 2);
            }

            $code = 200;
            $message = "Success!";
            $data = "Update success!";
        }
        catch(\Exception $e) {
            $message = "Something error!!!";
            $code = 400;
            $data = null;
        }

        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
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
            $image = $this->image_service->update($id, ["deleted_at" => true]);
            if (!$image) {
                throw new \Exception("Not found", 2);
            }

            $code = 200;
            $message = "Success!";
            $data = "Delete success!";
        }
        catch(\Exception $e) {
            $message = "Something error!!!";
            $code = 400;
            $data = null;
        }

        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ], $code);
    }
}
