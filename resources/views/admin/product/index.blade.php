@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 text-center sm:text-left mb-4 sm:mb-0">Product Dashboard</h2>
        <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded shadow w-full sm:w-auto">
            + Add New Product
        </button>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 sm:py-4 px-2 sm:px-6 text-left text-xs sm:text-sm font-bold text-gray-700">Product Name</th>
                    <th class="py-2 sm:py-4 px-2 sm:px-6 text-left text-xs sm:text-sm font-bold text-gray-700">Image</th>
                    <th class="py-2 sm:py-4 px-2 sm:px-6 text-left text-xs sm:text-sm font-bold text-gray-700">Des</th>
                    <th class="py-2 sm:py-4 px-2 sm:px-6 text-left text-xs sm:text-sm font-bold text-gray-700">Stock</th>
                    <th class="py-2 sm:py-4 px-2 sm:px-6 text-center text-xs sm:text-sm font-bold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50">
                    <td class="py-2 sm:py-4 px-2 sm:px-6 text-xs sm:text-sm text-gray-800">Product 1</td>
                    <td class="py-2 sm:py-4 px-2 sm:px-6 text-xs sm:text-sm text-gray-800">Category A</td>
                    <td class="py-2 sm:py-4 px-2 sm:px-6 text-xs sm:text-sm text-gray-800">$25.00</td>
                    <td class="py-2 sm:py-4 px-2 sm:px-6 text-xs sm:text-sm text-gray-800">50</td>
                    <td class="py-2 sm:py-4 px-2 sm:px-6 text-center">
                        <div class="flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                            <button class="text-xs sm:text-sm bg-blue-500 hover:bg-blue-600 text-white py-1 sm:py-2 px-2 sm:px-4 rounded-full shadow inline-flex items-center justify-center">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M15 12H9m4 0H9m4-4h1a2 2 0 011 1m-1-1h-2m3 10a2 2 0 01-2 2H9a2 2 0 01-2-2V9a2 2 0 012-2h6a2 2 0 012 2v8zm-6 0h.01"></path></svg>
                                Edit
                            </button>
                            <button class="text-xs sm:text-sm bg-red-500 hover:bg-red-600 text-white py-1 sm:py-2 px-2 sm:px-4 rounded-full shadow inline-flex items-center justify-center">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19 7L5 7m5 10h4m-4-6h4m-4 6v-6m4 6V7H7l4-4 4 4H7v10h6m-3-3V4"></path></svg>
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- Second row (Product 2) with the same changes as the first row -->
                <tr class="hover:bg-gray-50">
                    <!-- ... (apply the same changes as in the first row) ... -->
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div>
@endsection