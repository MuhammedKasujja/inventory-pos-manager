<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\DataUpload
 * 
 * @property int $id
 * @property string $user_id
 * @property int | string $data
 * @property int | string $account_id
 * @property int | string $creator_id
 * */
class DataUpload extends Model
{
    protected $fillable = ['user_id', 'account_id', 'creator_id', 'data'];

    protected $casts = [
        'data' => 'array',
    ];
}
