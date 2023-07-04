<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "Login Page";
       // $attempt = Auth::attempt([
       //  'email' => 'michael@gmail.com',
       //  'password' => '12345678',
       // ]);
       // dd($attempt);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'username' => 'required',
        ]);


       if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $data = $request->only('email', 'password', 'name', 'username');
        $data['password'] = Hash::make($data['password']);
        // return $data;
        $user = User::create($data);
         if(!$user){
            return $this->sendError('Error.', $user);       
        }

        return "Success";
    }

    /**
     * Display the specified resource.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        

       if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        // $credentials = [
        //     'email' => $request->get('email'),
        //     'password' => $request->get('password'),
        // ];

        $credentials = $request->only('email', 'password');

        // return Hash::make($request->get('password'));
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                // 'user' => $user,
                'authorization' => [
                    'token' => $user->createToken('ApiToken')->plainTextToken,
                    'type' => 'bearer',
                ]
            ]);
        }

          return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }
}
