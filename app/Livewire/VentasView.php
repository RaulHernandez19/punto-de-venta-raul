<?php

namespace App\Livewire;

use App\Repo\VentaRepo;
use Livewire\Component;

class VentasView extends Component
{
    protected $repo;
    public function boot(VentaRepo $repo){
        $this->repo = $repo;
    }

    public function render()
    {

        return view('livewire.ventas-view',
        [
            'ventas' => $this->repo->getAll()
        ])->layout('layouts.app');

    }
}
