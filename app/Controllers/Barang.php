<?php
namespace App\Controllers;
use App\Models\BarangModel;

class Barang extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        if (!$this->isAdmin()) return $this->deny();
        $data['barang'] = $this->barangModel->findAll();
        return view('barang/index', $data);
    }

    public function create()
    {
        if (!$this->isAdmin()) return $this->deny();
        return view('barang/create');
    }

    public function store()
    {
        if (!$this->isAdmin()) return $this->deny();

        $expired = $this->request->getPost('expired_at');
        $this->barangModel->save([
            'kode_barcode' => $this->request->getPost('kode_barcode'),
            'nama_barang'  => $this->request->getPost('nama_barang'),
            'harga_beli'   => $this->request->getPost('harga_beli'),
            'harga_jual'   => $this->request->getPost('harga_jual'),
            'stok'         => $this->request->getPost('stok'),
            'expired_at'   => $expired ? $expired : null,
        ]);
        return redirect()->to('/barang');
    }

    public function edit($id)
    {
        $barang = $this->barangModel->find($id);
        if (!$barang) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('barang/edit', ['barang' => $barang]);
    }

    public function update($id)
    {
        if (!$this->isAdmin()) return $this->deny();

        $expired = $this->request->getPost('expired_at');
        $this->barangModel->update($id, [
            'kode_barcode' => $this->request->getPost('kode_barcode'),
            'nama_barang'  => $this->request->getPost('nama_barang'),
            'harga_beli'   => $this->request->getPost('harga_beli'),
            'harga_jual'   => $this->request->getPost('harga_jual'),
            'stok'         => $this->request->getPost('stok'),
            'expired_at'   => $expired ? $expired : null,
        ]);
        return redirect()->to('/barang');
    }

    public function delete($id)
    {
        if (!$this->isAdmin()) return $this->deny();
        $this->barangModel->delete($id);
        return redirect()->to('/barang');
    }

    public function stokMenipis()
    {
        if (!$this->isAdmin()) return $this->deny();
        $data = [
            'title'  => 'Stok Menipis',
            'barang' => $this->barangModel->getStokMenipis()
        ];
        return view('barang/stok_menipis', $data);
    }

    public function expired()
    {
        if (!$this->isAdmin()) return $this->deny();
        $barang = $this->barangModel->getBarangExpired();
        return view('barang/expired', [
            'title'  => 'Barang Hampir Expired',
            'barang' => $barang
        ]);
    }

    private function deny()
    {
        return redirect()->to('/dashboard')->with('error', 'Akses ditolak!');
    }
}
