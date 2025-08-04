<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HasilKuis;
use App\Models\Kuis;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HasilKuisExport;

class HasilKuisController extends Controller
{
    public function index(Request $request)
    {
        $kuisList = Kuis::all();
        $query = HasilKuis::with(['user', 'kuis'])->latest();

        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('kuis_id')) {
            $query->where('kuis_id', $request->kuis_id);
        }

        $hasilKuis = $query->get();

        return view('admin.hasilkuis.index', compact('hasilKuis', 'kuisList'));
    }

    public function export(Request $request)
    {
        return Excel::download(new HasilKuisExport($request), 'hasil-kuis.xlsx');
    }
}
