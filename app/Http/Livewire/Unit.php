<?php

namespace App\Http\Livewire;

use App\Models\Unit as ModelsUnit;
use Livewire\Component;
use Livewire\WithPagination;

class Unit extends Component
{
    public $unit, $idUnit, $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {
        $search = '';

        $query = ModelsUnit::where(function ($q) use ($search) {
            $q->orwhere('unit', 'like', '%' . $this->search . '%');
        });

        $units = $query->paginate(10);
        $count = $units->count();

        $data = [
            'units' => $units,
            'count' => $count
        ];

        return view('livewire.unit', $data);
    }

    public function rules()
    {
        return [
            'unit' => 'required|unique:units'
        ];
    }

    public function messages()
    {
        return [
            'unit.required' => 'Satuan Harus Diisi',
            'unit.unique' => 'Satuan Sudah Ada',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $validateData = $this->validate();

        ModelsUnit::create($validateData);

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal', ['message' => 'Satuan Berhasil Ditambahkan']);
    }

    public function resetInput()
    {
        $this->unit = '';
    }

    public function show($id)
    {
        $unit = ModelsUnit::find($id);

        if ($unit) {
            $this->idUnit = $unit->id;
            $this->unit = $unit->unit;
        }
    }

    public function update()
    {
        $validateData = $this->validate();

        ModelsUnit::where('id', $this->idUnit)->update([
            'unit' => $this->unit
        ]);

        $this->dispatchBrowserEvent('close-modal', ['message' => 'Unit Berhasil Diubah']);
    }

    public function deleteConfirmation($id)
    {
        $this->idUnit = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        ModelsUnit::destroy($this->idUnit);
        $this->dispatchBrowserEvent('deleted', ['message' => 'Donasi Berhasil Dihapus']);
    }
}
