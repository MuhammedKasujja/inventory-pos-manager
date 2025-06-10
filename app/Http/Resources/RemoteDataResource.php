<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RemoteDataResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return ['data'=>collect($this->data)->map(function ($item) {
                return [
                    'tableName' => $item['tableName'] ?? null,
                    'entityId' => $item['entityId'] ?? null,
                    'entity' => $item['entity'] ?? null,
                    'data' => $item['data'] ?? [],
                    'operation' => $item['operation'] ?? null,
                ];
            })
        ];
    }
}
