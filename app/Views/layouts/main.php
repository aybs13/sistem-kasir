<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'Toko Ma Upa') ?></title>

  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <!-- Tabler Icons -->
  <link href="https://unpkg.com/@tabler/icons@1.74.0/iconfont/tabler-icons.min.css" rel="stylesheet">

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('-translate-x-full');
    }
  </script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen font-sans">

<!-- Wrapper -->
<div class="flex h-screen overflow-hidden">

  <!-- Sidebar -->
  <aside id="sidebar" class="fixed md:static z-30 w-64 bg-gradient-to-b from-indigo-800 to-indigo-600 text-white shadow-lg transform md:translate-x-0 -translate-x-full transition-transform duration-300 ease-in-out flex flex-col">
    <div class="p-5 border-b border-indigo-500 flex items-center gap-3 text-xl font-semibold">
      <i class="ti ti-shopping-cart text-2xl"></i> Toko Ma Upa
    </div>

    <nav class="flex-1 p-4 space-y-1 text-sm">
    <?php if (session('role') === 'admin'): ?>
        <a href="<?= base_url('dashboard') ?>" class="flex items-center gap-3 px-4 py-2 rounded-md transition hover:bg-indigo-500 <?= uri_string() == 'dashboard' ? 'bg-indigo-700 font-semibold' : '' ?>">
        <i class="ti ti-home text-lg"></i> Dashboard
        </a>
        <a href="<?= base_url('barang') ?>" class="flex items-center gap-3 px-4 py-2 rounded-md transition hover:bg-indigo-500 <?= uri_string() == 'barang' ? 'bg-indigo-700 font-semibold' : '' ?>">
        <i class="ti ti-package"></i> Barang
        </a>
        <a href="<?= base_url('dashboard/statistik') ?>" class="flex items-center gap-3 px-4 py-2 rounded-md transition hover:bg-indigo-500 <?= uri_string() == 'dashboard/statistik' ? 'bg-indigo-700 font-semibold' : '' ?>">
        <i class="ti ti-chart-bar text-lg"></i> Statistik Penjualan
        </a>
        <a href="<?= base_url('laporan') ?>" class="flex items-center gap-3 px-4 py-2 rounded-md transition hover:bg-indigo-500 <?= uri_string() == 'laporan' ? 'bg-indigo-700 font-semibold' : '' ?>">
        <i class="ti ti-report-money text-lg"></i> Laporan
        </a>
        <a href="<?= base_url('stok-menipis') ?>" class="flex items-center gap-3 px-4 py-2 rounded-md transition hover:bg-indigo-500">
        <i class="ti ti-alert-triangle text-lg"></i> Stok Menipis
        </a>
        <a href="<?= base_url('barang/expired') ?>" class="flex items-center gap-3 px-4 py-2 rounded-md transition hover:bg-indigo-500">
        <i class="ti ti-clock-off"></i> Barang Expired
        </a>
        <a href="<?= base_url('laporan/laba-rugi') ?>" class="flex items-center gap-3 px-4 py-2 rounded-md transition hover:bg-indigo-500 <?= uri_string() == 'laporan/laba-rugi' ? 'bg-indigo-700 font-semibold' : '' ?>">
        <i class="ti ti-report-analytics text-lg"></i> Laporan Laba/Rugi
        </a>
        <a href="<?= base_url('biaya') ?>" class="flex items-center gap-3 px-4 py-2 rounded-md transition hover:bg-indigo-500 <?= uri_string() == 'biaya' ? 'bg-indigo-700 font-semibold' : '' ?>">
        <i class="ti ti-wallet text-lg"></i> Biaya Operasional
        </a>
        <a href="<?= base_url('user') ?>" class="flex items-center gap-3 px-4 py-2 rounded-md transition hover:bg-indigo-500">
        <i class="ti ti-users"></i> Manajemen Pengguna
        </a>
    <?php endif ?>

    <?php if (session('role') === 'kasir'): ?>
        <a href="<?= base_url('transaksi') ?>" class="flex items-center gap-3 px-4 py-2 rounded-md transition hover:bg-indigo-500 <?= uri_string() == 'transaksi' ? 'bg-indigo-700 font-semibold' : '' ?>">
        <i class="ti ti-cash text-lg"></i> Transaksi
        </a>
        <a href="<?= base_url('riwayat') ?>" class="flex items-center gap-3 px-4 py-2 rounded-md transition hover:bg-indigo-500 <?= uri_string() == 'riwayat' ? 'bg-indigo-700 font-semibold' : '' ?>">
        <i class="ti ti-history text-lg"></i> Riwayat Transaksi
        </a>
    <?php endif ?>
    </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden w-full">

        <!-- Topbar -->
    <header class="bg-white border-b px-4 py-3 flex justify-between items-center shadow-sm md:px-6">
    <div class="flex items-center gap-3">
        <!-- Hamburger Button -->
        <button class="md:hidden text-gray-600 focus:outline-none" onclick="toggleSidebar()">
        <i class="ti ti-menu-2 text-2xl"></i>
        </button>
        <div class="text-xl font-semibold text-gray-700 tracking-wide">
        <?= esc($title ?? 'Halaman') ?>
        </div>
    </div>
    <div class="flex items-center space-x-3">
        <div class="flex items-center space-x-2 bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm">
        <i class="ti ti-user-circle text-lg"></i>
        <span><?= session('username') ?></span>
        </div>
        <a href="<?= base_url('logout') ?>" class="text-red-600 hover:text-red-800 text-sm font-medium transition">
        <i class="ti ti-logout"></i> Logout
        </a>
    </div>
    </header>


        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
        <?= $this->renderSection('content') ?>
        </main>
    </div>
    </div>

</body>
</html>
