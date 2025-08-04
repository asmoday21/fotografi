@php use Illuminate\Support\Str; @endphp
@if(isset($galeri) && Str::endsWith($galeri->file, '.glb'))
    <div class="mt-4">
        <label>Preview 3D:</label>
        <model-viewer 
            src="{{ asset('storage/galeri/' . $galeri->file) }}" 
            alt="3D Model" 
            auto-rotate 
            camera-controls 
            style="width: 100%; height: 400px;">
        </model-viewer>
    </div>
@endif
