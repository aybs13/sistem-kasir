<?php

namespace App\Controllers;

use App\Models\BiayaOperasionalModel;

class BiayaOperasional extends BaseController
{
    protected $biayaModel;

    public function __construct()
    {
        $this->biayaModel = new BiayaOperasionalModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Biaya Operasional',
            'biaya' => $this->biayaModel->orderBy('tanggal', 'DESC')->findAll()
        ];
        return view('biaya/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Biaya Operasional'
        ];
        return view('biaya/create', $data);
    }

    public function store()
    {
        $validated = $this->validate([
            'nama' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|valid_date[Y-m-d]'
        ]);

        if (!$validated) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->biayaModel->insert([
            'nama' => $this->request->getPost('nama'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tanggal' => $this->request->getPost('tanggal')
        ]);

        return redirect()->to('/biaya')->with('success', 'Data biaya operasional berhasil disimpan.');
    }

    public function edit($id)
    {
        $biaya = $this->biayaModel->find($id);

        if (!$biaya) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Biaya dengan ID $id tidak ditemukan");
        }

        $data = [
            'title' => 'Edit Biaya Operasional',
            'biaya' => $biaya
        ];
        return view('biaya/edit', $data);
    }

    public function update($id)
    {
        $validated = $this->validate([
            'nama' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|valid_date[Y-m-d]'
        ]);

        if (!$validated) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->biayaModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tanggal' => $this->request->getPost('tanggal')
        ]);

        return redirect()->to('/biaya')->with('success', 'Data biaya operasional berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->biayaModel->delete($id);
        return redirect()->to('/biaya')->with('success', 'Data biaya operasional berhasil dihapus.');
    }
}
