<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VideoTutorial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoTutorialController extends Controller
{
    // Konversi URL YouTube ke format embed
    private function toEmbedUrl(string $url): string
    {
        $pattern = '/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([A-Za-z0-9_-]{11})/';
        if (preg_match($pattern, $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        return $url;
    }

    public function index()
    {
        $videos = VideoTutorial::latest()->paginate(10);
        return view('guru.video_tutorial.index', compact('videos'));
    }

    public function create()
    {
        return view('guru.video_tutorial.create');
    }

public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'video' => 'nullable|file|mimes:mp4|max:102400', // max 100MB
        'url' => 'nullable|url',
    ]);

    $filePath = null;

    if ($request->hasFile('video')) {
        $filePath = $request->file('video')->store('videos', 'public');
    }

    VideoTutorial::create([
        'user_id' => auth()->id(),
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'file_path' => $filePath,
        'url' => $request->url,
    ]);

    return redirect()->route('guru.video-tutorial.index')->with('success', 'Video berhasil ditambahkan!');
}

   public function edit(VideoTutorial $video_tutorial)
{
    return view('guru.video_tutorial.edit', [
        'video' => $video_tutorial // <- penting! nama variabel ini harus sama dengan yang dipakai di view
    ]);
}

public function update(Request $request, VideoTutorial $video_tutorial)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'video' => 'nullable|file|mimes:mp4|max:102400',
        'url' => 'nullable|url',
    ]);

    // Validasi minimal salah satu harus ada
    if (!$request->hasFile('video') && !$request->url) {
        return back()->withErrors(['video' => 'File video atau URL YouTube harus diisi.'])->withInput();
    }

    $filePath = $video_tutorial->file_path;

    if ($request->hasFile('video')) {
        // Hapus file lama jika ada
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
        // Simpan file baru
        $filePath = $request->file('video')->store('videos', 'public');
    }

    $video_tutorial->update([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'file_path' => $filePath,
        'url' => $request->url ? $this->toEmbedUrl($request->url) : null,
    ]);

    return redirect()->route('guru.video-tutorial.index')
                     ->with('success', 'Video tutorial berhasil diperbarui.');
}

public function destroy(VideoTutorial $video_tutorial)
{
    $video_tutorial->delete();

    return redirect()->route('guru.video-tutorial.index')
                     ->with('success', 'Video tutorial berhasil dihapus.');
}

}
