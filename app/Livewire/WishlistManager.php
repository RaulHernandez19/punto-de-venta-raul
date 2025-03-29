<?php

namespace App\Livewire;

use Livewire\Component;

class WishlistManager extends Component
{
    public $productoId;

    public function toggleWishlist()
    {


        $user = auth()->user();
        $user->wishlist()->toggle($this->productoId);
    }

    public function render()
    {
        $enWishlist = auth()->check()
            ? auth()->user()->wishlist->contains($this->productoId)
            : false;

        return view('livewire.wishlist-manager', [
            'enWishlist' => $enWishlist
        ]);
    }
}
