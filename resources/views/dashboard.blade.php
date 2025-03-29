<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido dinámico -->
            @auth
                @if(auth()->user()->hasRole('admin'))
                    @livewire('producto-crud')
                @endif

                @if(auth()->user()->hasRole('client'))
                    @livewire('client-market')
                @endif
            @endauth
        </div>
    </div>
</x-app-layout>
