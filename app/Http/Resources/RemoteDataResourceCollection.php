<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RemoteDataResourceCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->flatMap(function ($update) {
            return collect($update->data)->map(function ($item) use ($update) {
                return [
                    'update_id' => $update->id,
                    'user_id' => $update->user_id,
                    'account_id' => $update->account_id,
                    'creator_id' => $update->creator_id,
                    'created_at' => $update->created_at,
                    'updated_at' => $update->updated_at,
                    'tableName' => $item['tableName'] ?? null,
                    'entityId' => $item['entityId'] ?? null,
                    'entity' => $item['entity'] ?? null,
                    'data' => $item['data'] ?? [],
                    'operation' => $item['operation'] ?? null,
                ];
            });
        })->values()->all();
    }
}
