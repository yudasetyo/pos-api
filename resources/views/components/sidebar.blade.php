<aside id="sidebar" class="bg-gray-800 text-white w-64 min-h-screen fixed left-0 top-0 z-10 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
    <nav class="p-4">
        <h2 class="text-xl font-semibold mb-6">Admin Menu</h2>
        <ul class="space-y-2">
            <li><a href="{{ route('dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Dashboard</a></li>
            <li><a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Users</a></li>
            <li><a href="{{ route('productWeb.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Products</a></li>
            <li><a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Orders</a></li>
            <li><a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Settings</a></li>
        </ul>
    </nav>
</aside>