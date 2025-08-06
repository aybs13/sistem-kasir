<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
        <i class="ti ti-user-plus text-green-600 text-3xl"></i>
        Tambah User Baru
    </h2>

    <form action="<?= base_url('user/store') ?>" method="post" class="space-y-5">
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input type="text" name="username" id="username" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-green-500" required>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="text" name="password" id="password" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-green-500" required>
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select name="role" id="role" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-green-500" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="kasir">Kasir</option>
            </select>
        </div>

        <div class="flex items-center justify-between mt-6">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded shadow">
                Simpan
            </button>
            <a href="<?= base_url('user') ?>" class="text-gray-600 hover:text-gray-800 hover:underline">← Kembali</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
