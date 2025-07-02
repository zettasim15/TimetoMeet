<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Buat Akun</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            @if ($errors->any())
                <div class="bg-red-100 text-red-600 p-2 rounded mb-4 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4">
                <label class="block text-sm font-medium">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
    <label class="block text-sm font-medium">Username</label>
    <input type="text" name="username" value="{{ old('username') }}" required
           class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
</div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Password</label>
                <input type="password" name="password" required
                       class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <!-- ⬇️ Tambahkan bagian ROLE DI SINI -->
    <div class="mb-4">
        <label class="block text-sm font-medium">Role</label>
        <select name="role" required
                class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            <option value="">Pilih role</option>
            <option value="Member" {{ old('role') == 'Member' ? 'selected' : '' }}>Member</option>
            <option value="Manager" {{ old('role') == 'Manager' ? 'selected' : '' }}>Manager</option>
        </select>
    </div>
    <!-- ⬆️ Di atas tombol -->
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Daftar
            </button>
        </form>

        <p class="mt-4 text-center text-sm">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login di sini</a>
        </p>
    </div>

</body>
</html>
