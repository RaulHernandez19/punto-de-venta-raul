<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Repo\ClientRepo;
use Livewire\Component;
use Livewire\Attributes\Rule;

class ClientCrud extends Component
{
    public $editando = false;
    protected $repo;

    #[Rule('required|min:4|max:30')]
    public $username = '';

    #[Rule('required|numeric|digits_between:6,15')]
    public $telefono = '';

    public $cliente_id;

    public function boot(ClientRepo $repo)
    {
        $this->repo = $repo;
    }

    public function saveCliente()
    {
        $this->validate();

        $data = [
            'username' => $this->username,
            'telefono' => $this->telefono
        ];

        if($this->editando) {
            $this->repo->edit($this->cliente_id, $data);
        }

        $this->cancelEdit();
    }

    public function editCliente($id)
    {
        $this->editando = true;
        $this->cliente_id = $id;

        $cliente = $this->repo->getClient($id);

        $this->username = $cliente->username;
        $this->telefono = $cliente->telefono;
    }

    public function deleteCliente($id)
    {
        $this->repo->delete($id);
    }

    public function cancelEdit()
    {
        $this->reset(['editando', 'cliente_id', 'username', 'telefono']);
    }

    public function render()
    {
        return view('livewire.client-crud', [
            'clientes' => $this->repo->getAll()
        ])->layout('layouts.app');
    }
}
