<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
  <div class="bg-white shadow-xl rounded-xl p-6 mt-10 border border-gray-100">
    
    <!-- Header -->
    <div class="mb-6">
      <h2 class="text-2xl font-bold text-indigo-700 mb-1 flex items-center gap-2">
        <i class="ti ti-box text-xl"></i>
        Tambah Barang Baru
      </h2>
      <p class="text-gray-500 text-sm">Masukkan detail barang secara lengkap dan akurat.</p>
    </div>

    <!-- Form -->
    <form action="/barang/store" method="post" class="space-y-4 text-sm">

      <!-- Barcode -->
      <div>
        <label for="kode_barcode" class="block font-medium text-gray-700 mb-1">Barcode</label>
        <input type="text" name="kode_barcode" id="kode_barcode" placeholder="Scan / Input Barcode"
          class="w-full border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-indigo-400 outline-none"
          required autofocus>
      </div>

      <!-- Nama Barang -->
      <div>
        <label for="nama_barang" class="block font-medium text-gray-700 mb-1">Nama Barang</label>
        <input type="text" name="nama_barang" id="nama_barang" placeholder="Contoh: Indomie Goreng"
          class="w-full border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-indigo-400 outline-none"
          required>
      </div>

      <!-- Harga Beli -->
      <div>
        <label for="harga_beli" class="block font-medium text-gray-700 mb-1">Harga Beli</label>
        <input type="number" name="harga_beli" id="harga_beli" placeholder="Rp"
          class="w-full border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-indigo-400 outline-none"
          required>
      </div>

      <!-- Harga Jual -->
      <div>
        <label for="harga_jual" class="block font-medium text-gray-700 mb-1">Harga Jual</label>
        <input type="number" name="harga_jual" id="harga_jual" placeholder="Rp"
          class="w-full border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-indigo-400 outline-none"
          required>
      </div>

      <!-- Stok -->
      <div>
        <label for="stok" class="block font-medium text-gray-700 mb-1">Stok</label>
        <input type="number" name="stok" id="stok" placeholder="Jumlah Stok"
          class="w-full border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-indigo-400 outline-none"
          required>
      </div>

      <!-- Tanggal Expired -->
      <div>
        <label for="expired_at" class="block font-medium text-gray-700 mb-1">Tanggal Expired <span class="text-gray-400 text-xs">(Opsional)</span></label>
        <input type="date" name="expired_at" id="expired_at"
          class="w-full border border-gray-300 p-2 rounded-md focus:ring-2 focus:ring-indigo-400 outline-none">
      </div>

      <!-- Tombol -->
      <div class="pt-2">
        <button type="submit"
          class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-md shadow-sm transition duration-300 flex items-center justify-center gap-2">
          <i class="ti ti-plus"></i> Simpan Barang
        </button>
      </div>

    </form>
  </div>
</div>

<?= $this->endSection() ?>
