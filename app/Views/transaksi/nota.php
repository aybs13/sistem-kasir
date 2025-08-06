<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi</title>
    <style>
        body { font-family: sans-serif; width: 80mm; }
        h2, h4 { margin: 0; padding: 0; }
        .center { text-align: center; }
        .right { text-align: right; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 4px; }
        .line { border-top: 1px dashed #000; margin: 8px 0; }
    </style>
</head>
<body>
    <div class="center">
        <h2>Toko Ma Upa</h2>
        <p>Jl. Contoh No. 123<br>Telp: 0812-0000-0000</p>
    </div>

    <div class="line"></div>

    <p>Kode: <?= $transaksi['kode_transaksi'] ?><br>
    Tanggal: <?= $transaksi['tanggal'] ?><br>
    Kasir: <?= $kasir ?></p>

    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th class="right">Qty</th>
                <th class="right">Harga</th>
                <th class="right">Sub</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detail as $d): ?>
            <tr>
                <td><?= $d['nama_barang'] ?></td>
                <td class="right"><?= $d['qty'] ?></td>
                <td class="right"><?= number_format($d['harga']) ?></td>
                <td class="right"><?= number_format($d['subtotal']) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <div class="line"></div>

    <h4 class="right">Total: Rp<?= number_format($transaksi['total']) ?></h4>
    <h4 class="right">Tunai: Rp<?= number_format($transaksi['tunai']) ?></h4>
    <h4 class="right">Kembali: Rp<?= number_format($transaksi['kembali']) ?></h4>

    <div class="center" style="margin-top: 20px">
        <p>Terima kasih<br>Barang yang sudah dibeli tidak dapat dikembalikan.</p>
    </div>

    <script>window.print()</script>
</body>
</html>
