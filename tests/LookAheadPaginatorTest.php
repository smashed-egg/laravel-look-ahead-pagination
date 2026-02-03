<?php

namespace SmashedEgg\LaravelLookAheadPagination\Tests;

use SmashedEgg\LaravelLookAheadPagination\LookAheadPaginator;

class LookAheadPaginatorTest extends TestCase
{
    private LookAheadPaginator $paginator;

    private array $options = ['onEachSide' => 5];

    protected function setUp(): void
    {
        $this->paginator = new LookAheadPaginator(['item1', 'item2', 'item3', 'item4'], 4, 1, true, $this->options);
    }

    protected function tearDown(): void
    {
        unset($this->paginator);
    }

    public function testPagination()
    {
        
    }
}