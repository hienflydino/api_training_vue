<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param query $query Query of the request.
     *
     * @param Illuminate\Http\Request $request Request.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static function apiPaginate($query, $request)
    {
        $pageSize = config('common.paginate.per_page');
        $maxPageSize = config('common.paginate.max_per_page');

        if (isset($request->page_size) && (int) $request->page_size > 0) {
            $pageSize = min($request->page_size, $maxPageSize);
        }

        return static::collection($query->paginate($pageSize)->appends($request->query()))
            ->response()
            ->getData();
    }

    /**
     * Transform the resource into an array using simple paginate.
     *
     * @param query $query Query of the request.
     *
     * @param Illuminate\Http\Request $request Request.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static function apiSimplePaginate($query, $request)
    {
        $pageSize = config('common.paginate.member');
        $maxPageSize = config('common.paginate.max_per_page');

        if (isset($request->page_size) && (int) $request->page_size > 0) {
            $pageSize = min($request->page_size, $maxPageSize);
        }

        return static::collection($query->simplePaginate($pageSize)->appends($request->query()))
            ->response()
            ->getData();
    }

}
