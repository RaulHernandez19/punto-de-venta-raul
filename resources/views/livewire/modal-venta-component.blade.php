<div x-cloak x-data="{ showModal: @entangle('showModal') }" x-show="showModal"
     x-transition:enter="ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-[9999] overflow-y-auto">

    <!-- Fondo oscuro -->
    <div class="fixed inset-0 bg-black/80" @click="showModal = false"></div>

    <!-- Contenido del modal -->
    <div class="relative flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-md transform rounded-xl bg-gray-800 shadow-2xl transition-all border border-gray-700">
            <div class="p-6">
                <!-- Encabezado -->
                <div class="flex items-start justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="bg-green-900/30 p-3 rounded-full">
                            🛒
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">Registrar Venta</h2>
                            <p class="text-sm text-gray-400">Ingrese la cantidad a vender</p>
                        </div>
                    </div>
                    <button @click="showModal = false" class="text-gray-400 hover:text-white text-2xl">
                        &times;
                    </button>
                </div>

                <!-- Formulario -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Cantidad
                        </label>
                        <input type="number"
                               wire:model="cantSell"
                               class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-3
                                      focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none
                                      placeholder-gray-400"
                               placeholder="Ej: 5"
                               autofocus>

                        <div class="flex justify-between mt-2">
                            <span class="text-red-500 text-sm">
                                @error('cantSell') {{ $message }} @enderror
                            </span>
                            <span class="text-gray-400 text-sm">
                                Stock disponible: {{ $actualStock }} <!-- Aquí deberías inyectar el stock real -->
                            </span>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-3">
                        <button @click="showModal = false"
                                class="flex-1 px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-lg
                                       transition-colors duration-200">
                            Cancelar
                        </button>
                        <button wire:click="registrarVenta"

                                class="flex-1 px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg
                                       transition-colors duration-200 flex items-center justify-center gap-2"  {{ $cantSell > $actualStock ? 'bg-gray-400 cursor-not-allowed' : 'bg-green-600 hover:bg-green-700' }}>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Confirmar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
