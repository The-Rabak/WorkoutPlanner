<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>

        <x-basic-link :href="route('newCategory')">
            <h3 class="font-semibold text-blue-400 float-right mb-2">
                {{ __('Add New Category') }}
            </h3>
        </x-basic-link>
    </x-slot>

    @forelse($categories as $category)
        @include('categories.category-tab')

    @empty
        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        lads
                    </div>
                </div>
            </div>
        </div>
    @endforelse
</x-app-layout>
