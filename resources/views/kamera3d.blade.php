<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Preview Kamera 3D</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Google Model Viewer -->
  <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

  <style>
    body {
      margin: 0;
      padding: 20px;
      background: #f5f5f5;
      font-family: 'Poppins', sans-serif;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #4a00e0;
    }

    model-viewer {
      width: 100%;
      max-width: 800px;
      height: 500px;
      display: block;
      margin: 0 auto;
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>

  <h2>Tampilan Kamera 3D</h2>

  <model-viewer
    src="{{ asset('storage/3d/kamera.glb') }}"
    alt="Kamera 3D"
    auto-rotate
    camera-controls
    shadow-intensity="1"
    autoplay
    ar
    ar-modes="webxr scene-viewer quick-look">
  </model-viewer>

</body>
</html>
