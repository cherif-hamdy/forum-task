<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\ValidateCommentRequest;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware(["auth" , "verified"])->except('list');
    }

    /**
     * an api to list all comments
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        $comments = Comment::with('owner')->latest()->get();

        return response()->json([
            'data' => $comments
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(ValidateCommentRequest $request , Post $post)
    {

        $request->user()->comments()->create([
           'body' => $request->body,
           'post_id' =>  $post->id,
        ]);

        return redirect(route('posts.show' , $post->id))->with('success' , "Comment Added");
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
    public function edit(Post $post,Comment $comment)
    {
        return view('comments.edit' , compact('post' , 'comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateCommentRequest $request, Post $post , Comment $comment)
    {
        if ($request->user()->id == $comment->owner->id)
        {
            $request->user()->comments()->update([
                'body' => $request->body
            ]);

            return redirect(route('posts.show' , $post->id))->with('success' , 'Comment Updated');
        }
        else{
            return redirect(route('posts.show' , $post->id))->with('error' , 'You Are Not Authorized');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post , Comment $comment)
    {
        if (auth()->user()->id == $comment->owner->id)
        {
            $comment->delete();

            return redirect(route('posts.show' , $post->id))->with('success' , 'Comment Deleted');
        }
        else{
            return redirect(route('posts.show' , $post->id))->with('error' , 'You Are Not Authorized');
        }
    }
}
