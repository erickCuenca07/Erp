<?php 
namespace Admin\Users\Domain\Model;

interface UserSearchRepository
{
    public function search(): mixed;
}