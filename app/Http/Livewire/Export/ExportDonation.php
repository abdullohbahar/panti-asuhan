<?php

namespace App\Http\Livewire\Export;

use Livewire\Component;
use App\Exports\DonasiTunaiExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportDonation extends Component
{
    public $type;
    public $date1;
    public $date2;

    public function render()
    {
        return view('livewire.export.export-donation');
    }

    public function rules()
    {
        return [
            'date1' => 'required',
            'date2' => 'required',
            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date1.required' => 'Tanggal harus diisi',
            'date2.required' => 'Tanggal harus diisi',
            'type.required' => 'Tipe harus diisi',
        ];
    }

    public function update($fields)
    {
        $this->validateOnly($fields);
    }

    public function export()
    {
        $this->validate();

        return Excel::download(new DonasiTunaiExport($this->date1, $this->date2, $this->type), 'Donasi Tunai.xlsx');
    }
}
