<?php

namespace App\Http\Livewire\ScheduleActivity;

use App\Models\ScheduleActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Create extends Component
{
    public $nomor_urut;
    public $tanggal;
    public $acara;
    public $pengundang;
    public $keterangan;

    public function render()
    {
        return view('livewire.schedule-activity.create')->extends('create-agenda', [
            'active' => 'create-agenda'
        ]);
    }

    public function rules()
    {
        return [
            'nomor_urut' => 'required|numeric',
            'tanggal' => 'required',
            'acara' => 'required',
            'pengundang' => 'required',
            'keterangan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nomor_urut.required' => 'Nomor urut harus diisi',
            'nomor_urut.numeric' => 'Nomor urut harus ANGKA',
            'tanggal.required' => 'Tanggal harus diisi',
            'acara.required' => 'Acara harus diisi',
            'pengundang.required' => 'Pengundang harus diisi',
            'keterangan.required' => 'Keterangan harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // Store data
            ScheduleActivity::create([
                'nomor_urut' => $this->nomor_urut,
                'tanggal' => $this->tanggal,
                'acara' => $this->acara,
                'pengundang' => $this->pengundang,
                'keterangan' => $this->keterangan,
            ]);

            DB::commit();
            // return redirect()->route('data.outcome.letter.lksa')->with('message', 'Surat Keluar Berhasil Ditambahkan');
        } catch (\Exception $e) {
            Log::critical($e);
            DB::rollBack();
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }
}
