<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Home extends BaseController
{

    protected $bukuModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
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
        ];

        return view('detail', $data);
    }

    public function create_page()
    {
        $data = [
            'title' => 'Create | Komik',
            'validation' => \Config\Services::validation(),
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

        // lakukan validasi
        // $validation =  \Config\Services::validation();
        // $validation->setRules(['content' => 'required']);
        // $isDataValid = $validation->withRequest($this->request)->run();

        // if ($isDataValid) {
        // }
    }
}
