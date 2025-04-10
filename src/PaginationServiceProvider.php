<?php

namespace SmashedEgg\LaravelLookAheadPagination;

use App\Paginator\LookAheadPaginator;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class PaginationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $lookAheadPaginateFunction = function($perPage = null, $columns = ['*'], $pageName = 'page', $page = null) {
            /** @var $this Builder|EloquentBuilder */

            $page = $page ?: Paginator::resolveCurrentPage($pageName);
            $limit = 50;
            $offset = ($page * $limit) - $limit;

            $nextPage = $page + 1;
            $nextOffset = ($nextPage * $limit) - $limit;

            $reports = $this
                ->limit($limit)
                ->offset($offset)
                ->get()
            ;

            $nextPageExists = Report::query()
                ->limit($limit)
                ->offset($nextOffset)
                ->exists()
            ;

            return new LookAheadPaginator(
                $reports,
                50,
                $page,
                $nextPageExists,
                [
                    'path' => Paginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        };

        EloquentBuilder::macro('lookAheadPaginate', $lookAheadPaginateFunction);
        Builder::macro('lookAheadPaginate', $lookAheadPaginateFunction);
    }
}