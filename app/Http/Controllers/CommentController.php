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

        \Log::info('CommentController store method called', [
            'request_data' => $request->all(),
        ]);

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

        \Log::info('Comment stored!');

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }

    public function spCommentStore()
    {
        \Log::info('spCommentStore method called');

        // You can add your logic here, similar to the store method.
        $validated = request()->validate([
            'tconv_comment' => 'required|string|max:1000',
            'tconv_comment_by_sp_id' => 'required|integer',
            'tconv_task_id' => 'required|integer',
        ]);

        \Log::info('SP Comment validated', [
            'validated_data' => $validated,
        ]);

         $currentTime = Carbon::now('Asia/Kolkata');

        // Store the validated comment
        SpComment::create([
            'tconv_comment' => $validated['tconv_comment'],
            'tconv_comment_by_sp_id' => $validated['tconv_comment_by_sp_id'],
            'tconv_task_id' => $validated['tconv_task_id'],
            'tconv_comment_date_time' => $currentTime->format('d-m-Y H:i:s'),
        ]);

        \Log::info('SP Comment stored successfully');

        return redirect()->back()->with('success', 'SP Comment stored successfully.');
        
    }
}
