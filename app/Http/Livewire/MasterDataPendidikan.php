<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Rollbar\Rollbar;
use App\Models\MasterDataPendidikan as ModelPendidikan;

class MasterDataPendidikan extends Component
{
    public $name, $idPendidikan;
    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {
        $pendidikans = ModelPendidikan::get();

        $data = [
            'pendidikans' => $pendidikans
        ];

        return view('livewire.master-data-pendidikan', $data);
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:master_data_pendidikans,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pendidikan harus diisi',
            'name.unique' => 'Pendidikan sudah ada',
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

            ModelPendidikan::create([
                'name' => $this->name
            ]);

            DB::commit();

            $this->dispatchBrowserEvent('show-success', ['message' => 'Berhasil']);
            $this->name = '';
        } catch (Exception $e) {
            Rollbar::critical($e);
            DB::rollBack();
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }

    public function deleteConfirmation($id)
    {
        $this->idPendidikan = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        ModelPendidikan::destroy($this->idPendidikan);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Data Berhasil Dihapus']);
    }
}
