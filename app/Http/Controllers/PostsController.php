<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\ValidatePostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * PostsController constructor.
     * Apply auth & verified middleware for all functions except index , show & list functions
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('index', 'show' , 'list');
    }

    /**
     * an api to list the latest post with latest comment & comment's owner
     * @return \Illuminate\Http\JsonResponse
     */

    public function list()
    {
        $posts = Post::with('lastComment','lastComment.owner')->latest()->get();

        return response()->json([
            'data' => $posts
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(3);

        return view('posts.index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidatePostRequest $request)
    {
        $request->user()->posts()->create($request->only('title', 'content'));

        return redirect(route('posts.index'))->with('success' , 'Post Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comments = Comment::paginate(3);

        return view('posts.show' , compact('post' , 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit' , compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidatePostRequest $request, Post $post)
    {
        if ($request->user()->id == $post->author->id)
        {
            $request->user()->posts()->update($request->only('title' , 'content'));
            return redirect(route('posts.index'))->with('success' , 'Post Updated');
        }
        else{
            return redirect(route('posts.index'))->with('error' , 'You Are Not Authorized');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (auth()->user()->id == $post->author->id)
        {
            $post->delete();
            return redirect(route('posts.index'))->with('success' , "Post Deleted");
        }

        else {
            return redirect(route('posts.index'))->with('error' , 'You Are Not Authorized');
        }

    }


}
