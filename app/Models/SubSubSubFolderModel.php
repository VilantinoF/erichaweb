<?php

namespace App\Models;

use CodeIgniter\Model;

class SubSubSubFolderModel extends Model
{
    protected $table = 'sub_sub_sub_folder';
    protected $allowedFields = ['tittle', 'url', 'sub_sub_folder_id'];
}
