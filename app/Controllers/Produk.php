<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Produk extends BaseController
{
    protected $produkModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_produk') ? $this->request->getVar('page_produk') : 1;

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $produk = $this->produkModel->search($keyword);
        } else {
            $produk = $this->produkModel;
        }

        $data = [
            'title' => 'Daftar Produk',
            'produk' => $produk->paginate(5, 'produk'),
            'pager' => $this->produkModel->pager,
            'currentPage' => $currentPage
        ];

        return view('produk/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Produk',
            'validation' => \Config\Services::validation()
        ];

        return view('produk/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[produk.nama]',
                'errors' => [
                    'required' => '{field} produk harus diisi.',
                    'is_unique' => '{field} produk sudah ada.'
                ]
            ],
            'stok' => [
                'rules' => 'required|is_unique[produk.nama]',
                'errors' => [
                    'required' => '{field} produk harus diisi.',
                    'is_unique' => '{field} produk sudah ada.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/produk/create')->withInput()->with('validation', $validation);
        }

        $this->produkModel->save([
            'nama' => $this->request->getVar('nama'),
            'stok' => $this->request->getVar('stok'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/');
    }

    public function delete($id)
    {
        $this->produkModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Produk',
            'validation' => \Config\Services::validation(),
            'produk' => $this->produkModel->find($id)
        ];

        return view('produk/edit', $data);
    }

    public function update($id)
    {
        $produkLama = $this->produkModel->find($id);

        if ($produkLama['nama'] == $this->request->getVar('nama')) {
            $rule_nama = 'required|is_unique[produk.nama]';
        } else {
            $rule_nama = 'required';
        }


        if (!$this->validate([
            'nama' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => '{field} produk harus diisi.',
                    'is_unique' => '{field} produk sudah ada.'
                ]
            ],
            'stok' => [
                'rules' => 'required|is_unique[produk.nama]',
                'errors' => [
                    'required' => '{field} produk harus diisi.',
                    'is_unique' => '{field} produk sudah ada.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/produk/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $this->produkModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'stok' => $this->request->getVar('stok'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/');
    }
}
