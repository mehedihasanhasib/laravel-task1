<x-app-layout>
    @if (session('msg'))
        <div class="flex items-center p-4 mb-4 text-sm text-center text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                {{ session('msg') }}
            </div>
        </div>
    @endif
    <form method="POST" action="{{ route('color.store') }}" class="w-1/2 bg-white rounded-md p-6 mt-6 m-auto"
        enctype="multipart/form-data">
        @csrf

        <!-- Color -->
        <div>
            <x-input-label for="name" :value="__('Color')" />
            <x-text-input id="color" class="block mt-1 w-full" type="text" name="color" :value="old('color')" />
            <x-input-error :messages="$errors->get('color')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Add Color') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
