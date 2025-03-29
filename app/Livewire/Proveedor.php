<?php

namespace App\Livewire;

use App\Repo\ProveedorRepo;
use Livewire\Component;
use Livewire\Attributes\Rule;
class Proveedor extends Component
{
    public $editando=false;
    protected $repo;

    #[Rule('required|min:4')]
    public $name='';

    #[Rule('required|numeric|min:6')]
    public $phone= '';

    public $proveedor_id;


    public function boot(ProveedorRepo $repo){
        $this->repo = $repo;
    }

    public function addProveedor(){

        $this->validate();

        $data = [
            'name' => $this->name,
            'phone' => $this->phone
        ];


        if($this->editando){
            $this->repo->edit($this->proveedor_id , $data);
            $this->editando = false;
        }else{
            $this->repo->save($data);
        }

        $this->cancelEdit();

    }

    public function editProveedor($id){
        $this->editando = true;
        $this->proveedor_id=$id;

        $tempProveedor=$this->repo->getProveedor($id);

        $this->name=$tempProveedor->name;
        $this->phone=$tempProveedor->phone;

    }

    public function cancelEdit(){
        $this->editando = false;
        $this->name='';
        $this->phone='';
    }

    public function deleteProveedor($id){

        $this->repo->delete($id );
        $this->productos=$this->repo->getAll();
    }


    public function render()
    {

        return view('livewire.proveedor',
        [
            'proveedores' => $this->repo->getAll()
        ])->layout('layouts.app');

    }
}
