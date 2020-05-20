<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Post;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $posts=Post::get();
     return response()->json(
        ['posts' => new PostCollection(Post::all())], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ext=$request->image->extension();
        $filename=Str::random(20).".$ext";
        $path = $request->image->storeAs('uploads', $filename, "public");
        
        $post = new Post([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
        ]);
        $post->image=$path;
        $post->save();
        if($post){
            return response()->json(['status' => "Post Created Sucesfully!"], 200);
        }else{
            return response()->json(['status' => "Your Post Not Created Please Check Your Details!"], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request )
    {
        $post=Post::find($request->id);
        if($post){
        return response()->json(
        ['posts' => new PostResource(Post::find($request->id))], 200);
        }else
        {
         return response()->json(['status' => "Your Post Not Found!"], 403);   
        }
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $post = Post::find($request->id);
        $post->title=$request->title;
        $post->description=$request->description;
        $post->category=$request->category;
        $image=$request->image;
        if($image)
        {
            $ext=$request->image->extension();
            $filename=Str::random(20).".$ext";
            $path = $request->image->storeAs('uploads', $filename, "public");
            $post->image=$path;
        }
        $post->save();
        if($post){
            return response()->json(['status' => "Post Updated Sucesfully!"], 200);
        }else{
            return response()->json(['status' => "Your Post Not Updated Please Check Your Details!"], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post = Post::find($request->id);
        
        if($post){
            $post->delete();
        return response()->json(['status' => "Post Deleted Sucesfully!"], 200);
        }else{
            return response()->json(['status' => "Post Not Found!"], 403);
        }
    }
}
