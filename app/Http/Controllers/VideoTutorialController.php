<?php

namespace App\Http\Controllers;

use App\Models\VideoTutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoTutorialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya user login bisa akses
    }

    /**
     * Konversi berbagai format URL YouTube ke URL embed.
     */
    private function toEmbedUrl(string $url): string
    {
        // Ambil ID dari berbagai format YouTube
        $pattern = '/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([A-Za-z0-9_-]{11})/';
        if (preg_match($pattern, $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // Jika tidak cocok, kembalikan original
        return $url;
    }

    public function index()
    {
        $videos = VideoTutorial::latest()->get();
        return view('admin.videotutorial.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videotutorial.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'url'       => 'required|url',
        ]);

        $validated['url'] = $this->toEmbedUrl($validated['url']);

        VideoTutorial::create([
            'user_id'   => Auth::id(),
            'judul'     => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'url'       => $validated['url'],
        ]);

        return redirect()->route('admin.video-tutorial.index')
                         ->with('success', '✅ Video berhasil ditambahkan!');
    }

    public function edit(VideoTutorial $video)
    {
        return view('admin.videotutorial.edit', compact('video'));
    }

    public function update(Request $request, VideoTutorial $video)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'url'       => 'required|url',
        ]);

        $validated['url'] = $this->toEmbedUrl($validated['url']);

        $video->update([
            'judul'     => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'url'       => $validated['url'],
        ]);

        return redirect()->route('admin.video-tutorial.index')
                         ->with('success', '✅ Video berhasil diperbarui!');
    }

    public function destroy(VideoTutorial $video)
    {
        $video->delete();
        return back()->with('success', '🗑️ Video berhasil dihapus.');
    }
}
