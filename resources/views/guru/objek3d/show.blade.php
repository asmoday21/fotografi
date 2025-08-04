@extends('guru.layouts.app')

@section('content')
<div class="container py-4">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-gradient">👁️ Detail Objek 3D</h2>
        <h4 class="text-muted">{{ $objek3d->judul }}</h4>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <p class="text-center text-secondary fs-5 mb-4">
                {{ $objek3d->deskripsi }}
            </p>

            @php
                use Illuminate\Support\Facades\Storage;
                $viewerSrc = Storage::url($objek3d->file);
            @endphp

            <div id="modelContainer" class="rounded-4 overflow-hidden border border-light-subtle" style="background-color: #f8f9fa;">
                <model-viewer 
                    id="modelViewer"
                    src="{{ $viewerSrc }}"
                    alt="{{ $objek3d->judul }}"
                    auto-rotate
                    camera-controls
                    shadow-intensity="1"
                    ar
                    ar-modes="webxr scene-viewer quick-look"
                    ios-src="{{ $viewerSrc }}"
                    style="width: 100%; height: 450px; background: radial-gradient(circle at center, #ffffff, #e9ecef); border-radius: 16px;">
                </model-viewer>
            </div>

            <div class="d-flex flex-wrap justify-content-center gap-2 mt-4">
                <button class="btn btn-outline-primary" onclick="zoomIn()">➕ Zoom In</button>
                <button class="btn btn-outline-primary" onclick="zoomOut()">➖ Zoom Out</button>
                <button class="btn btn-outline-primary" onclick="rotateLeft()">↩️ Putar Kiri</button>
                <button class="btn btn-outline-primary" onclick="rotateRight()">↪️ Putar Kanan</button>
                <button class="btn btn-outline-dark" onclick="openFullscreen()">🖥️ Fullscreen</button>
            </div>

            <div class="text-center mt-3">
                <small class="text-muted">* Mode AR hanya tersedia di perangkat yang mendukung WebXR atau Quick Look</small>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('guru.objek3d.index') }}" class="btn btn-secondary rounded-pill px-4">⬅️ Kembali ke Daftar</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modelViewer = document.getElementById('modelViewer');

        window.zoomIn = () => {
            const orbit = modelViewer.getCameraOrbit();
            modelViewer.cameraOrbit = `${orbit.theta} ${orbit.phi} ${orbit.radius * 0.8}m`;
        };

        window.zoomOut = () => {
            const orbit = modelViewer.getCameraOrbit();
            modelViewer.cameraOrbit = `${orbit.theta} ${orbit.phi} ${orbit.radius * 1.2}m`;
        };

        window.rotateLeft = () => {
            const orbit = modelViewer.getCameraOrbit();
            modelViewer.cameraOrbit = `${parseFloat(orbit.theta) - 0.5}rad ${orbit.phi} ${orbit.radius}`;
        };

        window.rotateRight = () => {
            const orbit = modelViewer.getCameraOrbit();
            modelViewer.cameraOrbit = `${parseFloat(orbit.theta) + 0.5}rad ${orbit.phi} ${orbit.radius}`;
        };

        window.launchAR = () => modelViewer.activateAR();

        // ✅ Fullscreen Function
        window.openFullscreen = () => {
            const viewer = document.getElementById('modelViewer');
            if (viewer.requestFullscreen) {
                viewer.requestFullscreen();
            } else if (viewer.webkitRequestFullscreen) { /* Safari */
                viewer.webkitRequestFullscreen();
            } else if (viewer.msRequestFullscreen) { /* IE11 */
                viewer.msRequestFullscreen();
            }
        };
    });
</script>
@endpush
