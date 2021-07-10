<?php

namespace App\Models;

use CodeIgniter\Model;

class SubMenuModel extends Model
{
    protected $table = 'sub_menu';
    protected $allowedFields = ['tittle', 'url', 'menu_id', 'icon'];
}
