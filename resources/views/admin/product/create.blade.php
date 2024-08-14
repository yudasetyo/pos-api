@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 sm:p-8 max-w-2xl mx-auto">
    <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-8 text-center">Create New Product</h2>

    <form action="{{ route('productWeb.store') }}" method="POST">
        <div class="space-y-6 sm:space-y-8">
            <div class="relative">
                <input id="product-name" type="text" placeholder=" " class="block w-full px-4 py-3 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 transition-colors duration-300 peer">
                <label for="product-name" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-2">Product Name</label>
            </div>

            <div class="relative">
                <select id="category" class="block appearance-none w-full px-4 py-3 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 transition-colors duration-300">
                    <option value="" disabled selected>Select a category</option>
                    <option>Category A</option>
                    <option>Category B</option>
                    <option>Category C</option>
                </select>
                <label for="category" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 left-2">Category</label>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>

            <div class="relative">
                <input id="price" type="number" step="0.01" placeholder=" " class="block w-full px-4 py-3 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 transition-colors duration-300 peer">
                <label for="price" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-2">Price</label>
            </div>

            <div class="relative">
                <input id="stock" type="number" placeholder=" " class="block w-full px-4 py-3 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 transition-colors duration-300 peer">
                <label for="stock" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-2">Stock</label>
            </div>
        </div>

        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between">
            <button class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300 mb-4 sm:mb-0 sm:mr-4" type="submit">
                Save Product
            </button>
            <a href="{{ route('products.index') }}" class="w-full sm:w-auto text-center text-gray-600 hover:text-gray-800 font-bold py-3 px-6 rounded-md border border-gray-300 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition-colors duration-300">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection