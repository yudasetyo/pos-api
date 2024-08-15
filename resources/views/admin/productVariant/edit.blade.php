@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 sm:p-8 max-w-2xl mx-auto">
    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-8 text-center">Create New Product Variant Label</h2>

    <form action="{{ route('productVariant.update', $productVariant) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-6 sm:space-y-8">
            <div class="relative">
                <input id="productVariantName" name="productVariantName" type="text" value="{{ $productVariant->productVariantName }}" class="block w-full px-4 py-3 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 transition-colors duration-300 peer">
                <label for="productVariantName" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-2">Product Variant Label Name</label>
                @error('productVariantName')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="relative">
                <select id="product_id" name="product_id" class="block appearance-none w-full px-4 py-3 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 transition-colors duration-300">
                    <option value="{{ $productVariant->product->id }}">{{ $productVariant->product->productName }}</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->productName }}</option>
                    @endforeach
                </select> 
                <label for="product_id" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 left-2">Product</label>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
                @error('product_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Checkbox with Label on Top -->
            <div class="space-y-1">
                <label for="isRequired" class="block text-sm font-medium text-gray-700">Is Active</label>
                <div class="flex items-center">
                    <input type="hidden" name="isRequired" value="0">
                    <input id="isRequired" name="isRequired" type="checkbox" value="1" 
                        {{ $productVariant->isRequired ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="isRequired" class="ml-2 block text-sm text-gray-700">Active</label>
                </div>
                @error('isRequired')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between">
            <button class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300 mb-4 sm:mb-0 sm:mr-4" type="submit">
                Save Product
            </button>
            <a href="{{ route('productCategory.index') }}" class="w-full sm:w-auto text-center text-gray-600 hover:text-gray-800 font-bold py-3 px-6 rounded-md border border-gray-300 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition-colors duration-300">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@push('after-scripts')
    <script>
        document.getElementById('isRequired').addEventListener('change', function() {
            this.previousElementSibling.value = this.checked ? "1" : "0";
        });
    </script>
@endpush