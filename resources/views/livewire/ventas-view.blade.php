<div class="max-w-4xl mx-auto p-6 bg-gray-800 rounded-lg shadow-md">


        <h2 class="text-2xl font-bold text-white mb-6">Registro de Ventas</h2>


    <div class="mt-12">
        <div class="bg-gray-900 rounded-lg p-4">
            <ul class="divide-y divide-gray-200">

                @forelse ( $ventas as $venta)
                <li class="py-4 flex items-center justify-between hover:bg-gray-800 px-4 rounded">
                    <div class="flex items-center justify-between w-full">
                        <div class="flex">
                            <div class="ml-4">
                                <span class="font-medium text-gray-100">{{ $venta->producto->name }}</span>
                                <p class="text-gray-400">
                                     | Cantidad: {{ $venta->quantity }} | Fecha: {{ $venta->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>

                @empty

                @endforelse
            </ul>
        </div>
    </div>



</div>
