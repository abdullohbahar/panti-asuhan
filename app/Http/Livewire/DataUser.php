<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DataUser extends Component
{
    public $search, $idUser;
    protected $listeners = ['deleteConfirmed' => 'destroy'];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $search = '';

        $query = User::where(function ($q) use ($search) {
            $q->orwhere('username', 'like', '%' . $this->search . '%');
        });

        $users = $query->orderBy('username', 'asc')->paginate(10);
        $count = $users->count();

        $data =  [
            'users' => $users,
            'count' => $count
        ];

        return view('livewire.data-user', $data);
    }

    public function deleteConfirmation($id)
    {
        $this->idUser = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        User::destroy($this->idUser);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Pengguna Berhasil Dihapus']);
    }
}
