<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Services\ReviewService;
use Core\Services\UserService;

/**
 * Class ReviewController
 */
class ReviewController extends ApiController
{
    /**
     * protected $user_service
     */
    protected $user_service;

    /**
     * protected $review_service
     */
    protected $review_service;

    /**
     * [__construct description]
     * @param ReviewService $service   [description]
     * @param UserService   $u_service [description]
     */
    public function __construct(ReviewService $service, UserService $u_service)
    {
        $this->user_service = $u_service;
        $this->review_service = $service;
        // check login
        $this->middleware('check_login', ['only' => [ 'update', 'destroy' ]]);
    }

    /**
     * Show list review
     * @return object
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
     * Save review
     * @param Request $request
     * @return object
     */
    public function store(Request $request)
    {
        try
        {
            $authorization = $request->header('authorization');

            $profile = $this->user_service->findWhere(["remember_token" => $authorization, 'deleted_at' => 0]);
            $review = [
                "score"         => $request->score,
                "content"       => $request->content,
                "date_review"   => now(),
                "id_tour"       => $request->id_tour,
                "id_user"       => $profile->id,
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
     * Show review
     * @param int $id
     * @return object
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
     * Update review
     * @param Request $request
     * @param int $id
     * @return object
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
     * Delete review
     * @param int $id
     * @return object
     */
    public function destroy($id)
    {
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
     * @param Request $request
     * @return object
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
            $data = null;
        }
        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ], $code);
    }
}
