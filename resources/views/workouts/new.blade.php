<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Workout') }}
        </h2>
    </x-slot>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/workouts">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('workouts') }}">
        @csrf

        <!-- Title -->
            <div>
                <x-label for="title" :value="__('title')" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                         :value="old('title')" required autofocus />
            </div>

        <!-- Description -->
            <div>
                <x-label for="description" :value="__('description')" />

                <textarea id="description" class="block mt-1 w-full"  name="description"
                          required autofocus >
                    {{old('description')}}
                </textarea>
            </div>


        <!-- Category -->
            <div>
                <x-label for="category_id" :value="__('Category')" />
                <ul class="checkboxes">
                    @forelse($categories as $category)
                    <li>
                        <label>
                            <input name="category_id[]" type="checkbox" value="{{$category->id}}">

                            {{$category->title}}
                        </label>
                    </li>


                    @empty
                    <li>
                        <label>
                            <input name="category_id[]" value="1">
                            lads
                        </label>
                    </li>

                    @endforelse
                </ul>
            </div>

            <!-- Url -->
            <div class="mt-4">
                <x-label for="url" :value="__('url')" />

                <x-input id="url" class="block mt-1 w-full"
                         type="text"
                         name="url"
                         :value="old('url')"
                         required  />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Submit') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
