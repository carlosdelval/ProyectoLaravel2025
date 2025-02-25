<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cita;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class CitasProgramadas extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $fecha;
    public $search;
    public $campoorden = 'fecha';
    public $direccion = 'asc';


    public function render()
    {
        if (Auth::user()->role === 'admin') {
            $citas = Cita::where('graduada', 0)->where(function ($query) {
                $query->where('fecha', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('optica', function ($query) {
                        $query->where('nombre', 'like', '%' . $this->search . '%');
                    });
            })->orderBy($this->campoorden, $this->direccion)->orderBy('hora', 'asc')->paginate(5);
        } else {
            $citas = Cita::where('user_id', Auth::id())->where('graduada', 0)->where(function ($query) {
                $query->where('fecha', 'like', '%' . $this->search . '%')
                    ->orWhere('user_id', 'like', '%' . $this->search . '%')
                    ->orWhere('optica_id', 'like', '%' . $this->search . '%');
            })->orderBy('fecha', 'asc')->paginate(5);
        }
        return view('livewire.citas-programadas')->with('citas', $citas);
    }

    public function deleteCita($cita_id)
    {
        Cita::find($cita_id)->delete();
    }

    public function ordenarFecha()
    {
        $this->campoorden = "fecha";
        $this->ordenar();
    }

    public function ordenarOptica()
    {
        $this->campoorden = "optica_id";
        $this->ordenar();
    }

    public function ordenar()
    {
        if ($this->direccion == "asc") {
            $this->direccion = "desc";
        } else {
            $this->direccion = "asc";
        }
    }

    //Funcion que nos deja encontrar citas de las primeras paginas de la paginacion en las siguientes
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
