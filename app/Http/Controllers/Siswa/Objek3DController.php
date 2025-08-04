<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Objek3D;

class Objek3DController extends Controller
{
    public function index()
    {
        $objek3d = Objek3D::all();
        return view('siswa.objek3d.index', compact('objek3d'));
    }

    
    public function show($id)
{
    $objek3d = Objek3D::findOrFail($id);
    return view('siswa.objek3d.show', compact('objek3d'));
}

}
