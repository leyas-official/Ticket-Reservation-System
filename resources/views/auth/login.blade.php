<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body  class="bg-gray-200 flex items-center justify-center min-h-screen">
    <div class="mt-7 bg-white rounded-xl p-6 shadow-lg w-full max-w-md">
        <h3 class="block text-3xl font-bold text-blue-800 text-center">Sign In</h3>
        <form action="{{ route('signIn')}}" method="POST">
            @csrf
            <div class="grid gap-y-4">

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm mb-2 text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" required class="py-3 px-4 block w-full border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none @error('email') border-red-600 @enderror" placeholder="you@example.com">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm mb-2 text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required class="py-3 px-4 block w-full border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none @error('password') border-red-600 @enderror" placeholder="Your Password">
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex flex-row gap-4">
                    <a href="{{ route('home') }}" class="w-md px-4 py-2 font-semibold text-gray-800 bg-gray-300 rounded-lg hover:bg-gray-400 transition duration-200 text-white">
                        Back
                    </a>
                    <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-900 text-white hover:bg-blue-900 focus:outline-none">Sign In</button>
                </div>
            </div>
        </form>
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">You Dont Have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Sign Up</a></p>
        </div>

    </div>

</body>
</html>
