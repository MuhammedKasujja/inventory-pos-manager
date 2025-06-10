<?php

namespace App\Http\Services;

use App\Models\DataUpload;
use App\Models\SyncDevice;
use Exception;

final class DataService
{

    public function fetchDataUpdates(string $deviceId)  {
        return DataUpload::whereNot('device_id', $deviceId)->get();
    }

    public function saveDataUpdates(string $userId,string $accountKey,string $deviceId,$data) {

        $device = SyncDevice::where('user_id', $userId)
            ->where('account_key', $accountKey)
            ->where('deviceId', $deviceId)
            ->first();
        
        if($device === null){
            throw new Exception('Device not recognized, registered to make data updates', 404);
        }

        $uploads = new DataUpload;

            $uploads->user_id = $userId;
            $uploads->data = $data;
            $uploads->account_id = $accountId;
            $uploads->device_id = $deviceId;
            $uploads->sync_devices = [$deviceId];

            $uploads->save();

       return $uploads;
    }
    
}

