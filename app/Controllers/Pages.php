<?php

namespace App\Controllers;

class Pages extends BaseController
{

  protected $db, $builder, $menuModel;

  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->menuModel = model('App\Models\MenuModel');
    $this->subMenuModel = model('App\Models\SubMenuModel');
  }

  public function index()
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }
    $data = [
      'tittle' => 'Admin',
    ];
    return view('pages/home', $data);
  }

  public function editmenu()
  {
    $this->builder = $this->db->table('sub_menu');

    $data = [
      'tittle' => 'Edit Menu',
      'folder' =>  $this->menuModel->findAll(),
      'subFolder' => $this->builder->get()->getResultArray()
    ];

    return view('pages/editmenu', $data);
  }

  public function addMenu()
  {
    $tittle = $this->request->getVar('namaFolder');
    $url = $this->request->getVar('url');
    $menu_id = $this->request->getVar('menuId');

    $this->subMenuModel->save([
      'tittle' => $tittle,
      'url' => $url,
      'menu_id' => $menu_id,
    ]);
    session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Folder berhasil ditambahkan</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
    return redirect()->to('pages/editmenu');
  }

  public function deleteMenu($id)
  {
    $this->subMenuModel->delete($id);
    session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Folder berhasil dihapus</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
    return redirect()->to('pages/editMenu');
  }
}
