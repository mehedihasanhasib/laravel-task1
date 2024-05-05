<x-app-layout>
    <div class="bg-red-500 h-[356px] w-1/2 m-auto mt-6 rounded-md p-3">
        <div class="mb-2">
            <h1 class="text-4xl">Title: {{ $product->title }}</h1>
        </div>
        <div class="flex gap-2 ">
            <div>
                <img width="330" class="rounded-md" src="{{ asset('product_images/' . $product->details->image) }}"
                    alt="">
            </div>
            <div>
                <h1>Color: {{ $product->details->color }}</h1>
            </div>
        </div>
    </div>
</x-app-layout>
