<?php

namespace App\Http\Controllers;

use App\Jobs\StoreDataUpdates;
use App\Models\DataUpload;
use Exception;
use Illuminate\Http\Request;
use App\Http\Resources\RemoteDataResourceCollection;

class DataUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
          $data =  DataUpload::whereNot('device_id', $request->deviceId)->get();
          return $this->sendResponse(data: new RemoteDataResourceCollection($data));
        }catch(\Throwable $th){
          return $this->sendError($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            \Log::info('Uploading', [
                'user_id'=> $request->get('user_id'),
                'account_id'=> $request->get('account_id'),
                'device_id'=> $request->get('deviceId'),
                'data'=> $request->get('data'),
        ]);

            $data = new DataUpload;

            $data->user_id = $request->get('user_id');
            $data->data = $request->get('data');
            $data->account_id = $request->get('account_id');
            $data->device_id = $request->get('deviceId');
            $data->sync_devices = [$request->get('deviceId')];

            $data->save();

            // StoreDataUpdates::dispatch($update);

            return $this->sendResponse(message: 'Data uploaded and job dispatched');
        } catch (Exception $ex) {
            return $this->sendError($ex);
        }
    }
    public function testMessage(Request $request)
    {
        try {
            $update = DataUpload::create([
                'user_id' => 1,
                'data' => [],
                'account_id' => 2,
                'creator_id' => 2,
            ]);

            StoreDataUpdates::dispatch($update);

            return $this->sendResponse(message: 'Data uploaded and job dispatched');
        } catch (Exception $ex) {
            return $this->sendError($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DataUpload::where('id', $id)->delete();
        return $this->sendResponse(message: 'Successfully deleted data');
    }
}
