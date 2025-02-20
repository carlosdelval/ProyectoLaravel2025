<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HistorialVista;
use App\Models\User;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;

class HistorialVistaList extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $direccion = 'asc';
    protected $listeners = ['refreshHistorial' => '$refresh'];
    public $id;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteHistorial($id)
    {
        HistorialVista::findOrFail($id)->delete();
    }

    public function render(User $user)
    {
        if(Auth::user()->role === "admin"){
            $historial = HistorialVista::whereHas('cita', function ($query) {
                $query->whereDate('fecha', 'like', "%{$this->search}%");
            })
                ->join('citas', 'citas.id', '=', 'historial_vista.cita_id')
                ->select('historial_vista.*')
                ->where('citas.user_id', $this->id)
                ->orderBy('citas.fecha', $this->direccion)
                ->paginate(5);
        } else {
            $historial = HistorialVista::whereHas('cita', function ($query) {
                $query->whereDate('fecha', 'like', "%{$this->search}%");
            })
                ->join('citas', 'citas.id', '=', 'historial_vista.cita_id')
                ->select('historial_vista.*')
                ->where('citas.user_id', Auth::id())
                ->orderBy('citas.fecha', $this->direccion)
                ->paginate(5);
        }

        return view('livewire.historial-vista-list', compact('user', 'historial'));
    }
    public function ordenar()
    {
        if ($this->direccion == "asc") {
            $this->direccion = "desc";
        } else {
            $this->direccion = "asc";
        }
    }
}
