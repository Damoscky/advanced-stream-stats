<?php

namespace App\Http\Responser;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use JsonSerializable;

class JsonResponser
{

    /**
     * Return a new JSON response with paginated data
     * 
     * @param int $status
     * @param StaffStrength\ApiMgt\Http\Collections\ApiPaginatedCollection $data
     * @param string|null $message
     * @return Illuminate\Http\JsonResponse
     */
    public static function send(
        bool $error = true,
        string $message = null,
        $data = []
    ): JsonResponse
    {
        
        return response()->json(["error" => $error, "message" => $message, "data" => $data]);
    }

}
