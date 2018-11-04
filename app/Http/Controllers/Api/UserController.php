<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Core\Services\UserService;
use Core\Services\UserDetailService;

class UserController extends ApiController
{
    protected $user_service;
    protected $user_detail_service;

    public function __construct(UserService $service, UserDetailService $service_detail)
    {
        $this->user_service = $service;
        $this->user_detail_service = $service_detail;
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
            // all data users
            $data_user = $this->user_service->paginate();

            $code = 200;
            $message = "Success";
            $data = array(
                'total' => count($data_user),
                'list' => $data_user
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
        try
        {

            DB::transaction(function () use ($request) {
                // validate username
                $username = $this->user_service->findWhere(["username" => $request->username]);
                if ($username) {
                    throw new \Exception("Username is exists", 2);
                }
                // insert data to user table
                $data_user = [
                    "username"       => $request->username,
                    "password"       => bcrypt($request->password),
                    "active"         => true,
                    "deleted_at"     => false,
                    "remember_token" => null,
                ];

                $user = $this->user_service->store($data_user);
                // validate email
                $email = $this->user_detail_service->findWhere(["email" => $request->email]);
                if ($email) {
                    throw new \Exception("Email is exists", 3);
                }
                // insert ta to user_detail table
                $data_user_detail = [
                    "fullname"   => $request->fullname,
                    "email"      => $request->email,
                    "phone"      => $request->phone,
                    "address"    => $request->address,
                    "deleted_at" => false,
                    "id_user"    => $user['id']
                ];
                $user_detail = $this->user_detail_service->store($data_user_detail);
            });
            
            $code = 200;
            $message = "Success";
            $data = "Insert success!";
        } 
        catch(\Exception $e) {
            if ($e->getCode() === 2 || $e->getCode() === 3) {
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
            $user = $this->user_service->find($id);

            if (!$user) {
                throw new \Exception("Not found user", 2);
            }
            
            $code = 200;
            $message = "Success";
            $data = $user;
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
        try
        {
            // get user by id
            $user = $this->user_service->find($id);
            // transaction
            DB::transaction(function () use ($request, $user) {
                // validate username
                $username = $this->user_service->findWhere(["username" => $request->username ]);
                if ($username && $username->username !== $user['username']) {
                    throw new \Exception("Username is exists", 2);
                }
                // insert data to user table
                $data_user = [
                    "username" => $request->username?$request->username:$user['username'],
                ];

                $this->user_service->update($user['id'], $data_user);
                // validate email
                $email = $this->user_detail_service->findWhere(["email" => $request->email]);
                if ($email && $email->email !== $user['email']) {
                    throw new \Exception("Email is exists", 3);
                }
                // insert ta to user_detail table
                $data_user_detail = [
                    "fullname"   => $request->fullname?$request->fullname:$user['fullname'],
                    "email"      => $request->email?$request->email:$user['email'],
                    "phone"      => $request->phone?$request->phone:$user['phone'],
                    "address"    => $request->address?$request->username:$user['address'],
                ];
                $this->user_detail_service->update($user['id'], $data_user_detail);
            });
            
            $code = 200;
            $message = "Success";
            $data = "Update success!";
        } 
        catch(\Exception $e) {
            if ($e->getCode() === 2 || $e->getCode() === 3) {
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            DB::transaction(function () use ($id) {
                $user = $this->user_service->update($id, ["deleted_at" => true]);
                $user = $this->user_detail_service->update($id, ["deleted_at" => true]);
            });
        
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
     * Api login for user login
     * 
     * @param  Request
     * @return [type]
     */
    public function login(Request $request)
    {
        try
        {
            $login = $this->user_service->login($request->username, $request->password);
            if ($login) {
                $code = 200;
                $message = "Login success";
                $data = $login;
            } else {
                $code = 422;
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
        ], $code);
    }

    /**
     * Get profile user login
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function profile(Request $request)
    {
        try
        {
            $authorization = $request->header('authorization');

            $profile = $this->user_service->findWhere(["remember_token" => $authorization, 'deleted_at' => 0]);
            $profile = $this->user_service->find($profile->id);

            $code = 200;
            $message = "Success!";
            $data = $profile;
        } catch(\Exception $e) {
            $code = 403;
            $message = "Access Denied Exception";
            $data = null;
        }

        // Return json
        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ], $code);
    }

    /**
     * Change password for user
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function change_pass(Request $request, $id)
    {
        try
        {
            $this->user_service->update($id, ["password" => $request->password]);
        
            $code = 200;
            $message = "Success";
            $data = "Change password success!";
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
     * Lock user
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function lock_user($id)
    {
        try
        {
            $lock = $this->user_service->update($id, ["active" => false]);
            if (!$lock) {
                throw new \Exception("Something error!!!", 1);
            }

            $code = 200;
            $message = "Success";
            $data = "Lock user success!";
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
     * Unlock user
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function unlock_user($id)
    {
        try
        {
            $unlock = $this->user_service->update($id, ["active" => true]);
            if (!$unlock) {
                throw new \Exception("Something error!!!", 1);
            }
        
            $code = 200;
            $message = "Success";
            $data = "Unlock user success!";
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

    public function logout(Request $request)
    {
        try
        {
            $authorization = $request->header('authorization');

            $user = $this->user_service->findWhere(["remember_token" => $authorization]);

            $logout = $this->user_service->update($user->id, ["remember_token" => str_random(50)]);
            if (!$logout) {
                throw new \Exception("Something error!!!", 1);
            }
        
            $code = 200;
            $message = "Success";
            $data = "Logout success!";
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

    public function review_by_user(Request $request)
    {
        try
        {
            $authorization = $request->header('authorization');

            if (!$authorization) {
                throw new \Exception("Access Denied Exception", 403);
            }

            $review = $this->user_service->review_by_user($authorization);

            $code = 200;
            $message = "Success!";
            $data = $review;
        } catch(\Exception $e) {
            $code = 403;
            $message = "Access Denied Exception";
            $data = $e->getMessage();
        }

        // Return json
        return response()->json([
            "result_code"       => $code,
            "result_message"    => $message,
            "data"              => $data
        ], $code);
    }
}
