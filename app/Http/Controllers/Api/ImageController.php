<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Services\ImageService;

/**
 * Class ImageController
 */
class ImageController extends ApiController
{
    /**
     * protected $image_service
     */
    protected $image_service;

    /**
     * [__construct description]
     * @param ImageService $service [description]
     */
    public function __construct(ImageService $service)
    {
        $this->image_service = $service;
        // check login
        $this->middleware('check_login', ['only' => [ 'store', 'update', 'destroy' ]]);
    }

    /**
     * Show list images
     * @return object
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
     * Save image
     * @param Request $request
     * @return object
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
     * Show image by id
     * @param int $id
     * @return object
     */
    public function show($id)
    {
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
     * Update images
     * @param Request $request
     * @param int $id
     * @return object
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
     * Delete images
     * @param int $id
     * @return object
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
