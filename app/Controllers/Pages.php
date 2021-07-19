<?php

namespace App\Controllers;

class Pages extends BaseController
{

  protected $db, $pager, $folderModel, $menuModel, $validation, $subFolderModel, $subSubFolderModel, $subSubSubFolderModel;

  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->menuModel = model('App\Models\MenuModel');
    $this->folderModel = model('App\Models\FolderModel');
    $this->subFolderModel = model('App\Models\SubFolderModel');
    $this->subSubFolderModel = model('App\Models\SubSubFolderModel');
    $this->subSubSubFolderModel = model('App\Models\SubSubSubFolderModel');
    $this->filesModel = model('App\Models\FilesModel');
    $this->validation =  \Config\Services::validation();
    $this->pager = \Config\Services::pager();
  }

  public function index()
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }


    if ($this->request->getPost()) {
      $keyword = $this->request->getVar('keyword');
      $hasilCari = $this->filesModel->like('file', $keyword)->findAll();
      // dd($hasilCari);

      $data = [
        'tittle' => 'Hasil ' . $this->request->getVar('keyword'),
        'hasilCari' => $hasilCari,
        'keyword' => $keyword,
      ];
      return view('user/cari', $data);
    }

    $data = [
      'tittle' => 'Admin',
    ];
    return view('user/home', $data);
  }

  public function manageMenu()
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }
    $this->subFolder = $this->db->table('sub_menu');

    $data = [
      'tittle' => 'Manage Menu',
      'menu' =>  $this->menuModel->findAll(),
      'folder' => $this->folderModel->findAll(),
    ];

    return view('user/managemenu', $data);
  }

  public function addMenu()
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }
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
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }
    $this->folderModel->delete($id);
    session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Folder berhasil dihapus</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
    return redirect()->to('pages/manageMenu');
  }

  public function editMenu($id = null)
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }
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

    return view('user/editmenu', $data);
  }

  public function manageSubFolder()
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }

    $page_indexing = $this->request->getVar('page_subfolder') ? $this->request->getVar('page_subfolder') : 1;

    $data = [
      'tittle' => 'Manage Sub Folder',
      'folder' =>  $this->folderModel->findAll(),
      'subFolder' => $this->subFolderModel->paginate('7', 'subfolder'),
      'pager' => $this->subFolderModel->pager,
      'page_indexing' => $page_indexing,
    ];

    return view('user/managesubfolder', $data);
  }

  public function addSubFolder()
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }

    // dd($this->request->getVar('folderId'));
    $this->subFolderModel->save([
      'tittle' => $this->request->getVar('tittle'),
      'url' => $this->request->getVar('url'),
      'folder_id' => $this->request->getVar('folderId'),
    ]);

    session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Folder berhasil ditambahkan</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
    return redirect()->to('pages/managesubfolder');
  }

  public function deleteSubFolder($id)
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }
    $this->subFolderModel->delete($id);
    session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Sub Folder berhasil dihapus</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
    return redirect()->to('pages/manageSubFolder');
  }


  public function editSubFolder($id = null)
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }
    $data = [
      'tittle' => 'Edit Sub Folder',
      'folder' =>  $this->folderModel->findAll(),
      'subFolderById' => $this->subFolderModel->getWhere(['id' => $id])->getRowArray(),
    ];

    if ($this->request->getPost()) {
      $data = [
        'tittle' => $this->request->getVar('tittle'),
        'url' => $this->request->getVar('url'),
        'folder_id' =>  $this->request->getVar('folderId'),
      ];
      $subFolderId = $this->request->getVar('id');
      $this->subFolderModel->update($subFolderId, $data);
      session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Folder berhasil di edit</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
      return redirect()->to('pages/manageSubFolder');
    }

    return view('user/editsubfolder', $data);
  }


  public function manageSubSubFolder()
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }

    if ($this->request->getPost()) {
      $this->subSubFolderModel->save([
        'tittle' => $this->request->getVar('namaSubSubFolder'),
        'url' => $this->request->getVar('url'),
        'sub_folder_id' => $this->request->getVar('subFolderId'),
      ]);

      session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Folder berhasil ditambahkan</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>');
      return redirect()->to(previous_url());
    } else {
      $page_indexing = $this->request->getVar('page_subsubfolder') ? $this->request->getVar('page_subsubfolder') : 1;
      $data = [
        'tittle' => 'Manage Sub Sub Folder',
        'subSubFolder' => $this->subSubFolderModel->paginate(7, 'subsubfolder'),
        'pager' => $this->subSubFolderModel->pager,
        'subFolder' => $this->subFolderModel->findAll(),
        'folder' => $this->folderModel->findAll(),
        'page_indexing' => $page_indexing,
      ];
      return view('user/managesubsubfolder', $data);
    }
  }

  public function deleteSubSubFolder($id)
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }
    $this->subSubFolderModel->delete($id);
    session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Sub Sub Folder berhasil dihapus</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
    return redirect()->to('pages/manageSubSubFolder');
  }

  public function editSubSubFolder($id = null)
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }
    $data = [
      'tittle' => 'Edit Sub Sub Folder',
      'subFolder' =>  $this->subFolderModel->findAll(),
      'subSubFolderById' => $this->subSubFolderModel->getWhere(['id' => $id])->getRowArray(),
    ];

    if ($this->request->getPost()) {
      $data = [
        'tittle' => $this->request->getVar('tittle'),
        'url' => $this->request->getVar('url'),
        'sub_folder_id' =>  $this->request->getVar('subFolderId'),
      ];
      $subSubFolderId = $this->request->getVar('id');
      $this->subSubFolderModel->update($subSubFolderId, $data);
      session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sub Sub Folder berhasil di edit</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
      return redirect()->to('pages/manageSubSubFolder');
    }

    return view('user/editsubsubfolder', $data);
  }

  public function manageSubSubSubFolder()
  {
    $page_indexing = $this->request->getVar('page_subsubsubfolder') ? $this->request->getVar('page_subsubsubfolder') : 1;
    $data = [
      'tittle' => 'Manage Sub Sub Sub Folder',
      'subSubSubFolder' => $this->subSubSubFolderModel->paginate(7, 'subsubsubfolder'),
      'pager' => $this->subSubSubFolderModel->pager,
      'subSubFolder' => $this->subSubFolderModel->findAll(),
      'page_indexing' => $page_indexing,
    ];

    return view('user/managesubsubsubfolder', $data);
  }

  public function addSubSubSubFolder()
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }

    $this->subSubSubFolderModel->save([
      'tittle' => $this->request->getVar('tittle'),
      'url' => $this->request->getVar('url') ? $this->request->getVar('url') : 'file',
      'sub_sub_folder_id' => $this->request->getVar('subSubFolderId'),
    ]);

    session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Folder berhasil ditambahkan</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
    return redirect()->to('pages/managesubsubsubfolder');
  }

  public function deleteSubSubSubFolder($id)
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }
    $this->subSubSubFolderModel->delete($id);
    session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Folder berhasil dihapus</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
    return redirect()->to('pages/manageSubSubSubFolder');
  }

  public function editSubSubSubFolder($id = null)
  {
    if (session('uname') == null) {
      return redirect()->to('/auth');
    }
    $data = [
      'tittle' => 'Edit Sub Sub Folder',
      'subSubFolder' =>  $this->subSubFolderModel->findAll(),
      'subSubSubFolderById' => $this->subSubSubFolderModel->getWhere(['id' => $id])->getRowArray(),
    ];

    if ($this->request->getPost()) {
      $data = [
        'tittle' => $this->request->getVar('tittle'),
        'url' => $this->request->getVar('url'),
        'sub_sub_folder_id' =>  $this->request->getVar('subSubFolderId'),
      ];
      $subSubSubFolderId = $this->request->getVar('id');
      $this->subSubSubFolderModel->update($subSubSubFolderId, $data);
      session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sub Sub Sub Folder berhasil di edit</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>');
      return redirect()->to('pages/manageSubSubSubFolder');
    }

    return view('user/editsubsubsubfolder', $data);
  }
}
