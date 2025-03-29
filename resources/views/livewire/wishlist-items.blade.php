<div
    class="fixed inset-y-0 right-0 w-96 bg-gray-800 shadow-xl p-6 overflow-y-auto transition-transform duration-300 transform"
    x-data="{ show: @entangle('show') }"
    x-show="show"
    x-transition:enter="translate-x-0"
    x-transition:leave="translate-x-full"
>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-white">Mi Lista de Deseos</h2>
        <button
            @click="show = false"
            class="text-gray-400 hover:text-white transition-colors"
        >
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    @if($productos->isEmpty())
        <p class="text-gray-400">No tienes productos en tu lista de deseos</p>
    @else
        <div class="space-y-4">
            @foreach($productos as $producto)
                <div class="flex items-center justify-between bg-gray-700 rounded-lg p-4 hover:bg-gray-600 transition-colors">
                    <div class="flex items-center space-x-4">
                        @if($producto->image_path)
                            <img src="{{ asset('storage/' . $producto->image_path) }}"
                                 alt="{{ $producto->name }}"
                                 class="w-16 h-16 object-cover rounded">
                        @else
                            <div class="w-16 h-16 bg-gray-500 rounded flex items-center justify-center">
                                <span class="text-gray-300 text-xs">Sin imagen</span>
                            </div>
                        @endif

                        <div>
                            <h3 class="text-lg font-semibold text-white">{{ $producto->name }}</h3>
                            <p class="text-gray-400 text-sm">
                                Stock: {{ $producto->stock }}
                            </p>
                        </div>
                    </div>

                    <button
                        wire:click="removeFromWishlist({{ $producto->id }})"
                        class="text-red-500 hover:text-red-400 transition-colors"
                        title="Quitar de la lista">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</div>
