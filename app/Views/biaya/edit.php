<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow mt-10">

  <h2 class="text-2xl font-semibold text-indigo-700 mb-6">Edit Biaya Operasional</h2>

  <?php if(session()->getFlashdata('errors')): ?>
  <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
    <ul class="list-disc list-inside">
      <?php foreach(session()->getFlashdata('errors') as $error): ?>
        <li><?= esc($error) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endif; ?>

  <form action="<?= base_url('biaya/update/'.$biaya['id']) ?>" method="post" class="space-y-5">
    <!-- Gunakan hidden input untuk spoof method PUT -->
    <input type="hidden" name="_method" value="PUT" />

    <div>
      <label for="nama" class="block font-medium text-gray-700 mb-1">Nama Biaya</label>
      <input type="text" name="nama" id="nama" required
        value="<?= old('nama', $biaya['nama']) ?>"
        class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
    </div>

    <div>
      <label for="jumlah" class="block font-medium text-gray-700 mb-1">Jumlah (Rp)</label>
      <input type="number" name="jumlah" id="jumlah" required min="0"
        value="<?= old('jumlah', $biaya['jumlah']) ?>"
        class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
    </div>

    <div>
      <label for="tanggal" class="block font-medium text-gray-700 mb-1">Tanggal</label>
      <input type="date" name="tanggal" id="tanggal" required
        value="<?= old('tanggal', $biaya['tanggal']) ?>"
        class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
    </div>

    <div>
      <button type="submit"
        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition duration-300">
        Perbarui
      </button>
    </div>

  </form>

  <a href="<?= base_url('biaya') ?>" class="inline-block mt-4 text-indigo-600 hover:underline">&larr; Kembali ke daftar</a>

</div>

<?= $this->endSection() ?>
