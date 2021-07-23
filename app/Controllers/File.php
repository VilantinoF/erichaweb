<?php

namespace App\Controllers;

use App\Models\FilesModel;
use App\Models\FolderModel;
use App\Models\SubFolderModel;
use App\Models\SubSubFolderModel;
use App\Models\SubSubSubFolderModel;
use CodeIgniter\HTTP\Files\UploadedFile;

class File extends BaseController
{

    protected $filesModel, $subSubFolderModel, $subFolderModel, $folderModel, $subSubSubFolderModel;

    public function __construct()
    {
        $this->folderModel = new FolderModel();
        $this->subFolderModel = new SubFolderModel();
        $this->subSubFolderModel = new SubSubFolderModel();
        $this->subSubSubFolderModel = new SubSubSubFolderModel();
        $this->filesModel = new FilesModel();
    }

    public function index()
    {
        if (session('uname') == null) {
            return redirect()->to('/auth');
        }

        $session = session();
        if ($session->get('role') == 3) {
            $parsing = explode('/', uri_string());
            // dd($parsing);

            if (!empty($parsing[1]) and !empty($parsing[2]) and !empty($parsing[3]) and !empty($parsing[4])) {
                $folderId = $parsing[1];
                $subFolderId = $parsing[2];
                $subSubFolderId = $parsing[3];
                $subSubSubFolderId = $parsing[4];
                $query = "SELECT * FROM files
                    WHERE folder_id = $folderId
                    AND sub_folder_id = $subFolderId
                    AND sub_sub_folder_id = $subSubFolderId
                    AND sub_sub_sub_folder_id = $subSubSubFolderId
                    ORDER BY id ASC
                ";
            } elseif (!empty($parsing[1]) and !empty($parsing[2]) and !empty($parsing[3])) {
                $folderId = $parsing[1];
                $subFolderId = $parsing[2];
                $subSubFolderId = $parsing[3];
                $query = "SELECT * FROM files
                    WHERE folder_id = $folderId
                    AND sub_folder_id = $subFolderId
                    AND sub_sub_folder_id = $subSubFolderId
                    ORDER BY id ASC
                ";
            } elseif (!empty($parsing[1]) and !empty($parsing[2])) {
                $folderId = $parsing[1];
                $subFolderId = $parsing[2];
                $query = "SELECT * FROM files
                    WHERE folder_id = $folderId
                    AND sub_folder_id = $subFolderId
                    ORDER BY id ASC
                ";
            } else {
                $folderId = $parsing[1];
                $query = "SELECT * FROM files
                    WHERE folder_id = $folderId
                    ORDER BY id ASC
                ";
            }

            $result = $this->filesModel->query($query)->getResultArray();

            $data = [
                'tittle' => 'Administrasi Bisnis',
                'files' => $result,
            ];
            return view('user/dosen/file', $data);
        }

        $parsing = explode('/', uri_string());
        // dd($parsing);
        if (!empty($parsing[1]) and !empty($parsing[2]) and !empty($parsing[3]) and !empty($parsing[4])) {
            $folderId = $parsing[1];
            $subFolderId = $parsing[2];
            $subSubFolderId = $parsing[3];
            $subSubSubFolderId = $parsing[4];
            $query = "SELECT * FROM files
                WHERE folder_id = $folderId
                AND sub_folder_id = $subFolderId
                AND sub_sub_folder_id = $subSubFolderId
                AND sub_sub_sub_folder_id = $subSubSubFolderId
                ORDER BY id ASC
            ";
        } elseif (!empty($parsing[1]) and !empty($parsing[2]) and !empty($parsing[3])) {
            $folderId = $parsing[1];
            $subFolderId = $parsing[2];
            $subSubFolderId = $parsing[3];
            $query = "SELECT * FROM files
                WHERE folder_id = $folderId
                AND sub_folder_id = $subFolderId
                AND sub_sub_folder_id = $subSubFolderId
                ORDER BY id ASC
            ";
        } elseif (!empty($parsing[1]) and !empty($parsing[2])) {
            $folderId = $parsing[1];
            $subFolderId = $parsing[2];
            $query = "SELECT * FROM files
                WHERE folder_id = $folderId
                AND sub_folder_id = $subFolderId
                ORDER BY id ASC
            ";
        } else {
            $folderId = $parsing[1];
            $query = "SELECT * FROM files
                WHERE folder_id = $folderId
                ORDER BY id ASC
            ";
        }

        $result = $this->filesModel->query($query)->getResultArray();

        $data = [
            'tittle' => 'Upload File',
            'files' => $result,
        ];
        return view('user/admin/file', $data);
    }


