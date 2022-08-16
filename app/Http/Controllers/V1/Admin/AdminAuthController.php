<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\V1\Admin\RegisterRequest;
use App\Http\Resources\V1\Admin\AdminResource;
use Exception;
use App\Models\{User};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function registerAdmin(RegisterRequest $request)
    {
        try
        {
            $user = $this->user->where([
                'email_address' => $request->email_address
            ])->first();

            if($user)
            {
                throw new Exception('Admin user already exist', 400);
            }

            $this->user->create([
                'name' => $request->name,
                'email_address' => $request->email_address,
                'password' => Hash::make($request->password)
            ]);
            
            $data['message'] = 'Registered Admin the request';
            return successParser($data, 201);
        }
        catch(Exception $ex)
        {
            $data['message'] = $ex->getMessage();
            $code = $ex->getCode();
            return errorParser($data, $code);
        }

    }
    public function loginAdmin(LoginRequest $request)
    {
        try
        {
            if(Auth::attempt([
                'email_address' => $request->email_address,
                'password' => $request->password
            ]) == false)
            {
                throw new Exception("Email Address or Password is not correct",400);
            }

            $user = Auth::user();

            $accessToken = $user->createToken('Access Token')->plainTextToken;

            $data['access_token'] = $accessToken;
            $data['message'] = 'Login was succesful.';
            return successParser($data);
        }   
        catch(Exception $ex)
        {
            $data['message'] = $ex->getMessage();
            $code = $ex->getCode();
            return errorParser($data,$code);
        }
    }
    public function logout()
    {
        $user = Auth::user();
        // Revoke all tokens...
        $user->tokens()->delete();

        $data['message'] = 'Logout';
        return successParser($data);
    }
}
