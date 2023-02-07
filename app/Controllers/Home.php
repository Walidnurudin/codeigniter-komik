<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\OrangModel;

class Home extends BaseController
{

    protected $bukuModel;
    protected $orangModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->orangModel = new OrangModel();
    }


    public function index()
    {
        // 
        // $db = \Config\Database::connect();
        // $query = $db->query('SELECT * FROM buku;');

        // connnct with model


        // $data['komik']   = $query->getResult();

        $komik = $this->bukuModel->getBuku();
        $data = [
            'title' => 'komik',
            'komik' => $komik,
        ];

        return view('home', $data);
    }

    public function detail($slug)
    {
        $komik = $this->bukuModel->getBuku($slug);

        if (empty($komik)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik ' . $slug . ' tidak ditemukan.');
        }

        $data = [
            'title' => "Detail {$slug} | komik",
            'komik' => $komik,
            'writer' => $this->orangModel->getById($komik['writer']),
        ];

        return view('detail', $data);
    }

    public function create_page()
    {
        $data = [
            'title' => 'Create | Komik',
            'validation' => \Config\Services::validation(),
            'orang' => $this->orangModel->findAll(),
        ];

        return view('create', $data);
    }

    public function create()
    {
        // validate input
        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[buku.name]',
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar',
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/create')->withInput()->with('validation', $validation);
        }

        // insert data
        $slug = url_title($this->request->getVar('name'), '-', true);

        $this->bukuModel->save([
            'name' => $this->request->getVar('name'),
            'slug' => $slug,
            'content' => $this->request->getVar('content'),
            'writer' => $this->request->getVar('writer'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/');
    }

    public function edit_page($slug)
    {
        $komik = $this->bukuModel->getBuku($slug);

        $data = [
            'title' => "Edit {$slug} | komik",
            'komik' => $komik,
            'validation' => \Config\Services::validation(),
            'orang' => $this->orangModel->findAll(),
        ];

        return view('edit', $data);
    }

    public function edit($id)
    {

        // cek name komik
        $komikLama = $this->bukuModel->getBuku($this->request->getVar('slug'));
        if ($komikLama['name'] == $this->request->getVar('name')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[buku.name]';
        }

        // validate input
        if (!$this->validate([
            'name' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar',
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }

        // update data
        $slug = url_title($this->request->getVar('name'), '-', true);
        $this->bukuModel->save([
            'id' => $id,
            'name' => $this->request->getVar('name'),
            'slug' => $slug,
            'content' => $this->request->getVar('content'),
            'writer' => $this->request->getVar('writer'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        $this->bukuModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/');
    }
}
