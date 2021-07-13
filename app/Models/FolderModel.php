<?php

namespace App\Models;

use CodeIgniter\Model;

class FolderModel extends Model
{
    protected $table = 'sub_menu';
    protected $allowedFields = ['tittle', 'url', 'menu_id', 'icon'];
}
