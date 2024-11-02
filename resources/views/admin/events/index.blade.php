<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <x-admin-sidebar></x-admin-sidebar>
    <div class="flex-1 p-10 mt-16">
        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold">Events</h2>
            <a href="{{ route('admin.events.create') }}" class="bg-blue-800 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded transition duration-200 font-semibold">Add Event</a>
        </div>
        @if(session('success'))
        <div id="success-message" class="relative mb-4 p-3 bg-green-100 text-green-700 border border-green-300 rounded-lg">
            <button onclick="document.getElementById('success-message').style.display='none'" class="absolute top-2 right-2 text-green-700 hover:text-green-900 focus:outline-none text-lg">
                &times;
            </button>
            {{ session('success') }}
        </div>
        @endif
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-100 border border-gray-200 rounded-md text-sm">
                <thead>
                    <tr class="bg-gray-700 text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Description</th>
                        <th class="py-3 px-6 text-left">Type</th>
                        <th class="py-3 px-6 text-left">Location</th>
                        <th class="py-3 px-6 text-left">Time</th>
                        <th class="py-3 px-6 text-left">Date</th>
                        <th class="py-3 px-6 text-left">Price</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                    <tr class="border-b border-gray-200 hover:bg-gray-300 transition duration-200 cursor-pointer">
                        <td class="py-3 px-6 truncate">{{ $event->name }}</td>
                        <td class="py-3 px-6 truncate max-w-40 hover:max-w-60 transition-all duration-300">{{ $event->description }}</td>
                        <td class="py-3 px-6">{{ $event['eventType']['name'] }}</td>
                        <td class="py-3 px-6">{{ $event['location']['name'] }}</td>
                        <td class="py-3 px-6">{{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}</td>
                        <td class="py-3 px-6">{{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}</td>
                        <td class="py-3 px-6">{{ $event->price }} $</td>
                        <td class="py-3 px-6 flex flex-row gap-4">
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="bg-green-600 text-white py-1 px-3 rounded hover:bg-green-700 transition duration-200 font-semibold">Edit</a>
                            <button type="button" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 transition duration-200 font-semibold" onclick="showConfirmationModal('{{ $event->id }}')">
                                Delete
                            </button>
                            <form id="delete-form-{{ $event->id }}" action="{{ route('admin.events.delete', $event->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="confirmation-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white rounded-lg p-6 shadow-lg transform -translate-y-full transition-transform duration-500 ease-in-out" id="modal-content">
                    <h2 class="text-lg font-bold mb-4">Are you sure you want to delete this?</h2>
                    <div class="flex justify-end">
                        <button id="confirm-delete" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="submitDeleteForm()">Delete</button>
                        <button id="cancel-delete" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded ml-2" onclick="hideConfirmationModal()">Cancel</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
<script>
    let deleteFormId;

    function showConfirmationModal(eventId) {
        deleteFormId = 'delete-form-' + eventId; // Set the ID of the form to delete
        document.getElementById('confirmation-modal').classList.remove('hidden');
    }

    function submitDeleteForm() {
        document.getElementById(deleteFormId).submit(); // Submit the correct form
        hideConfirmationModal();
    }

    function hideConfirmationModal() {
        document.getElementById('confirmation-modal').classList.add('hidden');
    }
</script>
</html>
