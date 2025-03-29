
<div class="max-w-4xl mx-auto p-6 bg-gray-800 rounded-lg shadow-md">

    <form class="space-y-6" method="POST" wire:submit.prevent='saveProducto'>
        @csrf
        <h2 class="text-2xl font-bold text-white mb-6">Agregar Nuevo {{ __('Producto') }}</h2>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Nombre del Producto</label>
                <x-text-input wire:model='name' />
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Precio Venta</label>
                <x-text-input type='number' wire:model='price' />
                @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Costo Adquisicion</label>
                <x-text-input type='number' wire:model='public_price' />
                @error('public_price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror


            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Cantidad</label>
                <x-text-input type='number' wire:model='stock' />
                @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Proveedor</label>
                <select wire:model="proveedor_id"
                        class="w-full px-4 py-2 border-gray-700 bg-gray-900 text-gray-300 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm w-full ">
                    <option value="">Seleccione un proveedor</option>
                    @foreach($proveedores as $proveedor)
                        <option class="text-gray-300" value="{{ $proveedor->id }}">{{ $proveedor->name }}</option>
                    @endforeach
                </select>
                @error('proveedor_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror


            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Descripcion</label>
                <x-text-input wire:model='descripcion' />
                @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            </div>


        </div>

        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-300 mb-2">Imagen del Producto</label>

            <!-- Vista previa -->
            @if($previewImage)
                <div class="mb-4">
                    <img src="{{ $previewImage }}" alt="Vista previa" class="h-32 w-32 object-cover rounded">
                </div>
            @endif

            <!-- Input de imagen -->
            <div class="flex items-center">
                <label for="image_path" class="cursor-pointer bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md mr-2 transition-colors">
                    Seleccionar Imagen
                </label>
                <input
                    type="file"
                    wire:model="image_path"
                    id="image_path"
                    class="hidden"
                    accept="image/*"
                >

                <span class="text-gray-300 text-sm">
                    @if($image_path)
                        {{ $image_path->getClientOriginalName() }}
                    @else
                        Ningún archivo seleccionado
                    @endif
                </span>
            </div>

            @error('image_path') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
                    class="w-full bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-800 transition-colors">
                    {{ $editando ? 'Actualizar Producto' : 'Guardar Producto' }}
            </button>
            @if ($editando)
            <button wire:click="cancelEdit" type="button"
            class="w-full bg-gray-600 text-white px-6 py-3 rounded-md
            hover:bg-gray-700 transition-colors flex-1 flex items-center justify-center">

            Cancelar
        </button>
        @endif

    </form>

    <div class="mt-12">
        <h3 class="text-xl font-semibold text-white mb-4">Lista de Productos</h3>
        <div class="bg-gray-900 rounded-lg p-4">
            <ul class="divide-y divide-gray-200">
                @foreach ( $productos as $producto)
                <li class="py-4 flex items-center justify-between hover:bg-gray-800 px-4 rounded">
                    <div class="flex items-center justify-between w-full">


                        <div class="flex">

                            @if($producto->image_path)
                            <!--<img src="{{ asset('storage/' . $producto->image_path) }}" class="w-16 h-16 object-cover rounded">-->


                            <img src="{{ Storage::url($producto->image_path) }}" class="w-16 h-16 object-cover rounded">
                        @endif

                            <div class="ml-4">
                                <span class="font-medium text-gray-100">{{ $producto->name }}</span>
                                <p class="text-gray-400">
                                     | Precio: {{ $producto->price }}
                                     | Precio Adquisicion: {{ $producto->public_price }}
                                     | Cantidad: {{ $producto->stock }} <br>
                                     | Descripcion: {{ $producto->descripcion }}
                                </p>
                            </div>
                        </div>
                        <!-- Botones-->


                        <div class="flex space-x-2 ml-4">

                            <button
                                 wire:click="$dispatchTo('modal-venta-component', 'abrirModal',{ 'id': {{ $producto->id }} })"
                                class="p-2 text-green-600 hover:bg-green-900 rounded-full"
                                title="Vender"
                                @disabled($producto->stock <= 0)>
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cash-register"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 15h-2.5c-.398 0 -.779 .158 -1.061 .439c-.281 .281 -.439 .663 -.439 1.061c0 .398 .158 .779 .439 1.061c.281 .281 .663 .439 1.061 .439h1c.398 0 .779 .158 1.061 .439c.281 .281 .439 .663 .439 1.061c0 .398 -.158 .779 -.439 1.061c-.281 .281 -.663 .439 -1.061 .439h-2.5" /><path d="M19 21v1m0 -8v1" /><path d="M13 21h-7c-.53 0 -1.039 -.211 -1.414 -.586c-.375 -.375 -.586 -.884 -.586 -1.414v-10c0 -.53 .211 -1.039 .586 -1.414c.375 -.375 .884 -.586 1.414 -.586h2m12 3.12v-1.12c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2" /><path d="M16 10v-6c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-4c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414v6m8 0h-8m8 0h1m-9 0h-1" /><path d="M8 14v.01" /><path d="M8 17v.01" /><path d="M12 13.99v.01" /><path d="M12 17v.01" /></svg>
                            </button>

                            <button
                               wire:click="editProducto({{ $producto->id}})"
                                class="p-2 text-blue-500 hover:bg-blue-900 rounded-full"
                                title="Editar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </button>

                            <button
                                wire:click="deleteProducto({{ $producto->id }})"
                                class="p-2 text-red-500 hover:bg-red-900 rounded-full"
                                title="Eliminar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>

                        </div>


                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>


    <livewire:modal-venta-component />


</div>


