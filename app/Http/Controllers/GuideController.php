<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Core\Services\GuideService;

class GuideController extends Controller
{
    protected $guide_service;

    public function __construct(GuideService $service)
    {
        $this->guide_service = $service;
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
            // all data hotel
            $data_guide = $this->guide_service->paginate();

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($data_guide),
                'list' => $data_guide
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
        ]);
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
        //
        try
        {
            $guide = $this->guide_service->findWhere([
                "name"      => $request->name,
                "address"   => $request->address,
                "phone"     => $request->phone,
            ]);
            if ($guide) {
                throw new \Exception("Name guide is exists", 2);
            }
            $guide = [
                "name"      => $request->name,
                "address"   => $request->address,
                "phone"     => $request->phone,
                "deleted_at"=> false
            ];

            $this->guide_service->store($guide);

            $code = 200;
            $message = "Success!";
            $data = "Insert success!";
        }
        catch(\Exception $e) {
            if ($e->getCode() === 2) {
                $message = $e->getMessage();
            } else {
                $message = "Something error!!!";
            }
            $code = 400;
            $data = null;
        }

        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ]);
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
            $guide = $this->guide_service->find($id);

            if (!$guide) {
                throw new \Exception("Not found guide", 2);
            }
            
            $code = 200;
            $message = "Success";
            $data = $guide;
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
        ]);
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
            // get guide by id
            $guide = $this->guide_service->find($id);
            // validate name guide
            $name = $this->guide_service->findWhere([
                "name"      => $request->name,
                "address"   => $request->address,
                "phone"     => $request->phone,
            ]);
            if ($name && !($guide->name === $name->name && $guide->address === $name->address && $guide->phone === $name->phone)) {

                throw new \Exception("Name guide is exists", 2);
            }
            // insert data to guide table
            $data_guide = [
                "name"      => $request->name?$request->name:$guide['name'],
                "address"   => $request->address?$request->address:$guide['address'],
                "phone"     => $request->phone?$request->phone:$guide['phone'],
            ];
            $this->guide_service->update($guide['id'], $data_guide);
            
            $code = 200;
            $message = "Success";
            $data = "Update success!";
        } 
        catch(\Exception $e) {
            if ($e->getCode() === 2) {
                $message = $e->getMessage();
            } else {
                $message = "Something error!!!!!";
            }
            $code = 400;
            $data = null;
        }
        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ]);
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
            $guide = $this->guide_service->update($id, ["deleted_at" => true]);
            if (!$guide) {
                throw new \Exception("Not found hotel", 2);
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
        ]);
    }
}
