<?php

namespace App\Livewire;

use App\Repo\ProductoRepo;
use Livewire\Component;
use Livewire\WithFileUploads;

class ClientMarket extends Component
{
    use WithFileUploads;

    protected $repo;
    public function boot(ProductoRepo $repo){
        $this->repo = $repo;
    }
    public function render()
    {

        return view('livewire.client-market', [
            'productos' => $this->repo->getAll()
        ])->layout('layouts.app');
    }
}