    public function addFile()
    {
        if (session('uname') == null) {
            return redirect()->to('/auth');
        }
        // dd($this->request->getFile('file'));
        $file = $this->request->getFile('file');
        if (!$file->isValid()) {
            throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
        } else {
            // dd($this->request->getVar('subFolderId'));
            // dd($this->request->getVar('subSubSubFolderId'));
            $newFileName = $file->getRandomName();
            $file->move('files/', $newFileName);
            $data = [
                'file' => $file->getClientName(),
                'store_file' => $newFileName,
                'sub_sub_sub_folder_id' => $this->request->getVar('subSubSubFolderId'),
                'sub_sub_folder_id' => $this->request->getVar('subSubFolderId'),
                'sub_folder_id' => $this->request->getVar('subFolderId'),
                'folder_id' => $this->request->getVar('folderId'),
            ];
            $this->filesModel->insert($data);
            session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>File berhasil ditambahkan</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>');

            if ($this->request->getVar('subSubSubFolderId') != null) {
                return redirect()->to('/file/' . $this->request->getVar('folderId') . '/' . $this->request->getVar('subFolderId') . '/' . $this->request->getVar('subSubFolderId') . '/' . $this->request->getVar('subSubSubFolderId'));
            } elseif ($this->request->getVar('subSubFolderId') != null) {
                return redirect()->to('/file/' . $this->request->getVar('folderId') . '/' . $this->request->getVar('subFolderId') . '/' . $this->request->getVar('subSubFolderId'));
            } elseif ($this->request->getVar('subFolderId') != null) {
                return redirect()->to('/file/' . $this->request->getVar('folderId') . '/' . $this->request->getVar('subFolderId'));
            } else {
                return redirect()->to('/file/' . $this->request->getVar('folderId'));
            }
        }
    }

    public function deleteFile($id)
    {
        if (session('uname') == null) {
            return redirect()->to('/auth');
        }

        $file = $this->filesModel->find($id);
        unlink('files/' . $file['store_file']);

        $this->filesModel->delete($id);

        session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>File berhasil dihapus</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>');

        $parsing = explode('/', previous_url());
        if (!empty($parsing[4]) and !empty($parsing[5]) and !empty($parsing[6]) and !empty($parsing[7])) {
            $folderId = $parsing[4];
            $subFolderId = $parsing[5];
            $subSubFolderId = $parsing[6];
            $subSubSubFolderId = $parsing[7];
            return redirect()->to('file/' . $folderId . '/' . $subFolderId . '/' . $subSubFolderId . '/' . $subSubSubFolderId);
        } elseif (!empty($parsing[4]) and !empty($parsing[5]) and !empty($parsing[6])) {
            $folderId = $parsing[4];
            $subFolderId = $parsing[5];
            $subSubFolderId = $parsing[6];
            return redirect()->to('file/' . $folderId . '/' . $subFolderId . '/' . $subSubFolderId);
        } elseif (!empty($parsing[4]) and !empty($parsing[5])) {
            $folderId = $parsing[4];
            $subFolderId = $parsing[5];
            return redirect()->to('file/' . $folderId . '/' . $subFolderId);
        } else {
            $folderId = $parsing[4];
            return redirect()->to('file/' . $folderId);
        }
    }
}
