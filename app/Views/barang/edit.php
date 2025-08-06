<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="p-6 max-w-lg mx-auto">
  <h2 class="text-2xl font-bold text-indigo-700 mb-6">Edit Barang</h2>

  <form action="/barang/update/<?= $barang['id'] ?>" method="post" class="space-y-5 bg-white p-6 rounded-lg shadow">

    <div>
      <label for="kode_barcode" class="block text-sm font-medium text-gray-700 mb-1">Barcode</label>
      <input type="text" name="kode_barcode" id="kode_barcode" value="<?= esc($barang['kode_barcode']) ?>"
        class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-indigo-400 outline-none"
        required autofocus>
    </div>

    <div>
      <label for="nama_barang" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
      <input type="text" name="nama_barang" id="nama_barang" value="<?= esc($barang['nama_barang']) ?>"
        class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-indigo-400 outline-none"
        required>
    </div>

    <div>
      <label for="harga_beli" class="block text-sm font-medium text-gray-700 mb-1">Harga Beli</label>
      <input type="number" name="harga_beli" id="harga_beli" value="<?= esc($barang['harga_beli']) ?>"
        class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-indigo-400 outline-none"
        required>
    </div>

    <div>
      <label for="harga_jual" class="block text-sm font-medium text-gray-700 mb-1">Harga Jual</label>
      <input type="number" name="harga_jual" id="harga_jual" value="<?= esc($barang['harga_jual']) ?>"
        class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-indigo-400 outline-none"
        required>
    </div>

    <div>
      <label for="stok" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
      <input type="number" name="stok" id="stok" value="<?= esc($barang['stok']) ?>"
        class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-indigo-400 outline-none"
        required>
    </div>

    <div>
      <label for="expired_at" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Expired <span class="text-gray-400 text-xs">(Opsional)</span></label>
      <input type="date" name="expired_at" id="expired_at" value="<?= esc($barang['expired_at']) ?>"
        class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-indigo-400 outline-none">
    </div>

    <div class="pt-2">
      <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition duration-300">
        Update
      </button>
    </div>

  </form>
</div>

<?= $this->endSection() ?>
