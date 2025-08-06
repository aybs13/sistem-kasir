<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow-md space-y-8">

  <!-- Judul -->
  <h2 class="text-3xl font-bold text-green-700 flex items-center gap-2">
    <i class="ti ti-report text-3xl text-green-600"></i>
    Laporan Penjualan
  </h2>

  <!-- Form Filter -->
  <form method="post" action="<?= base_url('laporan') ?>" class="flex flex-wrap gap-6 items-end bg-green-50 p-4 rounded-md shadow-inner">
    <div>
      <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Awal</label>
      <input type="date" name="tanggal_awal" value="<?= $tanggal_awal ?? '' ?>" class="border border-gray-300 p-2 rounded-md w-full focus:ring-2 focus:ring-green-400 outline-none" required>
    </div>
    <div>
      <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Akhir</label>
      <input type="date" name="tanggal_akhir" value="<?= $tanggal_akhir ?? '' ?>" class="border border-gray-300 p-2 rounded-md w-full focus:ring-2 focus:ring-green-400 outline-none" required>
    </div>
    <div>
      <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-md shadow transition duration-300">
        🔍 Filter
      </button>
    </div>
  </form>

  <!-- Tabel Laporan -->
  <?php if (isset($transaksi) && count($transaksi) > 0): ?>
    <div class="overflow-x-auto">
      <table class="w-full text-sm border border-gray-200 rounded-md overflow-hidden shadow-sm">
        <thead class="bg-green-100 text-green-800 uppercase text-xs font-semibold tracking-wide text-center">
          <tr>
            <th class="border px-4 py-3">Tanggal</th>
            <th class="border px-4 py-3">Kode Transaksi</th>
            <th class="border px-4 py-3">Total</th>
            <th class="border px-4 py-3">Tunai</th>
            <th class="border px-4 py-3">Kembali</th>
          </tr>
        </thead>
        <tbody class="text-gray-800 text-center">
          <?php foreach ($transaksi as $t): ?>
            <tr class="hover:bg-gray-50 transition">
              <td class="border px-4 py-2"><?= esc($t['tanggal']) ?></td>
              <td class="border px-4 py-2 font-medium text-indigo-600"><?= esc($t['kode_transaksi']) ?></td>
              <td class="border px-4 py-2 text-right text-green-700 font-semibold">Rp<?= number_format($t['total'], 0, ',', '.') ?></td>
              <td class="border px-4 py-2 text-right">Rp<?= number_format($t['tunai'], 0, ',', '.') ?></td>
              <td class="border px-4 py-2 text-right">Rp<?= number_format($t['kembali'], 0, ',', '.') ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="p-4 bg-yellow-50 text-yellow-700 rounded-md shadow-inner">
      <i class="ti ti-info-circle mr-2"></i> Belum ada data penjualan pada periode ini.
    </div>
  <?php endif ?>
</div>

<?= $this->endSection() ?>
