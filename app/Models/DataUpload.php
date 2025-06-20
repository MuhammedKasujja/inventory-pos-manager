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
 * @property int | string $device_id
 * */
class DataUpload extends Model
{
    protected $fillable = ['user_id', 'account_id', 'device_id', 'data'];

    protected $casts = [
        'data' => 'array',
        'sync_devices' => 'array',
    ];
}
