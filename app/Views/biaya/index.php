    <?= $this->extend('layouts/main') ?>
    <?= $this->section('content') ?>

    <div class="max-w-4xl mx-auto p-4 bg-white rounded-lg shadow-md mt-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-indigo-700">Daftar Biaya Operasional</h2>
        <a href="<?= base_url('biaya/create') ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
        + Tambah Biaya
        </a>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        <?= session()->getFlashdata('success') ?>
    </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('errors')): ?>
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <ul class="list-disc list-inside">
        <?php foreach(session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <?php if(empty($biaya)): ?>
        <p class="text-center text-gray-500">Belum ada data biaya operasional.</p>
    <?php else: ?>
        <table class="w-full border border-gray-200 rounded-lg text-left text-sm">
        <thead class="bg-indigo-100 text-indigo-700 font-semibold">
            <tr>
            <th class="p-3 border-b border-indigo-300">#</th>
            <th class="p-3 border-b border-indigo-300">Nama</th>
            <th class="p-3 border-b border-indigo-300">Jumlah (Rp)</th>
            <th class="p-3 border-b border-indigo-300">Tanggal</th>
            <th class="p-3 border-b border-indigo-300 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($biaya as $index => $item): ?>
            <tr class="<?= $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' ?>">
                <td class="p-3 border-b border-indigo-200"><?= $index + 1 ?></td>
                <td class="p-3 border-b border-indigo-200"><?= esc($item['nama']) ?></td>
                <td class="p-3 border-b border-indigo-200"><?= number_format($item['jumlah'], 0, ',', '.') ?></td>
                <td class="p-3 border-b border-indigo-200"><?= date('d M Y', strtotime($item['tanggal'])) ?></td>
                <td class="p-3 border-b border-indigo-200 text-center space-x-2">
                <a href="<?= base_url('biaya/edit/'.$item['id']) ?>" class="text-indigo-600 hover:underline">Edit</a>
                <form action="<?= base_url('biaya/delete/'.$item['id']) ?>" method="post" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    <?php endif; ?>

    </div>

    <?= $this->endSection() ?>
