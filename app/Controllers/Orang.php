<?php

namespace App\Controllers;

use App\Models\OrangModel;

class Orang extends BaseController
{

    protected $orangModel;

    public function __construct()
    {
        $this->orangModel = new OrangModel();
    }


    public function index()
    {
        // $orang = $this->orangModel->findAll();

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $orang = $this->orangModel->search($keyword);
        } else {
            $orang = $this->orangModel;
        }

        $data = [
            'title' => 'orang',
            'orang' => $orang->paginate(10, 'orang'),
            'pager' => $this->orangModel->pager,
        ];

        return view('orang/index', $data);
    }
}
