<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Toko Ma Upa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 to-white">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md border border-gray-100">
        <!-- Logo or Icon -->
        <div class="flex justify-center mb-6">
            <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center text-2xl font-bold shadow-md">
                🛒
            </div>
        </div>

        <!-- Title -->
        <h1 class="text-2xl font-extrabold text-gray-800 text-center mb-2 tracking-tight">
            Login Toko Ma Upa
        </h1>
        <p class="text-sm text-gray-500 text-center mb-6">
            Silakan masuk untuk melanjutkan
        </p>

        <!-- Error Message -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded mb-4 text-sm shadow-sm">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form action="/login" method="post" class="space-y-4">
            <div>
                <input 
                    type="text" 
                    name="username" 
                    placeholder="Username" 
                    class="w-full border border-gray-300 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
            </div>
            <div>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Password" 
                    class="w-full border border-gray-300 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
            </div>
            <div>
                <button 
                    type="submit" 
                    class="w-full bg-blue-600 text-white font-semibold py-3 rounded-md hover:bg-blue-700 transition shadow">
                    Masuk
                </button>
            </div>
        </form>

        <!-- Optional Footer -->
        <p class="text-xs text-gray-400 text-center mt-6">
            &copy; <?= date('Y') ?> Toko Ma Upa. All rights reserved.
        </p>
    </div>

</body>
</html>
