<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class ClienteList extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $nombre;
    public $search;
    public $campoorden = 'id';
    public $direccion = 'asc';


    public function render()
    {
        $clientes = User::where('role', 'user')->where(function($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('surname', 'like', '%' . $this->search . '%')
                  ->orWhere('tlf', 'like', '%' . $this->search . '%')
                  ->orWhere('dni', 'like', '%' . $this->search . '%');
        })->orderBy($this->campoorden, $this->direccion)->paginate(5);
        return view('livewire.cliente-list')->with('clientes', $clientes);
    }

    public function ordenarNombre(){
        $this->campoorden = "name";
        $this->ordenar();
    }

    public function ordenarApellido(){
        $this->campoorden = "surname";
        $this->ordenar();
    }

    public function ordenarDni(){
        $this->campoorden = "dni";
        $this->ordenar();
    }

    public function ordenarTlf(){
        $this->campoorden = "tlf";
        $this->ordenar();
    }

    public function ordenarId(){
        $this->campoorden = "id";
        $this->ordenar();
    }

    public function ordenar(){
        if($this->direccion == "asc"){
            $this->direccion = "desc";
        }else{
            $this->direccion = "asc";
        }
    }

    //Funcion que nos deja encontrar clientes de las primeras paginas de la paginacion en las siguientes
    public function updatingSearch(){
        $this->resetPage();
    }
}
