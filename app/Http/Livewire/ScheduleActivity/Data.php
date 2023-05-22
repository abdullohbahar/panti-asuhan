<?php

namespace App\Http\Livewire\ScheduleActivity;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ScheduleActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Data extends Component
{
    public $search;
    public $agendaId;
    public $nomor_hp_pengundang;
    public $tanggal;
    public $acara;
    public $pengundang;
    public $keterangan;
    protected $listeners = ['deleteConfirmed' => 'destroy'];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $agendas = ScheduleActivity::when(!empty($this->search), function ($query) {
            $query->where('acara', $this->search);
        })->orderBy('tanggal')->paginate(20);

        $data = [
            'agendas' => $agendas
        ];

        return view('livewire.schedule-activity.data', $data)->extends('data-agenda-kegiatan', [
            'active' => 'data-agenda'
        ]);
    }

    public function show($id)
    {
        $this->agendaId = $id;

        $agendas = ScheduleActivity::findorfail($id);

        $this->nomor_hp_pengundang = $agendas->nomor_hp_pengundang;
        $this->tanggal = $agendas->tanggal;
        $this->acara = $agendas->acara;
        $this->pengundang = $agendas->pengundang;
        $this->keterangan = $agendas->keterangan;
    }

    public function rules()
    {
        return [
            'nomor_hp_pengundang' => 'required',
            'tanggal' => 'required',
            'acara' => 'required',
            'pengundang' => 'required',
            'keterangan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nomor_hp_pengundang.required' => 'Nomor urut harus diisi',
            'tanggal.required' => 'Tanggal harus diisi',
            'acara.required' => 'Acara harus diisi',
            'pengundang.required' => 'Pengundang harus diisi',
            'keterangan.required' => 'Keterangan harus diisi',
        ];
    }

    public function update()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // update data
            ScheduleActivity::where('id', $this->agendaId)->update([
                'nomor_hp_pengundang' => $this->nomor_hp_pengundang,
                'tanggal' => $this->tanggal,
                'acara' => $this->acara,
                'pengundang' => $this->pengundang,
                'keterangan' => $this->keterangan,
            ]);

            DB::commit();
            return redirect()->route('data.agenda.kegiatan')->with('message', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            Log::critical($e);
            DB::rollBack();
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }

    public function deleteConfirmation($id, $destroyBerkas)
    {
        $this->agendaId = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        ScheduleActivity::destroy($this->agendaId);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Data Berhasil Dihapus']);
    }
}
