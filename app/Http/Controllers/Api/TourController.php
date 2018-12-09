<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Services\TourService;

/**
 * Class TourController
 */
class TourController extends ApiController
{
    /**
     * protected $tour_service
     */
    protected $tour_service;

    /**
     * [__construct description]
     * @param TourService $service [description]
     */
    public function __construct(TourService $service)
    {
        $this->tour_service = $service;
        // check login
        $this->middleware('check_login', ['only' => [ 'store', 'update', 'destroy', 'upload_image'], 'except' => [ 'search_tour' ]]);
    }

    /**
     * Show list tour
     * @return object
     */
    public function index()
    {
        try
        {
            // all data tour
            $tour = $this->tour_service->paginate();

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($tour),
                'list' => $tour
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
     * Save tour
     * @param Request $request
     * @return object
     */
    public function store(Request $request)
    {
        try
        {
            $data = [
                "name"          => $request->name,
                "number_days"   => $request->number_days,
                "date_created"  => now(),
                "item_tour"     => $request->item_tour,
                "discount"      => $request->discount,
                "images"        => $request->images,
                "programs"      => $request->programs,
                "note"          => $request->note,
                "deleted_at"    => false,
                "id_type_tour"  => $request->id_type_tour
            ];
            // all data tour
            $tour = $this->tour_service->store($data);

            $code = 200;
            $message = "Success";
            $data = "Insert tour success";
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
     * Show tour by id
     * @param int $id
     * @return object
     */
    public function show($id)
    {
        try
        {
            // all data tour
            $tour = $this->tour_service->find_tour_detail($id);

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($tour),
                'list' => $tour
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
     * Update tour by id
     * @param Request $request
     * @param int $id
     * @return object
     */
    public function update(Request $request, $id)
    {
        try
        {
            $tour = $this->tour_service->find($id);

            $data = [
                "name"          => $request->name?$request->name:$tour->name,
                "number_days"   => $request->number_days?$request->number_days:$tour->number_days,
                "item_tour"     => $request->item_tour?$request->item_tour:$tour->item_tour,
                "discount"      => $request->discount?$request->discount:$tour->discount,
                "images"        => $request->images?$request->images:$tour->images,
                "programs"      => $request->programs?$request->programs:$tour->programs,
                "note"          => $request->note?$request->note:$tour->note,
                "id_type_tour"  => $request->id_type_tour?$request->id_type_tour:$tour->id_type_tours
            ];
            // all data tour
            $tour = $this->tour_service->update($id, $data);

            $code = 200;
            $message = "Success";
            $data = "Update tour success";
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
     * Delete tour
     * @param int $id
     * @return object
     */
    public function destroy($id)
    {
        try
        {
            // all data tour
            $tour = $this->tour_service->destroy($id);
            if (!$tour) {
                throw new \Exception("Access Denied Exception", 1);
            }

            $code = 200;
            $message = "Success";
            $data = "Delete tour success!";
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
     * Get list tour by location
     * @param int $id
     * @return object
     */
    public function tour_by_location($id)
    {
        try
        {
            // all data tour by location
            $tour = $this->tour_service->tour_by_location($id);

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($tour),
                'list' => $tour
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
     * Get list tour by sales
     * @return object
     */
    public function tour_by_sales()
    {
        try
        {
            // all data tour by location
            $tour = $this->tour_service->tour_by_sales();

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($tour),
                'list' => $tour
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
     * Get list tour of type
     * @param int $id
     * @return object
     */
    public function tour_of_type($id)
    {
        try
        {
            // all data tour by location
            $tour = $this->tour_service->tour_of_type($id);

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($tour),
                'list' => $tour
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
     * Update tour
     * @param Request $request
     * @param int $id
     * @return object
     */
    public function updateTour(Request $request, $id)
    {
        try
        {
            $tour = $this->tour_service->find($id);
            $data = [
                "name"          => $request->name?$request->name:$tour->name,
                "number_days"   => $request->number_days?$request->number_days:$tour->number_days,
                "item_tour"     => $request->item_tour?$request->item_tour:$tour->item_tour,
                "discount"      => $request->discount?$request->discount:$tour->discount,
                "programs"      => $request->programs?$request->programs:$tour->programs,
                "note"          => $request->note?$request->note:$tour->note,
                "id_type_tour"   => $request->id_type_tour?$request->id_type_tour:$tour->id_type_tour,
            ];
            if ($request->hasFile('images')) {
                $data['images'] = $request->file('images');
            }
            // all data tour
            $tour = $this->tour_service->updateTour($id, $data);

            $code = 200;
            $message = "Success";
            $data = "Update tour success";
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
     * Upload image
     * @param Request $request
     * @return object
     */
    public function upload_image(Request $request)
    {
        try
        {
            if (!$request->hasFile('images')) {
                throw new \Exception("No choose images", 1);
            }
            $data = [
                "images" => $_FILES['images'],
            ];
            // all data tour
            $image = $this->tour_service->upload_image($data);

            if (!$image) {
                throw new \Exception("Something error!!!", 1);
            }

            $code = 200;
            $message = "Success";
            $data = $image;
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
     * Get 5 tour latest
     * @return object
     */
    public function five_tour_latest()
    {
        try
        {
            // all data tour
            $tour = $this->tour_service->five_tour_latest();

            $code = 200;
            $message = "Success";
            $data = array(
                "total" => count($tour),
                "list" => $tour
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
     * Search tour
     * @param Request $request
     * @return object
     */
    public function search_tour(Request $request)
    {
        try
        {
            $data = array();
            if ($request->date_depart) {
                $data['date'] = $request->date_depart;
            }
            if ($request->id_location) {
                $data['location'] = $request->id_location;
            }
            // all data tour
            $tour = $this->tour_service->search_tour($data);

            $code = 200;
            $message = "Success";
            $data = array(
                "total" => count($tour),
                "list" => $tour
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
     * Add tour
     * @param Request $request
     * @return object
     */
    public function add(Request $request)
    {
        try
        {
            $data = [
                "name"          => $request->name,
                "number_days"   => $request->number_days,
                "date_created"  => now(),
                "item_tour"     => $request->item_tour,
                "discount"      => $request->discount,
                "images"        => $_FILES['images'],
                "programs"      => $request->programs,
                "note"          => $request->note,
                "deleted_at"    => false,
                "id_type_tour"  => $request->id_type_tour
            ];
            // all data tour
            $tour = $this->tour_service->add($data);

            $code = 200;
            $message = "Success";
            $data = "Insert tour success";
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
     * Get tour
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        try
        {
            $tour = $this->tour_service->find($id);
            unset($tour->deleted_at);

            $code = 200;
            $message = "Success";
            $data = $tour;
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
}
