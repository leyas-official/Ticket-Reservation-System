<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Sign Up</title>
</head>
<body class="bg-gray-200 flex items-center justify-center min-h-screen">
    <div class="mt-7 bg-white rounded-xl p-6 shadow-lg w-full max-w-md">
        <h3 class="block text-3xl font-bold text-blue-800 text-center">Sign Up</h3>
        <!-- Sign Up Form -->
        <form action="{{ route('signUp')}}" method="POST">
            @csrf
            <div class="grid gap-y-4">

                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-sm mb-2 text-gray-700">Full Name</label>
                    <input type="text" id="name" name="name" required class="py-3 px-4 block w-full border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none @error('name') border-red-600 @enderror" placeholder="Your Full Name">
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm mb-2 text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" required class="py-3 px-4 block w-full border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none @error('email') border-red-600 @enderror" placeholder="you@example.com">
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm mb-2 text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required class="py-3 px-4 block w-full border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none @error('password') border-red-600 @enderror" placeholder="Your Password">
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm mb-2 text-gray-700">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="py-3 px-4 block w-full border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none @error('password_confirmation') border-red-600 @enderror" placeholder="Confirm Your Password">
                    @error('password_confirmation')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-800 text-white hover:bg-blue-900 focus:outline-none transition duration-200">Sign Up</button>
            </div>
        </form>
        <!-- End Sign In Form -->

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Sign In</a></p>
        </div>

    </div>
</body>
</html>
