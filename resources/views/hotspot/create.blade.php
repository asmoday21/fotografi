<form method="POST" action="{{ route('hotspot.store') }}">
    @csrf
    <input type="hidden" name="kamera_id" value="{{ $kamera->id }}">
    <input type="text" name="label" placeholder="Label">
    <textarea name="keterangan" placeholder="Keterangan"></textarea>
    <input type="text" name="position" placeholder="Contoh: 0m 0.2m 0.5m">
    <input type="text" name="icon" placeholder="Icon (emoji)">
    <button type="submit">Tambah Hotspot</button>
</form>
