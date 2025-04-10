<?php

namespace SmashedEgg\LaravelLookAheadPagination;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class LookAheadPaginator extends Paginator
{
    protected bool $nextPageExists;

    public function __construct(
        $items,
        $perPage,
        $currentPage = null,
        bool $nextPageExists = false,
        array $options = []
    ) {
        $this->nextPageExists = $nextPageExists;

        parent::__construct($items, $perPage, $currentPage, $options);
    }

    /**
     * Set the items for the paginator.
     *
     * @param mixed $items
     */
    protected function setItems($items): void
    {
        $this->items = $items instanceof Collection ? $items : Collection::make($items);

        $this->hasMore = $this->nextPageExists === true;
    }
}