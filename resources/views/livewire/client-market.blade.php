
    <div class="min-h-screen bg-gray-900  px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-white mb-8">Marketplace</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($productos as $producto)
                    <div class="relative bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <!-- Botón Wishlist -->
                        <div class="absolute top-2 right-2 z-10">
                            <livewire:wishlist-manager :productoId="$producto->id" :key="'wishlist-'.$producto->id"/>
                        </div>

                        <!-- Imagen del producto -->
                        @if($producto->image_path)
                            <img src="{{ Storage::url($producto->image_path) }}"
                                 alt="{{ $producto->name }}"
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-700 flex items-center justify-center">
                                <span class="text-gray-400">Sin imagen</span>
                            </div>
                        @endif

                        <!-- Contenido del producto -->
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-white mb-2">{{ $producto->name }}</h3>
                            <p class="text-gray-400 mb-4">{{ $producto->descripcion }}</p>

                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-2xl font-bold text-indigo-400">
                                        ${{ number_format($producto->public_price, 2) }}
                                    </span>

                                </div>
                                <span class="text-sm bg-green-600 text-white px-2 py-1 rounded-full">
                                    {{ $producto->stock }} en stock
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
