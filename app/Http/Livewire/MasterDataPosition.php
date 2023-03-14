<?php

namespace App\Http\Livewire;

use Exception;
use Rollbar\Rollbar;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\MasterDataPosition as ModelsMasterDataPosition;

class MasterDataPosition extends Component
{
    public $name, $idPositions;
    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {
        $positions = ModelsMasterDataPosition::get();

        $data = [
            'positions' => $positions
        ];

        return view('livewire.master-data-position', $data);
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:master_data_positions,name',
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

            ModelsMasterDataPosition::create([
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
        $this->idPositions = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        ModelsMasterDataPosition::destroy($this->idPositions);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Data Berhasil Dihapus']);
    }
}
