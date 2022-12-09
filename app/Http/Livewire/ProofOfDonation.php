<?php

namespace App\Http\Livewire;

use App\Models\BuktiSumbangan;
use App\Models\Donation;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProofOfDonation extends Component
{
    public $idproof, $file, $iteration, $idfile;
    use WithFileUploads;
    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {
        $media = BuktiSumbangan::where('donation_id', $this->idproof)->get();
        $from = Donation::find($this->idproof);

        $data = [
            'files' => $media,
            'name' => $from
        ];

        return view('livewire.proof-of-donation', $data);
    }

    public function rules()
    {
        return [
            'file' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $validateData = $this->validate();

        $photo = $this->file->store('photo', 'public');


        BuktiSumbangan::create([
            'donation_id' => $this->idproof,
            'file' => $photo
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal', ['message' => 'Berhasil Upload Bukti Donasi']);
    }

    public function resetInput()
    {
        $this->file = '';
        $this->iteration++;
    }

    public function deleteConfirmation($id)
    {
        $this->idfile = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        $image = BuktiSumbangan::find($this->idfile);

        if ($image) {
            unlink(public_path('storage/' . $image->file));
        }

        BuktiSumbangan::destroy($this->idfile);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Donasi Berhasil Dihapus']);
    }
}
