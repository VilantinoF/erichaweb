<?php

namespace App\Models;

use CodeIgniter\Model;

class FilesModel extends Model
{
    protected $table = 'files';
    protected $allowedFields = ['file', 'store_file', 'uploaded_at', 'sub_sub_sub_folder_id', 'sub_sub_folder_id', 'sub_folder_id', 'folder_id', 'menu_id'];


    public function getFile()
    {
        $query = "SELECT sub_sub_folder.id, sub_folder.id, folder.id, menu.id, `files`.*
                            FROM files
                        LEFT JOIN sub_sub_folder ON sub_sub_folder.id = files.sub_sub_folder_id
                        LEFT JOIN sub_folder ON sub_folder.id = files.sub_folder_id
                        LEFT JOIN folder ON folder.id = files.folder_id
                        LEFT JOIN menu ON menu.id = files.menu_id
                        ORDER BY `files`.`id` ASC
                ";

        $result = $this->query($query)->getResultArray();
        return $result;
    }

    public function saveFile()
    {
        $data = [
            'file' => $this->request->getFile('file'),
        ];

        $this->insert($data);
    }
}
