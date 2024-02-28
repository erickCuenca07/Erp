<?php 
namespace Admin\Users\Application\Handler;

use Admin\Users\Domain\Service\UserSearchService;

class UserSearchHandler
{
    public function __construct(
        private readonly UserSearchService $userSearchService
    ){}

    public function handle():mixed
    {
        return $this->userSearchService->execute();
    }
}    