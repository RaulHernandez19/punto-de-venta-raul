<?php

namespace App\Livewire;

use App\Repo\ProductoRepo;
use App\Repo\VentaRepo;
use Livewire\Component;
use Livewire\Attributes\Rule;

class ModalVentaComponent extends Component
{

    protected $repo;
    protected $ProdRepo;
    public function boot(VentaRepo $repo, ProductoRepo $ProdRepo){
        $this->ProdRepo = $ProdRepo;
        $this->repo=$repo;
    }
    protected $listeners = ['abrirModal' => 'abrirModal'];
    public $showModal = false;

    public $actualStock;

    #[Rule('required|numeric|min:1')]
    public $cantSell;

    public $producto_id;

    public function abrirModal($id=null)
    {
        $this->producto_id = $id;
        $tempProducto=$this->ProdRepo->getProducto($id);
        $this->actualStock = $tempProducto->stock;

        $this->showModal = true;
    }

    public function registrarVenta(){

        if ($this->cantSell > $this->actualStock) {
            $this->addError('cantSell', 'No hay suficiente stock disponible.');
            return;
        }else{

        $tempProducto=$this->ProdRepo->getProducto($this->producto_id);

        $newQuantity= $tempProducto->stock - $this-> cantSell;

        $dataProd=[
            'name'=>$tempProducto->name,
            'descripcion'=>$tempProducto->descripcion,
            'price'=>$tempProducto->price,
            'public_price'=>$tempProducto->public_price,
            'stock'=>$newQuantity,
            'proveedor_id'=>$tempProducto->proveedor_id,
        ];


        $data=[
            'producto_id'=>$this->producto_id,
            'quantity'=>$this->cantSell];


        $this->repo->save($data);
        $this->ProdRepo->edit($this->producto_id,$dataProd);

        //$this->dispatchTo('producto-crud', 'actualizarStock', id: $newQuantity);
        $this->dispatch('actualizarStock')->to('producto-crud');
        $this->closeModal();
        }
    }



    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.modal-venta-component');
    }
}
