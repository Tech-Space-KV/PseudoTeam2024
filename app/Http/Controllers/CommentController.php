<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\SpComment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {

            $validated = $request->validate([
                'pconv_comment' => 'required|string|max:1000',
                'pconv_comment_by_cust_id' => 'required|integer',
                'pconv_scope_id' => 'required|integer',
            ]);

            $date_time = now();

            Comment::create([
                'pconv_comment' => $validated['pconv_comment'],
                'pconv_comment_by_cust_id' => $validated['pconv_comment_by_cust_id'],
                'pconv_scope_id' => $validated['pconv_scope_id'],
                'pconv_comment_date_time' => DATE_FORMAT(NOW(), '%d-%m-%Y %H:%i:%s'),
            ]);

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }

    public function spCommentStore()
    {
        $validated = request()->validate([
            'tconv_comment' => 'required|string|max:1000',
            'tconv_comment_by_sp_id' => 'required|integer',
            'tconv_task_id' => 'required|integer',
        ]);

         $currentTime = Carbon::now('Asia/Kolkata');

        SpComment::create([
            'tconv_comment' => $validated['tconv_comment'],
            'tconv_comment_by_sp_id' => $validated['tconv_comment_by_sp_id'],
            'tconv_task_id' => $validated['tconv_task_id'],
            'tconv_comment_date_time' => $currentTime->format('d-m-Y H:i:s'),
        ]);
        
        return redirect()->back()->with('success', 'SP Comment stored successfully.');
        
    }
}
