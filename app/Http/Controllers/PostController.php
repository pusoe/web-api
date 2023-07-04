<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('users')->get();

    	return PostResource::collection($posts);
        // foreach($posts as $post) {
        // $resources[] = [
        //     'id' => $post->id,
        //     'name' => $post->name,
        //     'slug' => $post->slug,
        //     'description' => $post->description,
        //     'about' => "$post->name $post->description",
        //     'published_at' => $post->created_at->format('Y-m-d')
        // ];
        // return response()->json($resources);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required|string',
            'users_id' => 'required|numeric',
        ]);

       if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

    	$data = $request->all();
    	$post = new Post();
    	$post->name = $data['name'];
    	$post->slug = $data['slug'];
    	$post->description = $data['description'];
    	$post->user_id = $data['users_id'];
    	 if ($post->save()) {
    	 	return "Success";
    	 }
    	return "failure";
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    	// if (is_numeric($name)) {
    	// 	return "Enter string name";
    	// }
        $post = Post::with('users')->where(['id' => $id])->first();
        if ($post) {
            // dd($post->user);
        	return [
        		'name' => $post->name,
        		'slug' => $post->slug,
        		'description' => $post->description,
        		// 'author' => $post->user->name,
        	];
        	return $post;
        }
        return "No data found.";
    }

    public function update(Request $request, $id)
    {
    	// dd($id, $request->all());
    	$data = $request->all();
    	$post = Post::find($id);
    	$post->name = $data['name'];
    	$post->slug = $data['slug'];
    	$post->description = $data['description'];
    	if ($post->save()) {
    		return "Post updated successfully.";
    	}

    	return "Error when updating post.";
    }

    public function destroy($id)
    {
    	$post = Post::findOrFail($id);
    	// dd($post);
    	if ($post->delete()) {
    		return 'Post deleted successfully.';
    		// return response()->json(['Post deleted successfully.'], 204);
    	}

    	return "Error deleting post.";
    	// return response()->json(["Error deleting post."], 400);
    }

    public function results()
    {
        $posts = Post::with('users')->get();

        return PostResource::collection($posts);
        
    }
}
