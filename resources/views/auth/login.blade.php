<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Logos Coffe Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full p-8 bg-white border border-gray-200 rounded-2xl shadow-xl">
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-black rounded-full flex items-center justify-center mb-4">
                <span class="font-heading text-2xl text-white font-bold italic">LC</span>
            </div>
            <h1 class="text-2xl font-heading font-bold">Admin Login</h1>
            <p class="text-gray-500 text-sm">Please enter your credentials to continue</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">Email
                        Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-black transition-colors">
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password"
                        class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-black transition-colors">
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full py-3 bg-black text-white font-bold rounded-lg hover:bg-gray-900 transition-colors shadow-lg">
                    Sign In
                </button>
            </div>
        </form>
    </div>
</body>

</html>