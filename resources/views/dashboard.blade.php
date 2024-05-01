<x-app-layout>

    <div class="flex justify-center mt-6">
        <table class="bg-white shadow-md rounded-xl">
            <thead>
                <tr class="bg-blue-gray-100 text-gray-700">
                    <th class="py-3 px-4 text-left">Id</th>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Price</th>
                    <th class="py-3 px-4 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="text-blue-gray-900">
                @foreach ($products as $product)
                    <tr class="border-b border-blue-gray-200">
                        <td class="py-3 px-4">{{ $product->id }}</td>
                        <td class="py-3 px-4">{{ $product->product->title }}</td>
                        <td class="py-3 px-4">${{ $product->price }}</td>
                        <td class="py-3 px-4">
                            <a href="{{ route('product.edit', ['product' => $product->product->id]) }}"
                                class="text-s text-blue-600 hover:text-blue-800">Update</a>
                            <a href="{{ route('product.show', ['product' => $product->product->id]) }}"
                                class="text-s text-blue-600 hover:text-blue-800">Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
