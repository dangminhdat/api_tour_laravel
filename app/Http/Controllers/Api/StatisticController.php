<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Core\Services\GuideService;
use Core\Services\HotelService;
use Core\Services\UserService;
use Core\Services\PersonOrderService;
use Core\Services\ReviewService;
use Core\Services\TourService;
use Core\Services\LocationService;

class StatisticController extends ApiController
{
    /**
     * protected $guide_service
     */
    protected $guide_service;

    /**
     * protected $hotel_service
     */
    protected $hotel_service;

    /**
     * protected $user_service
     */
    protected $user_service;

    /**
     * protected $order_service
     */
    protected $order_service;

    /**
     * protected $review_service
     */
    protected $review_service;

    /**
     * protected $tour_service
     */
    protected $tour_service;

     /**
     * protected $location_service
     */
    protected $location_service;

    /**
     * [__construct description]
     * @param ImageService $service [description]
     */
    public function __construct(GuideService $guide_service, HotelService $hotel_service, PersonOrderService $order_service, ReviewService $review_service, TourService $tour_service, UserService $user_service, LocationService $location_service)
    {
        $this->guide_service = $guide_service;
        $this->hotel_service = $hotel_service;
        $this->order_service = $order_service;
        $this->review_service = $review_service;
        $this->tour_service = $tour_service;
        $this->user_service = $user_service;
        $this->location_service = $location_service;
    }

    /**
     * Get count
     * @return object
     */
    public function index()
    {
    	try
        {
            $code = 200;
            $message = "Success";
            $data = array(
                'guide' => count($this->guide_service->paginate()),
                'hotel' => count($this->hotel_service->paginate()),
                'order' => count($this->order_service->paginate()),
                'review' => count($this->review_service->paginate()),
                'tour' => count($this->tour_service->paginate()),
                'user' => count($this->user_service->paginate()),
                'location' => count($this->location_service->paginate())
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
