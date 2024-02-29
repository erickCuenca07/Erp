<?php
namespace Products\ListProducts\Domain\Model;
class ListProductsModel
{
    public function __construct(
        private readonly string $documentId,
        private readonly string $productId,
        private readonly string $nameProduct,
        private readonly string $dateProductUp,
        private readonly string $orderDate,
        private readonly string $deliveryDate,
        private readonly int $quantity
    ){}
    public function toArray(): array
    {
        return [
            'documentId' => $this->getDocumentId(),
            'productId' => $this->getProductId(),
            'nameProduct' => $this->getNameProduct(),
            'dateProductUp' => $this->getDateProductUp(),
            'orderDate' => $this->getOrderDate(),
            'deliveryDate' => $this->getDeliveryDate(),
            'quantity' => $this->getQuantity(),
        ];
    }
    public function getDocumentId(): string
    {
        return $this->documentId;
    }
    public function getProductId(): string
    {
        return $this->productId;
    }
    public function getNameProduct(): string
    {
        return $this->nameProduct;
    }
    public function getDateProductUp(): string
    {
        return $this->dateProductUp;
    }
    public function getOrderDate(): string
    {
        return $this->orderDate;
    }
    public function getDeliveryDate(): string
    {
        return $this->deliveryDate;
    }
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
