<?php

namespace app\core;

class Pagination
{
    private readonly string $order;
    private readonly string $offset;
    private string $queryString;

    public function __construct(
        private readonly int $totalItems,
        private readonly int $itemsPerPage,
        private readonly int $currentPage,
        array $request,
    ) {
        $this->offset = ($currentPage - 1) * $itemsPerPage;

        if (!empty($request)) {
            $key = \array_keys($request)[0];
        }

        if (!empty($request) && ($key !== 'page')) {
            $currentUri = \strstr($_SERVER['REQUEST_URI'], '?', true);
            $request = \array_values($request);

            $this->queryString = "{$currentUri}?{$key}={$request[0]}&";
        } else {
            $this->queryString = '?';
        }
    }

    public function getQueryString(): string
    {
        return $this->queryString;
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

    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    public function getPerPage(): int
    {
        return $this->itemsPerPage;
    }

    public function calculateTotalPages(): int
    {
        return \ceil($this->totalItems / $this->itemsPerPage);
    }

    public function moveLeft(): string
    {
        $prevPage = $this->currentPage - 1;

        return "page={$prevPage}";
    }

    public function moveRight(): string
    {
        $nextPage = $this->currentPage + 1;

        return "page={$nextPage}";
    }

    public function generatePaginationLinks(): string
    {
        $totalPages = $this->calculateTotalPages();
        $links = '';

        for ($i = 1; $i <= $totalPages; $i++) {
            $links .= "<li class='page-item'><a class='page-link' href={$this->queryString}page={$i}&mode={$this->getOrder()}>{$i}</a></li>";
        }

        return $links;
    }

}
