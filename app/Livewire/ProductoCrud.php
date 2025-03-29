<?php

namespace App\Livewire;

use App\Repo\ProductoRepo;
use App\Repo\ProveedorRepo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class ProductoCrud extends Component
{
    use WithFileUploads;
    public $editando=false;
    protected $repo;
    protected $provRepo;


    public $proveedores=[];


    protected $listeners = ['actualizarStock' => 'actualizarStock'];

    public function boot(ProductoRepo $repo, ProveedorRepo $provRepo){
        $this->repo = $repo;
        $this->provRepo = $provRepo;
    }

    #[Rule('required|min:4')]
    public $name='';

    #[Rule('required|min:4')]
    public $descripcion='';
    #[Rule('required|numeric|min:0')]
    public $price='';
    #[Rule('required|numeric|min:0')]
    public $public_price='';
    #[Rule('required|integer|min:0')]
    public $stock='';
    #[Rule('nullable|image|max:2048')]
    public $image_path=null;
    #[Rule('required|exists:proveedors,id')]
    public $proveedor_id='';

    public $producto_id= '';

    public $previewImage;
    public function saveProducto(){

        $this->validate();

        $data=[
        'name'=>$this->name,
        'descripcion'=>$this->descripcion,
        'price'=>$this->price,
        'public_price'=>$this->public_price,
        'stock'=>$this->stock,
        'proveedor_id'=>$this->proveedor_id,

        ];

       if ($this->image_path) {

        if ($this->editando) {
            $oldProducto = $this->repo->getProducto($this->producto_id);
            if ($oldProducto->image_path) {
                Storage::disk('public')->delete($oldProducto->image_path);
            }
        }

       // $imagePath = $this->image_path->store('productos', 'public');
       // $data['image_path'] = $imagePath;
       $data['image_path'] = $this->image_path->store('productos', 'public');
    }

        if($this->editando){
            $this->repo->edit($this->producto_id, $data);
        }else{
            $this->repo->save($data);
        }


        $this->clearForm();
    }

    public function editProducto($id)
    {

        $this->editando = true;
        $this->producto_id = $id;

        $producto = $this->repo->getProducto($id);

        // Cargar datos del producto
        $this->name = $producto->name;

        $this->descripcion = $producto->descripcion;
        $this->price = $producto->price;
        $this->public_price = $producto->public_price;
        $this->stock = $producto->stock;
        $this->proveedor_id = $producto->proveedor_id;


        $this->previewImage = $producto->image_path
        ? asset('storage/' . $producto->image_path)
        : null;
    }

    public function deleteProducto($id){
        $this->repo->delete($id);
    }

    public function updatedImagePath()
    {
        $this->validateOnly('image_path');
        if ($this->image_path) {
            $this->previewImage = $this->image_path->temporaryUrl();
        }
    }



    public function clearForm(){
        $this->name='';
        $this->descripcion='';
        $this->price='';
        $this->public_price='';
        $this->stock='';
        $this->proveedor_id='';
        $this->image_path=null;

        $this->editando=false;
        $this->producto_id = null;
        $this->previewImage = null;
    }

    public function actualizarStock(){
        return redirect(request()->header('Referer'));
    }

    public function mount()
    {
        $this->proveedores = $this->provRepo->getProvByNames();

    }

    public function render()
    {

        return view('livewire.producto-crud', [
            'productos' => $this->repo->getAll(),
            'proveedores' => $this->proveedores
        ])->layout('layouts.app');
    }
}
