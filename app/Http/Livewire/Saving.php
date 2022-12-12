<?php

namespace App\Http\Livewire;

use App\Models\AnakAsuh;
use App\Models\Saving as ModelsSaving;
use Livewire\Component;

class Saving extends Component
{
    public $anak_asuh_id, $search;

    public function render()
    {
        $search = '';

        $query = ModelsSaving::whereHas('anakAsuh', function ($q) use ($search) {
            $q->where('nama_lengkap', 'like', '%' . $this->search . '%');
        });

        $savings = $query->paginate(10);
        $count = $savings->count();

        $childs = AnakAsuh::get();
        $data = [
            'savings' => $savings,
            'count' => $count,
            'childs' => $childs
        ];

        return view('livewire.saving', $data);
    }

    public function rules()
    {
        return [
            'anak_asuh_id' => 'required|unique:savings,anak_asuh_id'
        ];
    }

    public function messages()
    {
        return [
            'anak_asuh_id.required' => 'Nama anak asuh harus diisi',
            'anak_asuh_id.unique' => 'Nama anak asuh sudah terdaftar',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();

        ModelsSaving::create([
            'anak_asuh_id' => $this->anak_asuh_id,
            'total_tabungan' => 0,
        ]);

        $this->resetInput();
    }

    public function resetInput()
    {
        $this->anak_asuh_id = '';
    }
}
