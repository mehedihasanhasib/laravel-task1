<x-app-layout>
    <div
        class="bg-white mx-auto my-10 flex max-w-xs flex-col items-center rounded-xl border px-4 py-4 text-center md:max-w-lg md:flex-row md:items-start md:text-left">
        <div class="mb-4 md:mr-6 md:mb-0">
            <img class="h-56 rounded-lg object-cover md:w-56"
                src="{{ asset('product_images/' . $product->details->image) }}" alt="" />
        </div>
        <p class="text-xl font-medium text-gray-700">{{ $product->title }}</p>
        <p class="mb-4 text-sm font-medium text-gray-500">Price: {{ $product->details->price }}</p>
        <div class="">

            <div class="flex">
                <div class="flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                    <p class="text-sm font-medium text-gray-500">Color</p>
                    <p class="text-3xl font-medium text-gray-600">{{ $product->details->color }}</p>
                </div>
                <div class="flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2 m-2">
                    <p class="text-sm font-medium text-gray-500">Size</p>
                    <p class="text-3xl font-medium text-gray-600">{{ $product->details->size }}</p>
                </div>
                <div class="flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                    <p class="text-sm font-medium text-gray-500">Brand</p>
                    <p class="text-3xl font-medium text-gray-600">{{ $product->details->brand }}</p>
                </div>
                <div class=""></div>
            </div>
        </div>
    </div>
</x-app-layout>
