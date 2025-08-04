<?php
class Kamera extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'file_model'];

    public function hotspots()
    {
        return $this->hasMany(Hotspot::class);
    }
}
