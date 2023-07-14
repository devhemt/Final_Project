<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index(){
        return view('admin.comment.comment');
    }
}
