<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Services\ReviewService;

class ReviewController extends ApiController
{
    protected $review_service;

    public function __construct(ReviewService $service)
    {
        $this->review_service = $service;
        // check login
        $this->middleware('check_login', ['only' => [ 'update', 'destroy' ]]);
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
            // all data review
            $data_review = $this->review_service->paginate();

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($data_review),
                'list' => $data_review
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
        try
        {
            $review = [
                "score"         => $request->score,
                "content"       => $request->content,
                "date_review"   => now(),
                "id_tour"       => $request->id_tour,
                "id_user"       => $request->id_user,
                "deleted_at"    => false
            ];

            $this->review_service->store($review);

            $code = 200;
            $message = "Success!";
            $data = "Insert review success!";
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
            $review = $this->review_service->find($id);

            if (!$review) {
                throw new \Exception("Not found review", 2);
            }
            
            $code = 200;
            $message = "Success";
            $data = $review;
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
        return response()->json([
            "result_code"       => 404,
            "result_message"    => "Not found",
            "data"              => null
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
        //
        try
        {
            $review = $this->review_service->update($id, ["deleted_at" => true]);
            if (!$review) {
                throw new \Exception("Not found review", 2);
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
     * Get review of tour
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function review_by_tour($id)
    {
        try
        {
            // all data review of tour
            $data_review = $this->review_service->review_by_tour($id);

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($data_review),
                'list' => $data_review
            );
        } 
        catch(\Exception $e) {
            $code = 403;
            $message = "Access Denied Exception";
            $data = $e->getMessage();
        }
        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ], $code);
    }
}
