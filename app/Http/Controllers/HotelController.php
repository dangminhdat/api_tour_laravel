<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Core\Services\HotelService;

class HotelController extends Controller
{
    protected $hotel_service;

    public function __construct(HotelService $service)
    {
        $this->hotel_service = $service;
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
            // all data hotel
            $data_hotel = $this->hotel_service->paginate();

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($data_hotel),
                'list' => $data_hotel
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
        try
        {
            $hotel = $this->hotel_service->findName($request->name);
            if ($hotel) {
                throw new \Exception("Name hotel is exists", 2);
            }
            $hotel = [
                "name"      => $request->name,
                "address"   => $request->address,
                "phone"     => $request->phone,
                "website"   => $request->website,
                "deleted_at"=> false
            ];

            $this->hotel_service->store($hotel);

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
        //
         try
        {
            // get user by id
            $hotel = $this->hotel_service->find($id);

            if (!$hotel) {
                throw new \Exception("Not found hotel", 2);
            }
            
            $code = 200;
            $message = "Success";
            $data = $hotel;
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
        try
        {
            // get user by id
            $hotel = $this->hotel_service->find($id);
            // validate name hotel
            $name = $this->hotel_service->findName($request->name);
            if ($name && $hotel->name !== $hotel['name']) {
                throw new \Exception("Name hotel is exists", 2);
            }
            // insert data to hotel table
            $data_hotel = [
                "name"      => $request->name?$request->name:$hotel['name'],
                "address"   => $request->address?$request->address:$hotel['address'],
                "phone"     => $request->phone?$request->phone:$hotel['phone'],
                "website"   => $request->website?$request->website:$hotel['website'],
            ];
            $this->hotel_service->update($hotel['id'], $data_hotel);
            
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
        //
        try
        {
            $user = $this->hotel_service->update($id, ["deleted_at" => true]);
        
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
