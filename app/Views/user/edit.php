<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
        <i class="ti ti-user-edit text-blue-600 text-3xl"></i>
        Edit User
    </h2>

    <form action="<?= base_url('user/update/' . $user['id']) ?>" method="post" class="space-y-5">
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input 
                type="text" 
                name="username" 
                id="username"
                value="<?= esc($user['username']) ?>" 
                class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required
            >
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input 
                type="text" 
                name="password" 
                id="password"
                placeholder="(Opsional) Ubah Password" 
                class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select 
                name="role" 
                id="role"
                class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required
            >
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="kasir" <?= $user['role'] === 'kasir' ? 'selected' : '' ?>>Kasir</option>
            </select>
        </div>

        <div class="flex justify-between items-center mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow">
                Update
            </button>
            <a href="<?= base_url('user') ?>" class="text-gray-600 hover:text-gray-800 hover:underline">
                ← Batal
            </a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
