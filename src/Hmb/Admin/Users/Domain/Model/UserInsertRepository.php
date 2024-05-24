<?php
namespace Admin\Users\Domain\Model;

interface UserInsertRepository
{
    public function search($data): mixed;
    public function delete($id): mixed;
    public function update($data): mixed;
}
