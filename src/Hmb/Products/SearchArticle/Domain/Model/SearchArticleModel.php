<?php

namespace Products\SearchArticle\Domain\Model;
class SearchArticleModel
{
    public function __construct(
        private readonly string $articleId,
        private readonly string $nameArticle,
        private readonly int $stock,
        private readonly int $receive,
        private readonly int $serve,
        private readonly string $store,
        private readonly string $storeName
    ){}
    public function toArray(): array
    {
        return [
            'articleId' => $this->getArticleId(),
            'nameArticle' => $this->getNameArticle(),
            'stock' => $this->getStock(),
            'receive' => $this->getReceive(),
            'serve' => $this->getServe(),
            'store' => $this->getStore(),
            'storeName' => $this->getStoreName()
        ];
    }

    public function getArticleId(): string
    {
        return $this->articleId;
    }
    public function getNameArticle(): string
    {
        return $this->nameArticle;
    }
    public function getStock(): int
    {
        return $this->stock;
    }
    public function getReceive(): int
    {
        return $this->receive;
    }
    public function getServe(): int
    {
        return $this->serve;
    }
    public function getStore(): string
    {
        return $this->store;
    }
    public function getStoreName(): string
    {
        return $this->storeName;
    }
}
