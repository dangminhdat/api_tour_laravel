<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Core\Services\ReviewService;

class ReviewController extends Controller
{
     protected $review_service;

    public function __construct(ReviewService $service)
    {
        $this->review_service = $service;
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
        try
        {
            $review = [
                "name_review"   => $request->name_review,
                "email_review"  => $request->email_review,
                "score"         => $request->score,
                "content"       => $request->content,
                "date_review"   => now(),
                "id_tour"       => $request->id_tour,
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
        return response()->json([
            "result_code"       => 404,
            "result_message"    => "Not found",
            "data"              => null
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
        ]);
    }
}
