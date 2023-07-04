<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::firstOrNew([
            'name' => 'New Arrival 2023'
        ]);
        $posts->name = "New Arrival 2024";
        return $posts->save();    
        // $user = User::find(1);

        // $user->name = "Michale Ale Magar";
        // $user->email = "michael@gmail.com";
        // $user->save();
        // $user = User::all();
        // $user = User::all();
        // $user = User::all();
        // $user = new User();
        // return $user->create([
        //     'name' => "Milan",
        //     'email' => "michael@gmail3.com",
        //     'password' => Hash::make("Michale1"),
        // ]);
        // // return $user->all();
        // // return $user->find(6);
        // $response = $user->where('name', "Milan")->where('id', 13)->first();

        // return $response;
        // return $user->count();

        return view('product-index');
    }

    public function myfunction()
    {
        return view('product');
    }

    public function greet(string $name)
    {
        return view('product-index', [ 'name' => $name]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $product)
    {
        
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        $post = Post::find($product);
        $post->name = $request->get('name');
        $post->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        //
    }
}
