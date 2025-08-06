<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto p-6">
  <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">🧾 Detail Transaksi</h2>

  <div class="bg-white p-5 rounded-lg shadow mb-6">
    <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-700">
      <p><strong>Kode Transaksi:</strong> <?= esc($transaksi['kode_transaksi']) ?></p>
      <p><strong>Kasir:</strong> <?= esc($transaksi['username']) ?></p>
      <p><strong>Tanggal:</strong> <?= date('d/m/Y H:i', strtotime($transaksi['tanggal'])) ?></p>
      <p><strong>Total:</strong> <span class="text-green-600 font-semibold">Rp<?= number_format($transaksi['total'], 0, ',', '.') ?></span></p>
    </div>
  </div>

  <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full text-sm text-left">
      <thead class="bg-indigo-600 text-white">
        <tr>
          <th class="px-4 py-3">Barang</th>
          <th class="px-4 py-3">Harga</th>
          <th class="px-4 py-3">Qty</th>
          <th class="px-4 py-3">Subtotal</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        <?php foreach ($detail as $row): ?>
        <tr class="hover:bg-gray-50 text-gray-800">
          <td class="px-4 py-2"><?= esc($row['nama_barang']) ?></td>
          <td class="px-4 py-2">Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
          <td class="px-4 py-2"><?= $row['qty'] ?></td>
          <td class="px-4 py-2 text-green-700 font-medium">Rp<?= number_format($row['subtotal'], 0, ',', '.') ?></td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>

  <div class="mt-6">
    <a href="/riwayat" class="inline-block text-sm text-indigo-600 hover:underline">
      &larr; Kembali ke Riwayat Transaksi
    </a>
  </div>
</div>

<?= $this->endSection() ?>
