<aside id="sidebar" class="bg-gray-800 text-white w-64 min-h-screen fixed left-0 top-0 z-10 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
    <nav class="p-4">
        <h2 class="text-xl font-semibold mb-6">Admin Menu</h2>
        <ul class="space-y-2">
            <li><a href="{{ route('dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Dashboard</a></li>
            <li><a href="{{ route('productCategory.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Product Category</a></li>
            <li><a href="{{ route('product.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Product</a></li>
            <li><a href="{{ route('productVariant.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Product Variant Label</a></li>
            <li><a href="{{ route('productVariantDT.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Product Variant Item</a></li>
        </ul>
    </nav>
</aside>