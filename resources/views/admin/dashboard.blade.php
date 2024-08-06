@extends('layouts.app')
@section('content')
    <div class="bg-gray-100 min-h-screen">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Dashboard</h1>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-5">
                <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
                <p class="text-3xl font-bold text-blue-600">1,234</p>
                <p class="text-sm text-gray-500">↑ 12% from last month</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <h3 class="text-lg font-semibold text-gray-700">Total Revenue</h3>
                <p class="text-3xl font-bold text-green-600">$45,678</p>
                <p class="text-sm text-gray-500">↑ 8% from last month</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <h3 class="text-lg font-semibold text-gray-700">New Orders</h3>
                <p class="text-3xl font-bold text-yellow-600">89</p>
                <p class="text-sm text-gray-500">↓ 3% from last week</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <h3 class="text-lg font-semibold text-gray-700">Support Tickets</h3>
                <p class="text-3xl font-bold text-red-600">15</p>
                <p class="text-sm text-gray-500">↓ 20% from last week</p>
            </div>
        </div>

        <!-- Chart and Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Chart Placeholder -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Sales Overview</h3>
                <div class="bg-gray-200 h-64 rounded flex items-center justify-center">
                    <p class="text-gray-600">Chart Placeholder</p>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h3>
                <ul class="divide-y divide-gray-200">
                    <li class="py-3">
                        <p class="text-gray-800">New user registered</p>
                        <p class="text-sm text-gray-500">2 minutes ago</p>
                    </li>
                    <li class="py-3">
                        <p class="text-gray-800">New order #1234 received</p>
                        <p class="text-sm text-gray-500">15 minutes ago</p>
                    </li>
                    <li class="py-3">
                        <p class="text-gray-800">Payment for order #1233 confirmed</p>
                        <p class="text-sm text-gray-500">1 hour ago</p>
                    </li>
                    <li class="py-3">
                        <p class="text-gray-800">Support ticket #123 closed</p>
                        <p class="text-sm text-gray-500">2 hours ago</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection