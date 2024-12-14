<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>Submit Review</title>
</head>
<body class="bg-gray-200">

<div class="max-w-xl mx-auto mt-16 bg-white rounded-xl shadow-md p-8">
    <h2 class="text-3xl font-extrabold text-center text-blue-800 mb-6">Submit Your Review</h2>
    <form action="{{ route('storeReview', [$event->id]) }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="description" class="block text-lg font-semibold text-gray-800">description</label>
            <textarea type="text" id="description" name="description" required
                   class="w-full border @error('description') border-red-500 border-gray-300 @enderror p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                   placeholder="Enter Name Event">{{ old('description') }}</textarea>
            @error('description')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="rating flex justify-center items-center ">
            <span class="cursor-pointer text-5xl text-gray-400 hover:text-yellow-400" data-rating="1">★</span>
            <span class="cursor-pointer text-5xl text-gray-400 hover:text-yellow-400" data-rating="2">★</span>
            <span class="cursor-pointer text-5xl text-gray-400 hover:text-yellow-400" data-rating="3">★</span>
            <span class="cursor-pointer text-5xl text-gray-400 hover:text-yellow-400" data-rating="4">★</span>
            <span class="cursor-pointer text-5xl text-gray-400 hover:text-yellow-400" data-rating="5">★</span>

            <input type="hidden" name="NumberOfStars" id="ratingInput">
        </div>
        <div class="flex justify-center">
            <button type="submit"
                    class="w-2/3 bg-blue-800 text-white font-semibold py-3 rounded-lg hover:bg-blue-900 transition duration-300">
                Submit Reiview
            </button>
        </div>
    </form>
</div>
</body>
<script>
    const stars = document.querySelectorAll('.rating span');
    const ratingInput = document.getElementById('ratingInput');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = star.dataset.rating;
            ratingInput.value = rating;

            // Highlight the selected star and its preceding stars
            stars.forEach(star => {
                if (star.dataset.rating <= rating) {
                    star.classList.add('text-yellow-500');
                } else {
                    star.classList.remove('text-yellow-500');
                }
            });
        });
    });
</script>
</html>




