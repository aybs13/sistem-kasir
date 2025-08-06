<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="max-w-6xl mx-auto p-6 space-y-6">

    <!-- Judul Halaman -->
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-red-600 flex items-center gap-2 tracking-tight">
            <i class="ti ti-alert-triangle text-2xl"></i>
            Barang dengan Stok Menipis
        </h2>
    </div>

    <!-- Flash Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-50 border-l-4 border-green-600 text-green-800 px-4 py-3 rounded-md shadow-sm">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif ?>

    <!-- Tabel Stok Menipis -->
    <div class="bg-white shadow-md rounded-xl ring-1 ring-gray-200 overflow-hidden">
        <table class="min-w-full text-sm text-gray-800">
            <thead class="bg-red-50 text-red-700 uppercase text-xs font-semibold tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-center">#</th>
                    <th class="px-4 py-3 text-left">Barcode</th>
                    <th class="px-4 py-3 text-left">Nama Barang</th>
                    <th class="px-4 py-3 text-right">Harga Jual</th>
                    <th class="px-4 py-3 text-center">Stok</th>
                    <th class="px-4 py-3 text-center">Stok Minimal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($barang)): ?>
                    <?php foreach ($barang as $i => $b): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border-t px-4 py-2 text-center font-medium"><?= $i + 1 ?></td>
                            <td class="border-t px-4 py-2"><?= esc($b['kode_barcode']) ?></td>
                            <td class="border-t px-4 py-2"><?= esc($b['nama_barang']) ?></td>
                            <td class="border-t px-4 py-2 text-right">Rp<?= number_format($b['harga_jual'], 0, ',', '.') ?></td>
                            <td class="border-t px-4 py-2 text-center font-bold text-red-600 bg-red-50 rounded">
                                <?= $b['stok'] ?>
                            </td>
                            <td class="border-t px-4 py-2 text-center"><?= $b['stok_minimal'] ?? '-' ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-10">
                            <div class="flex flex-col items-center justify-center space-y-2">
                                <i class="ti ti-circle-check text-4xl text-green-500"></i>
                                <p class="font-medium text-sm">Semua stok masih aman.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection() ?>
