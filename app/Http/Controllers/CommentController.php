<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'materi_id' => 'required|exists:materi,id',
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'materi_id' => $request->materi_id,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
