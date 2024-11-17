<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Add New Event Type</title>
</head>
<body class="bg-gray-200">

@if (session('error'))
    <div class="p-4 w-full bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center space-x-2">
        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8.257 3.099c.366-.446.933-.663 1.502-.526a1.5 1.5 0 011.138 1.091l.007.03 2.641 12.08c.087.4-.019.823-.29 1.116a1.494 1.494 0 01-1.08.514H6.833a1.5 1.5 0 01-1.275-.716 1.503 1.503 0 01-.117-1.41l.006-.015 2.641-12.08c.07-.32.24-.603.47-.784zm.192 13.401a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
        </svg>
        <span>{{ session('error') }}</span>
    </div>
@endif

<div class="max-w-xl mx-auto mt-40 bg-white rounded-xl shadow-md p-8">
    <h2 class="text-3xl font-bold text-center text-blue-800 mb-6">Add New Event Type</h2>
    <form action="{{ route('admin.eventTypes.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-lg font-semibold text-gray-800 mb-2">Name Type </label>
            <input type="text" id="name" name="name" required
                   class="w-full border @error('name') border-red-500 border-gray-300 @enderror p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                   placeholder="Enter Name Event" value="{{ old('name') }}">
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <div class="flex items-center justify-between gap-4">
            <a href="{{ route('admin.eventTypes') }}"
               class="w-1/3 text-center bg-gray-400 text-white font-semibold py-3 rounded-lg hover:bg-gray-500 transition duration-300">
                Back
            </a>
            <button type="submit"
                    class="w-2/3 bg-blue-800 text-white font-semibold py-3 rounded-lg hover:bg-blue-900 transition duration-300">
                Add Event Type
            </button>
        </div>
    </form>
</div>
</body>
</html>