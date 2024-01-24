<?php

namespace app\core;

class Paginator
{
    public function __construct(
        private readonly int $totalItems,
        private readonly int $itemsPerPage,
        private readonly int $currentPage,
    ) {}

    public function calculateTotalPages(): int
    {
        return \ceil($this->totalItems / $this->itemsPerPage);
    }

    public function moveLeft(): string
    {
        $currentPage = (int)$this->currentPage - 1;

        return "?page={$currentPage}";
    }

    public function moveRight(): string
    {
        $currentPage = (int)$this->currentPage + 1;

        return "?page={$currentPage}";
    }

    public function generatePaginationLinks(): string
    {
        $totalPages = $this->calculateTotalPages();

        $links = '';

        for ($i = 1; $i <= $totalPages; $i++) {
            $links .= "<li class='page-item'><a class='page-link' href='?page={$i}'>{$i}</a></li>";
        }

        return $links;
    }

}
