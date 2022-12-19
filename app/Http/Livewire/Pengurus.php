<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pengurus as ModelsPengurus;

class Pengurus extends Component
{
    public $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $search = '';

        $query = ModelsPengurus::where(function ($q) use ($search) {
            $q->orwhere('nama', 'like', '%' . $this->search . '%')
                ->orwhere('jabatan', 'like', '%' . $this->search . '%');
        });

        $penguruses = $query->orderBy('nama', 'asc')->paginate(10);
        $count = $penguruses->count();

        $data =  [
            'penguruses' => $penguruses,
            'count' => $count
        ];

        return view('livewire.pengurus', $data);
    }
}
