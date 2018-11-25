<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Services\LocationService;

class LocationController extends ApiController
{
    protected $location_service;

    public function __construct(LocationService $service)
    {
        $this->location_service = $service;
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
        try
        {
            // all data location
            $data_location = $this->location_service->paginate();

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            if (!$request->hasFile('image')) {
                throw new \Exception("No choose image", 1);
            }
            $location = [
                "name"       => $request->name,
                "image"      => $request->file('image')
            ];

            if(!$this->location_service->store($location)) {
                throw new \Exception("Something error!!!", 2);
            }

            $code = 200;
            $message = "Success!";
            $data = "Insert location success!";
        }
        catch(\Exception $e) {
            $message = "Something error!!!";
            if ($e->getCode() === 1) {
                $message = $e->getMessage();
            }
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            // get user by id
            $location = $this->location_service->find($id);

            if (!$location) {
                throw new \Exception("Not found location", 2);
            }
            
            $code = 200;
            $message = "Success";
            $data = $location;
        } 
        catch(\Exception $e) {
            $code = 400;
            $message = "Something error!!!!!";
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
        $code = 403;
        $message = "Access Denied Exception";
        $data = null;
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
            $location = $this->location_service->update($id, ["deleted_at" => true]);
            if (!$location) {
                throw new \Exception("Not found location", 2);
            }
        
            $code = 200;
            $message = "Success";
            $data = "Delete success!";
        } 
        catch(\Exception $e) {
            $code = 400;
            $message = "Something error!!!!!";
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
    public function updateLocation(Request $request, $id)
    {
        try
        {
            $location = [
                "name" => $request->name,
            ];

            if ($request->hasFile('image')) {
                $location["image"] = $request->file('image');
            }

            if (!$this->location_service->updateLocation($id, $location)) {
                throw new \Exception("Something error!!!", 1);   
            }

            $code = 200;
            $message = "Success!";
            $data = "Update location success";
        }
        catch(\Exception $e) {
            $code = 400;
            $message = "Something error!!!";
            $data = null;
        }

        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ], $code);
    }

    public function favorite_four_location()
    {
        try
        {
            $location = $this->location_service->favorite_four_location();

            $code = 200;
            $message = "Success!";
            $data = array(
                "total" => count($location),
                "list" => $location
            );
        }
        catch(\Exception $e) {
            $code = 400;
            $message = "Something error!!!";
            $data = null;
        }

        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ], $code);
    }
}
