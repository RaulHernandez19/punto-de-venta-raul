<?php

use App\Livewire\ClientCrud;
use App\Livewire\ClientMarket;
use App\Livewire\ProductoCrud;
use App\Livewire\Proveedor;
use App\Livewire\UserCrud;
use App\Livewire\VentasView;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::get('proveedores', Proveedor::class)->name('proveedores');

    Route::get('productos', ProductoCrud::class)->name('productos');

    Route::get('marketplace', ClientMarket::class)->name('marketplace');

    Route::get('ventas', VentasView::class)->name('ventas');

    Route::get('clientes', ClientCrud::class)->name('clientes');

    Route::get('users', UserCrud::class)->name('users');


require __DIR__.'/auth.php';
