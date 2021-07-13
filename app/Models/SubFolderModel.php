<?php

namespace App\Models;

use CodeIgniter\Model;

class SubFolderModel extends Model
{
    protected $table = 'sub_sub_menu';
    protected $allowedFields = ['tittle', 'sub_menu_id'];
}
