<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Uji Model 3D</title>
  <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</head>
<body style="margin:0; background:#eee; display:flex; justify-content:center; align-items:center; height:100vh">

  <model-viewer
    src="{{ asset('objek3d/test-model.glb') }}"
    type="model/gltf-binary"
    alt="Contoh 3D"
    auto-rotate
    camera-controls
    style="width: 600px; height: 600px;">
  </model-viewer>

</body>
</html>
