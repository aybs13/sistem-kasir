<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="max-w-6xl mx-auto p-6">
  <div class="flex items-center gap-2 mb-6">
    <i class="ti ti-clock-off text-red-500 text-2xl"></i>
    <h2 class="text-2xl font-bold text-gray-800">Barang Hampir / Sudah Expired</h2>
  </div>

  <?php if (count($barang) > 0): ?>
    <div class="overflow-x-auto bg-white shadow-md rounded-md ring-1 ring-gray-200">
      <table class="min-w-full text-sm text-gray-700">
        <thead class="bg-red-100 text-red-800 uppercase text-xs font-semibold tracking-wider">
          <tr>
            <th class="px-4 py-3 text-left">Nama Barang</th>
            <th class="px-4 py-3 text-center">Stok</th>
            <th class="px-4 py-3 text-left">Tanggal Expired</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($barang as $b): ?>
            <tr class="border-t hover:bg-red-50 transition">
              <td class="px-4 py-2"><?= esc($b['nama_barang']) ?></td>
              <td class="px-4 py-2 text-center text-red-700 font-semibold"><?= $b['stok'] ?></td>
              <td class="px-4 py-2 text-red-600"><?= date('d M Y', strtotime($b['expired_at'])) ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="bg-green-50 text-green-700 p-4 rounded-md border border-green-200 shadow-sm flex items-center gap-2">
      <i class="ti ti-check text-2xl"></i>
      <span>Tidak ada barang yang hampir expired.</span>
    </div>
  <?php endif ?>
</div>

<?= $this->endSection() ?>
