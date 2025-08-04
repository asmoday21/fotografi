<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoTutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoTutorialController extends Controller
{
    /**
     * Tampilkan daftar video tutorial
     */
    public function index()
    {
        $videos = VideoTutorial::latest()->get();
        return view('admin.video-tutorial.index', compact('videos'));
    }

    /**
     * Form tambah video tutorial
     */
    public function create()
    {
        return view('admin.video-tutorial.create');
    }

    /**
     * Simpan video tutorial baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'url'       => 'required|url',
        ]);

        VideoTutorial::create([
            'user_id'   => Auth::id(),
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
              'url' => $this->toEmbedUrl($request->url),
        ]);

        return redirect()->route('admin.video-tutorial.index')
                         ->with('success', 'Video berhasil ditambahkan.');
    }

    /**
     * Form edit video tutorial
     */
    public function edit(VideoTutorial $videoTutorial)
    {
        return view('admin.video-tutorial.edit', compact('videoTutorial'));
    }

    /**
     * Update data video tutorial
     */
    public function update(Request $request, VideoTutorial $videoTutorial)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'url'       => 'required|url',
        ]);

        $videoTutorial->update([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'url' => $this->toEmbedUrl($request->url),
        ]);

        return redirect()->route('admin.video-tutorial.index')
                         ->with('success', 'Video berhasil diperbarui.');
    }

    /**
     * Hapus video tutorial
     */
    public function destroy(VideoTutorial $videoTutorial)
    {
        $videoTutorial->delete();

        return redirect()->route('admin.video-tutorial.index')
                         ->with('success', 'Video berhasil dihapus.');
    }
    private function toEmbedUrl(string $url): string
{
    $pattern = '/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([A-Za-z0-9_-]{11})/';
    if (preg_match($pattern, $url, $matches)) {
        return 'https://www.youtube.com/embed/' . $matches[1];
    }
    return $url;
}

}
