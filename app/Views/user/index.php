<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="max-w-5xl mx-auto p-6 bg-white shadow-md rounded-xl space-y-6">

  <!-- Header -->
  <div class="flex items-center justify-between border-b pb-4">
    <div class="flex items-center gap-3">
      <i class="ti ti-users text-3xl text-indigo-600"></i>
      <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Manajemen User</h2>
    </div>
    <a href="<?= base_url('user/create') ?>" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-300">
      + Tambah User
    </a>
  </div>

  <!-- Flash Message -->
  <?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded-md shadow-sm">
      <p><strong>Sukses!</strong> <?= session()->getFlashdata('success') ?></p>
    </div>
  <?php endif ?>

  <!-- Tabel User -->
  <div class="overflow-x-auto rounded-md">
    <table class="min-w-full border border-gray-200 text-sm">
      <thead class="bg-indigo-50 text-indigo-700 uppercase text-xs font-semibold tracking-wider text-center">
        <tr>
          <th class="border px-4 py-3">#</th>
          <th class="border px-4 py-3 text-left">Username</th>
          <th class="border px-4 py-3 text-left">Role</th>
          <th class="border px-4 py-3">Aksi</th>
        </tr>
      </thead>
      <tbody class="text-gray-800">
        <?php if (!empty($users)): ?>
          <?php foreach ($users as $index => $user): ?>
            <tr class="hover:bg-gray-50 transition-all">
              <td class="border px-4 py-2 text-center font-medium"><?= $index + 1 ?></td>
              <td class="border px-4 py-2"><?= esc($user['username']) ?></td>
              <td class="border px-4 py-2">
                <span class="inline-block px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-xs font-medium">
                  <?= esc(ucfirst($user['role'])) ?>
                </span>
              </td>
              <td class="border px-4 py-2 text-center space-x-2">
                <a href="<?= base_url('user/edit/' . $user['id']) ?>" class="text-blue-600 hover:text-blue-800 font-medium transition">Edit</a>
                <a href="<?= base_url('user/delete/' . $user['id']) ?>" onclick="return confirm('Yakin hapus user ini?')" class="text-red-600 hover:text-red-800 font-medium transition">Hapus</a>
              </td>
            </tr>
          <?php endforeach ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="border px-4 py-4 text-center text-gray-500 italic">Belum ada data user.</td>
          </tr>
        <?php endif ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
