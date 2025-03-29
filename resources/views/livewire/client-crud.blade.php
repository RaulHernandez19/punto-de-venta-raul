<div class="max-w-4xl mx-auto p-6 bg-gray-800 rounded-lg shadow-md">

    <form class="space-y-6" method="POST" wire:submit.prevent='saveCliente'>
        @csrf
        <h2 class="text-2xl font-bold text-white mb-6">Clientes</h2>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Nombre del Proveedor</label>
            <x-text-input wire:model='username' />
            @error('username') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Telefono</label>
            <x-text-input wire:model='telefono' />
            @error('telefono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        </div>


        <button type="submit" @disabled($editando === False)
        class="w-full bg-blue-600 text-white px-6 py-3 rounded-md
        hover:bg-blue-800 transition-colors block text-center">
            Editar Cliente
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

        <div class="bg-gray-900 rounded-lg p-4">
            <ul class="divide-y divide-gray-200">

                @forelse ( $clientes as $cliente)
                <li class="py-4 flex items-center justify-between hover:bg-gray-800 px-4 rounded">
                    <div class="flex items-center justify-between w-full">
                        <div class="flex">
                            <div class="ml-4">
                                <span class="font-medium text-gray-100">{{ $cliente->username }}</span>
                                <p class="text-gray-400">
                                     | Telefono: {{ $cliente->telefono }} | Nombre: {{ $cliente->telefono }} | Correo: {{ $cliente->user->email }}
                                </p>
                            </div>
                        </div>
                        <!-- Botones-->


                        <div class="flex space-x-2 ml-4">

                            <button
                               wire:click="editCliente({{ $cliente->id}})"
                                class="p-2 text-blue-500 hover:bg-blue-900 rounded-full"
                                title="Editar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </button>

                        </div>


                    </div>
                </li>
                @empty

                @endforelse
            </ul>
        </div>
    </div>



</div>

