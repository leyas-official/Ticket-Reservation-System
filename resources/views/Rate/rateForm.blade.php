<x-layout>
    <x-slot:head>

    </x-slot:head>

    <div class="rating flex items-center ">
        <span class="cursor-pointer text-5xl text-gray-400 hover:text-yellow-400" data-rating="1">★</span>
        <span class="cursor-pointer text-5xl text-gray-400 hover:text-yellow-400" data-rating="2">★</span>
        <span class="cursor-pointer text-5xl text-gray-400 hover:text-yellow-400" data-rating="3">★</span>
        <span class="cursor-pointer text-5xl text-gray-400 hover:text-yellow-400" data-rating="4">★</span>
        <span class="cursor-pointer text-5xl text-gray-400 hover:text-yellow-400" data-rating="5">★</span>
    </div>
    <script>
        const stars = document.querySelectorAll('.rating span');

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = star.dataset.rating;
                console.log('Selected rating:', rating);

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

</x-layout>
