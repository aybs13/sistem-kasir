<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="p-6 max-w-4xl mx-auto">
  <h2 class="text-3xl font-bold text-indigo-700 mb-8 flex items-center gap-2">
    <i class="ti ti-cash text-indigo-600 text-3xl"></i>
    Transaksi Penjualan
  </h2>

  <!-- Input Scan -->
  <div class="mb-6">
    <input
      id="scan"
      type="text"
      class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"
      placeholder="🔍 Scan barcode barang..."
      autofocus
    >
  </div>

  <!-- Form Transaksi -->
  <form id="form-transaksi" class="space-y-6">

    <!-- Tabel Daftar Barang -->
    <div class="overflow-x-auto rounded-lg shadow border border-gray-200">
      <table class="w-full text-sm text-gray-700">
        <thead class="bg-indigo-50 text-indigo-700 text-center uppercase text-xs font-semibold">
          <tr>
            <th class="py-3 px-4 border">Nama</th>
            <th class="py-3 px-4 border">Harga</th>
            <th class="py-3 px-4 border">Qty</th>
            <th class="py-3 px-4 border">Subtotal</th>
            <th class="py-3 px-4 border">Aksi</th>
          </tr>
        </thead>
        <tbody id="daftar-barang" class="text-center"></tbody>
      </table>
    </div>

    <!-- Total -->
    <div class="flex justify-end text-xl font-bold text-gray-800 mt-4">
      <span>Total: Rp <span id="total">0</span></span>
    </div>

    <!-- Tunai -->
    <div class="flex justify-end items-center gap-3">
      <label for="tunai" class="font-medium text-gray-700">Tunai:</label>
      <input
        id="tunai"
        type="number"
        class="w-40 border border-gray-300 rounded px-3 py-2 text-right shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none"
        placeholder="Rp 0"
        required
      >
    </div>

    <!-- Kembalian -->
    <div class="flex justify-end items-center gap-3">
      <label for="kembalian" class="font-medium text-gray-700">Kembalian:</label>
      <input
        id="kembalian"
        type="text"
        class="w-40 border border-gray-200 bg-gray-100 rounded px-3 py-2 text-right text-gray-600 shadow-inner"
        readonly
      >
    </div>

    <!-- Tombol Simpan -->
    <div class="flex justify-end pt-4">
      <button
        type="submit"
        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-300"
      >
        💾 Simpan Transaksi
      </button>
    </div>

  </form>
</div>



<script>
let items = []

function updateTable() {
  let html = ''
  let total = 0
  items.forEach((item, i) => {
    const subtotal = item.harga_jual * item.qty
    total += subtotal
    html += `
      <tr class="text-center">
        <td>${item.nama_barang}</td>
        <td>Rp${item.harga_jual}</td>
        <td>
          <input type="number" value="${item.qty}" min="1" onchange="ubahQty(${i}, this.value)" class="w-16 text-center border">
        </td>
        <td>Rp${subtotal}</td>
        <td><button onclick="hapus(${i})" type="button" class="text-red-500">x</button></td>
      </tr>
    `
  })
  document.getElementById('daftar-barang').innerHTML = html
  document.getElementById('total').innerText = total

  const tunai = parseInt(document.getElementById('tunai').value) || 0
  document.getElementById('kembalian').value = 'Rp' + Math.max(tunai - total, 0)
}

function ubahQty(index, qty) {
  items[index].qty = parseInt(qty)
  updateTable()
}

function hapus(index) {
  items.splice(index, 1)
  updateTable()
}

document.getElementById('scan').addEventListener('keypress', function(e) {
  if (e.key === 'Enter') {
    e.preventDefault()
    const barcode = this.value.trim()
    if (!barcode) return

    // Gunakan FormData untuk menghindari masalah tipe data
    const formData = new FormData()
    formData.append('barcode', barcode)

    fetch('/transaksi/cari', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
    if (!data || data.id === undefined) {
    alert('Barang tidak ditemukan!')
    } else {
    const index = items.findIndex(i => i.id == data.id)
    if (index >= 0) {
        items[index].qty++
    } else {
        items.push({ ...data, qty: 1 })
    }
    updateTable()
    }
      this.value = ''
    })
    .catch(err => {
      console.error('Gagal fetch barang:', err)
      alert('Terjadi kesalahan saat mencari barang.')
    })
  }
})

document.getElementById('tunai').addEventListener('input', () => updateTable())

document.getElementById('form-transaksi').addEventListener('submit', function(e) {
  e.preventDefault()
  if (items.length === 0) return alert('Keranjang kosong')

  const total = items.reduce((acc, item) => acc + (item.harga_jual * item.qty), 0)
  const tunai = parseInt(document.getElementById('tunai').value || 0)
  const kembali = tunai - total

  if (tunai < total) {
    alert('Uang tunai kurang!')
    return
  }

  const sendData = items.map(item => ({
    id: item.id,
    qty: item.qty,
    harga: item.harga_jual,
    subtotal: item.harga_jual * item.qty,
    stok: item.stok
  }))

  fetch('/transaksi/simpan', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ items: sendData, total, tunai, kembali })
  })
  .then(res => res.json())
  .then(data => {
    if (data.status === 'ok') {
      window.open('/transaksi/nota/' + data.id, '_blank')
      window.location.reload()
    } else {
      alert(data.message || 'Gagal menyimpan transaksi')
    }
  })
  .catch(err => {
    console.error('Gagal menyimpan transaksi:', err)
    alert('Terjadi kesalahan saat menyimpan transaksi.')
  })
})
</script>


<?= $this->endSection() ?>
