<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="max-w-5xl mx-auto p-4 sm:p-6">
  <div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-indigo-700 mb-6 flex items-center gap-2">
      <i class="ti ti-chart-bar text-indigo-600 text-3xl"></i>
      Statistik Penjualan Mingguan
    </h2>

    <div class="overflow-x-auto">
      <canvas id="chart" class="w-full h-60 md:h-80"></canvas>
    </div>
  </div>

  <div class="bg-white mt-8 p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
      <i class="ti ti-star text-yellow-500 text-2xl"></i>
      Produk Terlaris Minggu Ini
    </h3>

    <?php if (!empty($topProduk)): ?>
      <ul class="space-y-2 text-gray-700 list-inside list-disc">
        <?php foreach ($topProduk as $p): ?>
          <li class="pl-1"><?= esc($p['nama_barang']) ?> <span class="text-sm text-gray-500">(<?= $p['total_qty'] ?> terjual)</span></li>
        <?php endforeach ?>
      </ul>
    <?php else: ?>
      <p class="text-gray-500">Belum ada data produk terlaris minggu ini.</p>
    <?php endif ?>
  </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chart').getContext('2d')
const chart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?= json_encode(array_column($weekly, 'tanggal')) ?>,
    datasets: [{
      label: 'Total Penjualan (Rp)',
      data: <?= json_encode(array_column($weekly, 'total')) ?>,
      backgroundColor: 'rgba(99, 102, 241, 0.5)', // Indigo
      borderColor: 'rgba(99, 102, 241, 1)',
      borderWidth: 1,
      borderRadius: 4,
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          callback: function(value) {
            return 'Rp ' + value.toLocaleString('id-ID')
          }
        }
      }
    }
  }
})
</script>

<?= $this->endSection() ?>
