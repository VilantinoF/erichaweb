<?php

namespace App\Controllers;

class Pages extends BaseController
{

  protected $db, $folderModel, $menuModel, $validation, $subFolderModel;

  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->menuModel = model('App\Models\MenuModel');
    $this->folderModel = model('App\Models\FolderModel');
    $this->subFolderModel = model('App\Models\SubFolderModel');
    $this->validation =  \Config\Services::validation();
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

  public function manageMenu()
  {
    $this->subFolder = $this->db->table('sub_menu');

    $data = [
      'tittle' => 'Manage Menu',
      'menu' =>  $this->menuModel->findAll(),
      'folder' => $this->folderModel->findAll(),
    ];

    return view('pages/managemenu', $data);
  }

  public function addMenu()
  {
    $tittle = $this->request->getVar('namaFolder');
    $url = $this->request->getVar('url');
    $menu_id = $this->request->getVar('menuId');

    $this->folderModel->save([
      'tittle' => $tittle,
      'url' => $url,
      'menu_id' => $menu_id,
    ]);
    session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Folder berhasil ditambahkan</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
    return redirect()->to('pages/managemenu');
  }

  public function deleteMenu($id)
  {
    $this->folderModel->delete($id);
    session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Folder berhasil dihapus</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
    return redirect()->to('pages/manageMenu');
  }

  public function editMenu($id = null)
  {
    $data = [
      'tittle' => 'Edit Menu',
      'menu' =>  $this->menuModel->findAll(),
      'folderbyid' => $this->folderModel->getWhere(['id' => $id])->getRowArray(),
    ];

    if ($this->request->getPost()) {
      $data = [
        'tittle' => $this->request->getVar('namaFolder'),
        'url' => $this->request->getVar('url'),
        'icon' => $this->request->getVar('icon'),
        'menu_id' =>  $this->request->getVar('menuId'),
      ];
      $folderId = $this->request->getVar('id');
      $this->folderModel->update($folderId, $data);
      session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Folder berhasil di edit</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
      return redirect()->to('pages/managemenu');
    }

    return view('pages/editmenu', $data);
  }

  public function manageSubFolder()
  {

    $data = [
      'tittle' => 'Manage Sub Folder',
      'folder' =>  $this->folderModel->findAll(),
      'subFolder' => $this->subFolderModel->findAll(),
    ];

    return view('pages/managesubfolder', $data);
  }

  public function addSubFolder()
  {

    $this->subFolderModel->save([
      'tittle' => $this->request->getVar('namaFolder'),
      'sub_menu_id' => $this->request->getVar('folderId'),
    ]);

    session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Folder berhasil ditambahkan</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
    return redirect()->to('pages/managesubfolder');
  }

  public function deleteSubFolder($id)
  {
    $this->subFolderModel->delete($id);
    session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Sub Folder berhasil dihapus</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
    return redirect()->to('pages/manageSubFolder');
  }


  public function editSubFolder($id = null)
  {
    $data = [
      'tittle' => 'Edit Sub Folder',
      'folder' =>  $this->folderModel->findAll(),
      'subFolderById' => $this->subFolderModel->getWhere(['id' => $id])->getRowArray(),
    ];

    if ($this->request->getPost()) {
      $data = [
        'tittle' => $this->request->getVar('tittle'),
        'sub_menu_id' =>  $this->request->getVar('folderId'),
      ];
      $subFolderId = $this->request->getVar('id');
      $this->subFolderModel->update($subFolderId, $data);
      session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Folder berhasil di edit</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
      return redirect()->to('pages/manageSubFolder');
    }

    return view('pages/editsubfolder', $data);
  }
}
