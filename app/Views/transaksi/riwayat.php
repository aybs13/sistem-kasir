<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="max-w-6xl mx-auto p-6">
  <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">📜 Riwayat Transaksi</h2>

  <div class="overflow-x-auto bg-white rounded-lg shadow-md">
    <table class="min-w-full text-sm text-left">
      <thead class="bg-indigo-600 text-white">
        <tr>
          <th class="px-4 py-3">#</th>
          <th class="px-4 py-3">Kode Transaksi</th>
          <th class="px-4 py-3">Tanggal</th>
          <th class="px-4 py-3">Total</th>
          <th class="px-4 py-3">Kasir</th>
          <th class="px-4 py-3 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        <?php $no = 1; foreach ($transaksi as $row): ?>
        <tr class="hover:bg-gray-50">
          <td class="px-4 py-3"><?= $no++ ?></td>
          <td class="px-4 py-3 font-medium text-indigo-700"><?= $row['kode_transaksi'] ?></td>
          <td class="px-4 py-3"><?= date('d/m/Y H:i', strtotime($row['tanggal'])) ?></td>
          <td class="px-4 py-3 text-green-600">Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
          <td class="px-4 py-3"><?= esc($row['username']) ?></td>
          <td class="px-4 py-3 text-center">
            <a href="/riwayat/detail/<?= $row['id'] ?>" class="inline-block px-3 py-1 text-sm bg-indigo-100 text-indigo-700 rounded hover:bg-indigo-200 transition">
              Detail
            </a>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
