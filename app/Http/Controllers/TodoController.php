<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
// use App\Http\Controllers\Auth;


class TodoController extends Controller
{
    public function add(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required|string|max:20',
                'task' => 'required|string|max:255',
            ]);
    
            $user = Auth::user();
    
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not logged in.'], 401);
            }
    
            // Fetch user_type correctly
            $userType = $user->user_type ?? null; // <--- Correct field name
    
            $custoemerId = session('user_id');

            Todo::create([
                'td_user_id'   => $custoemerId,
                'td_date'      => $request->date,
                'td_event'     => $request->task,
                'td_user_type' => $userType,
            ]);
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    

    public function delete(Request $request)
{
    try {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
        }

        $request->validate([
            'date' => 'required|string|max:20',
            'task' => 'required|string|max:255',
        ]);

        $todo = Todo::where('td_user_id', $user->id)
                    ->where('td_date', $request->date)
                    ->where('td_event', $request->task)
                    ->first();

        if (!$todo) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        $todo->delete();

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}


    public function fetchTodos()
{
    // $userId = Auth::user()->id;

    $userId = session('user_id');

    if (!$userId) {
        return response()->json(['success' => false, 'message' => 'User not logged in.'], 401);
    }

    $todos = Todo::where('td_user_id', $userId)->get();

    if ($todos->isNotEmpty()) {
        return response()->json(['success' => true, 'data' => $todos]);
    }

    return response()->json(['success' => false, 'message' => 'No tasks found']);
}

    public function spAdd(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required|string|max:20',
                'task' => 'required|string|max:255',
            ]);

            \Log::info('spAdd called with request:', $request->all());
            
            \Log::info('TODO Working till here ');

            $user = Auth::user();
    
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not logged in.'], 401);
            }
    
            // Fetch user_type correctly
            $userType = $user->user_type ?? null; // <--- Correct field name
    
              
            \Log::info('TODO Working till here ');

            $spId = session('sp_user_id');

            Todo::create([
                'td_user_id'   => $spId,
                'td_date'      => $request->date,
                'td_event'     => $request->task,
                'td_user_type' => $userType,
            ]);
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    

    public function spDelete(Request $request)
{
    try {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
        }

        $request->validate([
            'date' => 'required|string|max:20',
            'task' => 'required|string|max:255',
        ]);

        $todo = Todo::where('td_user_id', $user->id)
                    ->where('td_date', $request->date)
                    ->where('td_event', $request->task)
                    ->first();

        if (!$todo) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        $todo->delete();

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}


    public function spFetchTodos()
{
    // $userId = Auth::user()->id;

    $userId = session('sp_user_id');

    if (!$userId) {
        return response()->json(['success' => false, 'message' => 'User not logged in.'], 401);
    }

    $todos = Todo::where('td_user_id', $userId)->get();

    if ($todos->isNotEmpty()) {
        return response()->json(['success' => true, 'data' => $todos]);
    }

    return response()->json(['success' => false, 'message' => 'No tasks found']);
}
    
}
