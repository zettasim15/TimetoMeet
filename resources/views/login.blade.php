<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Link ke TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom JS untuk interaksi (misalnya menampilkan pesan error) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Menampilkan pesan error jika ada
            const errorMessages = @json($errors->all());
            if (errorMessages.length > 0) {
                const errorContainer = document.getElementById('error-messages');
                errorMessages.forEach(message => {
                    const errorElement = document.createElement('div');
                    errorElement.className = 'bg-red-600 text-white p-2 mb-2 rounded-md';
                    errorElement.innerText = message;
                    errorContainer.appendChild(errorElement);
                });
            }
        });
    </script>
</head>
<body class="bg-gray-100">

    <!-- Wrapper untuk konten login -->
    <div class="flex justify-center items-center min-h-screen">

        <!-- Card untuk form login -->
        <div class="bg-white p-8 rounded-lg shadow-md w-96">

            <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

            <!-- Menampilkan error jika ada -->
            <div id="error-messages"></div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Input email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Input password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Remember me dan Forgot password link -->
                <div class="mb-4 flex items-center justify-between">
                    <label for="remember" class="text-sm">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        Remember Me
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Forgot Password?</a>
                </div>

                <!-- Submit button -->
                <div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md focus:outline-none hover:bg-blue-600 transition duration-200">Login</button>
                </div>
            </form>

            <!-- Register Link -->
            <div class="mt-4 text-center">
                <p class="text-sm">Don't have an account? <a href="{{ route('register') }}">Daftar</a> {{ route('register') }}" class="text-blue-500 hover:underline">Register</a></p>
            </div>

        </div>
    </div>

</body>
</html>
