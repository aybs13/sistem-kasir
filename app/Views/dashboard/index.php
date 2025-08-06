<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="p-6 space-y-10 max-w-7xl mx-auto">

  <!-- Judul Halaman -->
  <div class="flex items-center justify-between border-b pb-4 mb-6">
    <h2 class="text-4xl font-extrabold text-indigo-700 tracking-tight flex items-center gap-2">
      <i class="ti ti-dashboard text-indigo-600 text-3xl"></i>
      Dashboard Admin
    </h2>
  </div>

  <!-- Statistik Pendapatan -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Hari Ini -->
    <div class="bg-gradient-to-tr from-blue-100 to-blue-50 border-l-8 border-blue-500 p-6 rounded-2xl shadow-xl hover:ring-2 ring-blue-400 transition duration-300 ease-in-out transform hover:scale-105">
      <div class="flex items-center justify-between">
        <div>
          <h4 class="text-sm font-semibold text-blue-600 uppercase">Pendapatan Hari Ini</h4>
          <p class="text-3xl font-bold text-blue-900 mt-2">Rp<?= number_format($hariIni) ?></p>
        </div>
        <i class="ti ti-cash text-4xl text-blue-500"></i>
      </div>
    </div>

    <!-- Bulan Ini -->
    <div class="bg-gradient-to-tr from-green-100 to-green-50 border-l-8 border-green-500 p-6 rounded-2xl shadow-xl hover:ring-2 ring-green-400 transition duration-300 ease-in-out transform hover:scale-105">
      <div class="flex items-center justify-between">
        <div>
          <h4 class="text-sm font-semibold text-green-600 uppercase">Pendapatan Bulan Ini</h4>
          <p class="text-3xl font-bold text-green-900 mt-2">Rp<?= number_format($bulanIni) ?></p>
        </div>
        <i class="ti ti-calendar-stats text-4xl text-green-500"></i>
      </div>
    </div>

    <!-- Total Transaksi -->
    <div class="bg-gradient-to-tr from-yellow-100 to-yellow-50 border-l-8 border-yellow-400 p-6 rounded-2xl shadow-xl hover:ring-2 ring-yellow-400 transition duration-300 ease-in-out transform hover:scale-105">
      <div class="flex items-center justify-between">
        <div>
          <h4 class="text-sm font-semibold text-yellow-600 uppercase">Total Transaksi</h4>
          <p class="text-3xl font-bold text-yellow-800 mt-2"><?= $jumlahTransaksi ?></p>
        </div>
        <i class="ti ti-clipboard-list text-4xl text-yellow-500"></i>
      </div>
    </div>
  </div>

  <!-- Informasi Barang -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Stok Menipis -->
    <div class="bg-gradient-to-tr from-red-100 to-red-50 border-l-8 border-red-500 p-6 rounded-2xl shadow-xl hover:ring-2 ring-red-400 transition duration-300 ease-in-out transform hover:scale-105">
      <div class="flex justify-between items-start">
        <div>
          <h4 class="text-sm font-semibold text-red-600 uppercase">Stok Menipis</h4>
          <p class="text-3xl font-bold text-red-800 mt-2"><?= $stokMenipis ?> Barang</p>
          <a href="/stok-menipis" class="text-sm text-red-600 hover:underline mt-2 inline-block">Lihat Detail</a>
        </div>
        <i class="ti ti-alert-triangle text-4xl text-red-500"></i>
      </div>
    </div>

    <!-- Barang Expired -->
    <div class="bg-gradient-to-tr from-orange-100 to-orange-50 border-l-8 border-orange-500 p-6 rounded-2xl shadow-xl hover:ring-2 ring-orange-400 transition duration-300 ease-in-out transform hover:scale-105">
      <div class="flex justify-between items-start">
        <div>
          <h4 class="text-sm font-semibold text-orange-600 uppercase">Barang Hampir Expired</h4>
          <p class="text-3xl font-bold text-orange-800 mt-2"><?= count($barangExpired) ?> Barang</p>
          <a href="/barang/expired" class="text-sm text-orange-600 hover:underline mt-2 inline-block">Lihat Detail</a>
        </div>
        <i class="ti ti-clock-hour-10 text-4xl text-orange-500"></i>
      </div>
    </div>

    <!-- Barang Terlaris -->
    <div class="bg-gradient-to-tr from-purple-100 to-purple-50 border-l-8 border-purple-500 p-6 rounded-2xl shadow-xl hover:ring-2 ring-purple-400 transition duration-300 ease-in-out transform hover:scale-105">
      <div class="flex justify-between items-start">
        <div>
          <h4 class="text-sm font-semibold text-purple-600 uppercase">Barang Terlaris</h4>
          <?php if ($barangTerlaris): ?>
            <p class="text-xl font-bold text-purple-900 mt-2"><?= esc($barangTerlaris['nama_barang']) ?></p>
          <?php else: ?>
            <p class="text-sm text-gray-500 mt-2 italic">Belum ada data</p>
          <?php endif ?>
        </div>
        <i class="ti ti-star text-4xl text-purple-500"></i>
      </div>
    </div>
  </div>

  <!-- Laba Rugi -->
  <div>
    <h3 class="text-2xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
      <i class="ti ti-report-money text-indigo-600"></i>
      Laba Rugi Bulan Ini
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Total Penjualan -->
      <div class="bg-white border-l-8 border-indigo-500 p-6 rounded-2xl shadow hover:ring-2 ring-indigo-300 hover:scale-105 transition duration-300">
        <h4 class="text-sm font-semibold text-indigo-600 uppercase">Total Penjualan</h4>
        <p class="text-2xl font-extrabold text-indigo-800 mt-2">Rp<?= number_format($total_penjualan_bulan_ini) ?></p>
      </div>

      <!-- Total Modal -->
      <div class="bg-white border-l-8 border-pink-500 p-6 rounded-2xl shadow hover:ring-2 ring-pink-300 hover:scale-105 transition duration-300">
        <h4 class="text-sm font-semibold text-pink-600 uppercase">Total Modal Barang</h4>
        <p class="text-2xl font-extrabold text-pink-800 mt-2">Rp<?= number_format($total_modal_bulan_ini) ?></p>
      </div>

      <!-- Laba Bersih -->
      <div class="bg-white border-l-8 border-teal-500 p-6 rounded-2xl shadow hover:ring-2 ring-teal-300 hover:scale-105 transition duration-300">
        <h4 class="text-sm font-semibold text-teal-600 uppercase">Laba Bersih</h4>
        <p class="text-2xl font-extrabold text-teal-800 mt-2">Rp<?= number_format($laba_bersih_bulan_ini) ?></p>
      </div>
    </div>
  </div>

</div>

<?= $this->endSection() ?>
