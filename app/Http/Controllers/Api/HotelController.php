<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Services\HotelService;

/**
 * Class HotelController
 */
class HotelController extends ApiController
{
    /**
     * protected $hotel_service
     */
    protected $hotel_service;

    /**
     * [__construct description]
     * @param HotelService $service [description]
     */
    public function __construct(HotelService $service)
    {
        $this->hotel_service = $service;
        // check login
        $this->middleware('check_login', ['only' => [ 'store', 'update', 'destroy' ]]);
    }

    /**
     * Show list hotel
     * @return object
     */
    public function index()
    {
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
        ], $code);
    }

    /**
     * Save hotel
     * @param Request $request
     * @return object
     */
    public function store(Request $request)
    {
        try
        {
            $hotel = $this->hotel_service->findName($request->name);
            if ($hotel) {
                throw new \Exception("Name hotel is exists", 2);
            }
            $hotel = [
                "name"      => $request->name,
                "address"   => $request->address,
                "price_room"=> $request->price_room,
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
        ], $code);
    }

    /**
     * Show hotel by id
     * @param int $id
     * @return object
     */
    public function show($id)
    {
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
        ], $code);
    }

    /**
     * Update hotel
     * @param Request $request
     * @param int $id
     * @return object
     */
    public function update(Request $request, $id)
    {
        try
        {
            // get hotel by id
            $hotel = $this->hotel_service->find($id);
            // validate name hotel
            $name = $this->hotel_service->findName($request->name);
            if ($name && $hotel->name !== $name->name) {
                throw new \Exception("Name hotel is exists", 2);
            }
            // insert data to hotel table
            $data_hotel = [
                "name"      => $request->name?$request->name:$hotel['name'],
                "address"   => $request->address?$request->address:$hotel['address'],
                "price_room"=> $request->price_room?$request->price_room:$hotel['price_room'],
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
        ], $code);
    }

    /**
     * Delete hotel
     * @param int $id
     * @return object
     */
    public function destroy($id)
    {
        try
        {
            $hotel = $this->hotel_service->update($id, ["deleted_at" => true]);
            if (!$hotel) {
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
        ], $code);
    }
}
