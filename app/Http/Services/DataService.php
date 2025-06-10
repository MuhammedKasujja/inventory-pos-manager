<?php

namespace App\Http\Services;

use App\Models\DataUpload;
use App\Models\SyncDevice;
use Exception;

final class DataService
{

    public function fetchDataUpdates(string $deviceId, string $accountKey)  {
        $device  = $this->getSyncDeviceByDeviceId($deviceId, $accountKey);

        return DataUpload::where('account_id', $device->account_id)
                      ->whereNot('device_id', $deviceId)
                      ->get();
    }

    public function saveDataUpdates(string $userId, string $accountKey, string $deviceId, $data) {

        $device = SyncDevice::where('user_id', $userId)
            ->where('account_key', $accountKey)
            ->where('device_id', $deviceId)
            ->first();
        
        if($device === null){
            throw new Exception('Device not recognized, registered to make data updates', 404);
        }

        $uploads = new DataUpload;

            $uploads->user_id = $userId;
            $uploads->data = $data;
            $uploads->account_id = $device->account_id;
            $uploads->device_id = $deviceId;
            $uploads->sync_devices = [$deviceId];

            $uploads->save();

       return $uploads;
    }

    public function getSyncDeviceByDeviceId(string $deviceId, string $accountKey): SyncDevice {
        $device = SyncDevice::where('device_id', $deviceId)
            ->where('account_key', $accountKey)
            ->first();
        
        if($device === null){
            throw new Exception('Device not recognized, registered to make data updates '.$deviceId, 404);
        }

        return $device;
    }
    
}

