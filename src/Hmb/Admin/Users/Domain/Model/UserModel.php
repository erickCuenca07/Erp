<?php 
namespace Admin\Users\Domain\Model;

use App\Models\User as UserLaravel;

class UserModel extends UserLaravel
{
    public function __construct()
    {
        parent::__construct();
    }   
}