<?php

namespace App\Models;

use CodeIgniter\Model;

class SubFolderModel extends Model
{
    protected $table = 'sub_folder';
    protected $allowedFields = ['tittle', 'url', 'folder_id'];
}
