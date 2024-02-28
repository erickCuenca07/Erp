<?php 
namespace Admin\Users\Domain\Service;

use Admin\Users\Domain\Model\UserSearchRepository;

class UserSearchService
{
    public function __construct(
        private readonly UserSearchRepository $repository
    )
    {}
    public function execute(): mixed
    {
        return $this->repository->search();
    }
}