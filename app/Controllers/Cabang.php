<?php

namespace App\Controllers;

use App\Models\CabangModel;

class Cabang extends BaseController
{
    protected $cabangModel;

    public function __construct()
    {
        $this->cabangModel = new CabangModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_cabang') ? $this->request->getVar('page_cabang') : 1;

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $cabang = $this->cabangModel->search($keyword);
        } else {
            $cabang = $this->cabangModel;
        }

        $data = [
            'title' => 'Daftar Cabang',
            'cabang' => $cabang->paginate(5, 'cabang'),
            'pager' => $this->cabangModel->pager,
            'currentPage' => $currentPage
        ];

        return view('cabang/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Cabang',
            'validation' => \Config\Services::validation()
        ];

        return view('cabang/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/cabang/create')->withInput()->with('validation', $validation);
        }

        $this->cabangModel->save([
            'alamat' => $this->request->getVar('alamat'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/cabang');
    }

    public function delete($id)
    {
        $this->cabangModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/cabang');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Cabang',
            'validation' => \Config\Services::validation(),
            'cabang' => $this->cabangModel->find($id)
        ];

        return view('cabang/edit', $data);
    }

    public function update($id)
    {
        $cabangLama = $this->cabangModel->find($id);

        if ($cabangLama['alamat'] != $this->request->getVar('alamat')) {
            $rule_alamat = 'required|is_unique[cabang.alamat]';
        } else {
            $rule_alamat = 'required';
        }

        if (!$this->validate([
            'alamat' => [
                'rules' => $rule_alamat,
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah ada.'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/cabang/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $this->cabangModel->save([
            'id' => $id,
            'alamat' => $this->request->getVar('alamat'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/cabang');
    }
}
