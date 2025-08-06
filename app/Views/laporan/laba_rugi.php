<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Laporan Laba Rugi</h2>

    <form method="get" class="mb-6">
        <label class="block mb-2">Tanggal Awal:</label>
        <input type="date" name="awal" value="<?= esc($awal) ?>" class="border rounded px-3 py-2 mb-2">

        <label class="block mb-2">Tanggal Akhir:</label>
        <input type="date" name="akhir" value="<?= esc($akhir) ?>" class="border rounded px-3 py-2 mb-2">

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tampilkan</button>
    </form>

    <div class="bg-white rounded shadow p-4">
        <p><strong>Total Penjualan:</strong> Rp<?= number_format($total_penjualan, 0, ',', '.') ?></p>
        <p><strong>Total Modal Barang:</strong> Rp<?= number_format($total_modal, 0, ',', '.') ?></p>
        <p><strong>Total Biaya Operasional:</strong> Rp<?= number_format($total_biaya, 0, ',', '.') ?></p>
        <hr class="my-4">
        <p class="text-lg font-bold">Laba Bersih: Rp<?= number_format($laba_bersih, 0, ',', '.') ?></p>
    </div>
</div>

<?= $this->endSection() ?>
