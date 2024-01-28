<?php

namespace app\core;

class Pagination
{
    private readonly string $order;
    private readonly string $offset;


    public function __construct(
        private readonly int $totalItems,
        private readonly int $itemsPerPage,
        private readonly int $currentPage,
    ) {
        $this->offset = ($currentPage - 1) * $itemsPerPage;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getOrder(): string
    {
        return $this->order;
    }

    public function setOrder(string $value): void
    {
        $this->order = $value;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function calculateTotalPages(): int
    {
        return \ceil($this->totalItems / $this->itemsPerPage);
    }

    public function moveLeft(): string
    {
        $currentPage = $this->currentPage - 1;

        return "?page={$currentPage}";
    }

    public function moveRight(): string
    {
        $currentPage = $this->currentPage + 1;

        return "?page={$currentPage}";
    }

    public function generatePaginationLinks(): string
    {
        $totalPages = $this->calculateTotalPages();

        $links = '';

        for ($i = 1; $i <= $totalPages; $i++) {
            $links .= "<li class='page-item'><a class='page-link' href='?page={$i}&mode={$this->getOrder()}'>{$i}</a></li>";
        }

        return $links;
    }

}
