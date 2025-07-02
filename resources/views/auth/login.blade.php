<x-guest-layout>
    <div class="w-full max-w-md mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-6">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input id="email" type="email" name="email" class="mt-1 block w-full border p-2" required autofocus>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">Password</label>
                <input id="password" type="password" name="password" class="mt-1 block w-full border p-2" required>
            </div>
            <div class="mb-4">
    <label class="block text-sm font-medium">Login sebagai</label>
    <select name="role" required
            class="mt-1 w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
        <option value="">Pilih role</option>
        <option value="Member" {{ old('role') == 'Member' ? 'selected' : '' }}>Member</option>
        <option value="Manager" {{ old('role') == 'Manager' ? 'selected' : '' }}>Manager</option>
    </select>
</div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Login</button>
            </div>
            <p class="mt-4 text-sm">
    Belum punya akun?
    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Daftar di sini</a>
</p>

        </form>
    </div>
</x-guest-layout>
