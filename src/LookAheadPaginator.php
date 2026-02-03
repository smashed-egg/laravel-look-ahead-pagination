<?php

namespace SmashedEgg\LaravelLookAheadPagination;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 *
 * @extends Paginator<TKey, TValue>
 */
class LookAheadPaginator extends Paginator
{
    protected bool $nextPageExists;

    /**
     * @param Collection<TKey,TValue>|Arrayable<TKey,TValue>|iterable<TKey,TValue>|null $items
     * @param $perPage
     * @param $currentPage
     * @param bool $nextPageExists
     * @param array $options
     */
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