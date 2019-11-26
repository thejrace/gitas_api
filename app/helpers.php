<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

if (!function_exists('paginateCollection')) {
    /**
     * Gera a paginação dos itens de um array ou collection.
     *
     * @param array|Collection $items
     * @param int              $perPage
     * @param int              $page
     * @param array            $options
     *
     * @return LengthAwarePaginator
     */
    function paginateCollection($items, $perPage = 15, $page = null, $options = [])
    {
        $page  = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
