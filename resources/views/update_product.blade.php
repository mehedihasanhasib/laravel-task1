<x-app-layout>
    <form method="POST" action="{{ route('product.update', $product->id) }}"
        class="w-1/2 bg-white rounded-md p-6 mt-6 m-auto" enctype="multipart/form-data">
        @csrf
        @method('put')
        <!-- Title -->
        <div>
            <x-input-label for="name" :value="__('Title')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="title" :value="$product->title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Price -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="$product->details->price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <!-- Brand -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Brand')" />
            <select class="block mt-1 w-full rounded-md" name="brand" value="{{ old('brand') ?? null }}">
                <option value=""></option>
                <option {{ $product->details->brand == 'yellow' ? 'selected' : null }} value="yellow">Yellow</option>
                <option {{ $product->details->brand == 'sailor' ? 'selected' : null }} value="sailor">Sailor</option>
                <option {{ $product->details->brand == 'easy' ? 'selected' : null }} value="easy">Easy</option>
            </select>
            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
        </div>

        <!-- Color -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Color')" />
            <select class="block mt-1 w-full rounded-md" name="color" value="{{ old('color') ?? null }}">
                <option value=""></option>
                <option {{ $product->details->color == 'red' ? 'selected' : null }} value="red">Red</option>
                <option {{ $product->details->color == 'blue' ? 'selected' : null }} value="blue">Blue</option>
                <option {{ $product->details->color == 'green' ? 'selected' : null }} value="green">Green</option>
            </select>
            <x-input-error :messages="$errors->get('color')" class="mt-2" />
        </div>

        <!-- Size -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Size')" />
            <select class="block mt-1 w-full rounded-md" name="size" value="{{ old('size') ?? null }}">
                <option value=""></option>
                <option {{ $product->details->size == 'S' ? 'selected' : null }} value="S">S</option>
                <option {{ $product->details->size == 'M' ? 'selected' : null }} value="M">M</option>
                <option {{ $product->details->size == 'L' ? 'selected' : null }} value="L">L</option>
                <option {{ $product->details->size == 'XL' ? 'selected' : null }} value="XL">XL</option>
            </select>
            <x-input-error :messages="$errors->get('size')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Add Product') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
