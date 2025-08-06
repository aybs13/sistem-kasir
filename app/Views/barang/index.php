<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="p-6 max-w-7xl mx-auto space-y-6">
  <!-- Header -->
  <div class="flex justify-between items-center">
    <h2 class="text-3xl font-bold text-indigo-700 flex items-center gap-2">
      <i class="ti ti-package text-indigo-600 text-4xl"></i>
      Data Barang
    </h2>
    <a href="/barang/create" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition-all duration-200">
      + Tambah Barang
    </a>
  </div>

  <!-- Tabel -->
  <div class="overflow-x-auto bg-white rounded-xl shadow-md ring-1 ring-gray-200">
    <table class="min-w-full table-auto text-sm text-gray-800">
      <thead class="bg-indigo-50 text-indigo-700 uppercase text-xs font-bold tracking-wide">
        <tr>
          <th class="border px-4 py-3 text-center">#</th>
          <th class="border px-4 py-3 text-left">Barcode</th>
          <th class="border px-4 py-3 text-left">Nama Barang</th>
          <th class="border px-4 py-3 text-right">Harga Beli</th>
          <th class="border px-4 py-3 text-right">Harga Jual</th>
          <th class="border px-4 py-3 text-center">Stok</th>
          <th class="border px-4 py-3 text-center">Expired</th>
          <th class="border px-4 py-3 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-100">
        <?php foreach ($barang as $i => $b): ?>
        <tr class="hover:bg-gray-50 text-center">
          <td class="px-3 py-3"><?= $i + 1 ?></td>
          <td class="px-3 py-3 text-left font-mono"><?= esc($b['kode_barcode']) ?></td>
          <td class="px-3 py-3 text-left"><?= esc($b['nama_barang']) ?></td>
          <td class="px-3 py-3 text-right">Rp<?= number_format($b['harga_beli']) ?></td>
          <td class="px-3 py-3 text-right">Rp<?= number_format($b['harga_jual']) ?></td>
          <td class="px-3 py-3"><?= $b['stok'] ?></td>
          <td class="px-3 py-3">
            <?php if (!$b['expired_at']): ?>
              <span class="text-gray-400 italic">-</span>
            <?php else: ?>
              <?php $expired = strtotime($b['expired_at']); ?>
              <?php if ($expired < time()): ?>
                <span class="text-red-600 font-semibold"><?= date('d/m/Y', $expired) ?></span>
              <?php else: ?>
                <span class="text-gray-700"><?= date('d/m/Y', $expired) ?></span>
              <?php endif ?>
            <?php endif ?>
          </td>
          <td class="px-3 py-3 space-x-2">
            <a href="/barang/edit/<?= $b['id'] ?>" class="text-indigo-600 hover:text-indigo-800 hover:underline font-medium">
              <i class="ti ti-edit mr-1"></i>Edit
            </a>
            <a href="/barang/delete/<?= $b['id'] ?>" onclick="return confirm('Yakin ingin menghapus barang ini?')" class="text-red-600 hover:text-red-800 hover:underline font-medium">
              <i class="ti ti-trash mr-1"></i>Hapus
            </a>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
