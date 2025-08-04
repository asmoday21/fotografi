<?php
namespace App\Exports;

use App\Models\HasilKuis;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HasilKuisExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = HasilKuis::with(['user', 'kuis'])->latest();

        if ($this->request->filled('search')) {
            $query->whereHas('user', function($q) {
                $q->where('name', 'like', '%' . $this->request->search . '%');
            });
        }

        if ($this->request->filled('kuis_id')) {
            $query->where('kuis_id', $this->request->kuis_id);
        }

        return view('admin.hasilkuis.export', [
            'hasilKuis' => $query->get()
        ]);
    }
}
