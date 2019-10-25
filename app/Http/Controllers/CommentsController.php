<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->repository = $commentRepository;
    }
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//        //
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->repository->save($request->all());
    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Comment  $comment
//     * @return \Illuminate\Http\Response
//     */
//    public function show(CommentRepositoryInterface $comment)
//    {
//        //
//        $comment->
//    }

//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\Comment  $comment
//     * @return \Illuminate\Http\Response
//     */
//    public function edit(Comment $comment)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Comment  $comment
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, Comment $comment)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Comment  $comment
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Comment $comment)
//    {
//        //
//    }
}
