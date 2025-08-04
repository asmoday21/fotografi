<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::where('user_id', Auth::id())->latest()->paginate(10);
        return view('guru.video.index', compact('videos'));
    }

    public function create()
    {
        return view('guru.video.create');
    }

    public function store(Request $request)
    {
    ini_set('max_execution_time', 300);

        $validated = $request->validate([ 
    'judul' => 'required|string|max:255',
    'deskripsi' => 'required|string',
    'video' => 'required|mimes:mp4|max:51200' // max 50MB
]);

$videoPath = $request->file('video')->store('video_tutorials', 'public');

VideoTutorial::create([
    'judul' => $validated['judul'],
    'deskripsi' => $validated['deskripsi'],
    'file_path' => $videoPath
]);

        return redirect()->route('guru.video.index')->with('success', 'Video berhasil diupload!');
    }

    public function destroy(Video $video)
    {
        // Pastikan hanya pemilik video yang bisa hapus
        if ($video->user_id != Auth::id()) {
            abort(403);
        }

        // Hapus file video
        Storage::delete('public/' . $video->file);

        // Hapus record
        $video->delete();

        return redirect()->route('guru.video.index')->with('success', 'Video berhasil dihapus!');
    }
}
