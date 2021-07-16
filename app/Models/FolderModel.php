<?php

namespace App\Models;

use CodeIgniter\Model;

class FolderModel extends Model
{
    protected $table = 'folder';
    protected $allowedFields = ['tittle', 'url', 'menu_id', 'icon'];
}
