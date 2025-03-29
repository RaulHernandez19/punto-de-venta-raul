<?php

namespace App\Livewire;

use Livewire\Component;

class WishlistItems extends Component
{
    protected $listeners = ['wishlistUpdated' => 'render', 'toggleWishlist' => 'toggleVisibility'];
    public $show = false;

    public function removeFromWishlist($productoId)
    {


        auth()->user()->wishlist()->detach($productoId);
        $this->dispatch('wishlistUpdated');
    }

    public function toggleVisibility()
    {
        $this->show = !$this->show;
    }

    public function render()
    {
        $productos = auth()->check()
            ? auth()->user()->wishlist()->with('proveedor')->get()
            : collect();

        return view('livewire.wishlist-items', [
            'productos' => $this->show ? $productos : collect()
        ]);
    }
}
