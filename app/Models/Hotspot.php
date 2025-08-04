<?php
class Hotspot extends Model
{
    protected $fillable = ['kamera_id', 'label', 'keterangan', 'position', 'icon'];

    public function kamera()
    {
        return $this->belongsTo(Kamera::class);
    }
}
