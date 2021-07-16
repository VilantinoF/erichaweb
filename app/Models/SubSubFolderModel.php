<?php

namespace App\Models;

use CodeIgniter\Model;

class SubSubFolderModel extends Model
{
    protected $table = 'sub_sub_folder';
    protected $allowedFields = ['tittle', 'url', 'sub_folder_id'];
}
