<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Core\Services\UserService;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = $this->service->paginate();
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
    }

    /**
     * Api login for user login
     * 
     * @param  Request
     * @return [type]
     */
    public function login(Request $request)
    {
        try
        {
            $login = $this->service->login($request->username, $request->password);
            if ($login) {
                $code = 200;
                $message = "Login success";
                $data = $login;
            } else {
                $code = 200;
                $message = "Invalid username/password supplied";
                $data = null;
            }
        } catch(\Exception $e) {
            $code = 500;
            $message = "INTERNAL SERVER ERROR";
            $data = null;
        }
        
        // Return json
        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ]);
    }
}
