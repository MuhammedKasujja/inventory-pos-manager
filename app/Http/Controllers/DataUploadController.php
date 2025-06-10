<?php

namespace App\Http\Controllers;

use App\Jobs\StoreDataUpdates;
use App\Models\DataUpload;
use Exception;
use Illuminate\Http\Request;
use App\Http\Resources\RemoteDataResourceCollection;
use App\Http\Services\DataService;

class DataUploadController extends Controller
{

    public function __construct(private DataService $dataService) {
    }
   
    public function index(Request $request)
    {
        try{
          $data =  $this->dataService->fetchDataUpdates(
                       deviceId: $request->deviceId, 
                       accountKey: $request->accountKey,
                    );

          return $this->sendResponse(data: new RemoteDataResourceCollection($data));
        }catch(\Throwable $th){
          return $this->sendError($th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            \Log::info('Uploading', [
                'user_id'=> $request->get('user_id'),
                'account_id'=> $request->get('account_key'),
                'device_id'=> $request->get('deviceId'),
                'data'=> $request->get('data'),
        ]);

            $this->dataService->saveDataUpdates(
                userId: $request->get('user_id'), 
                accountKey: $request->get('account_key'),
                deviceId: $request->get('deviceId'), 
                data: $request->get('data'),
            );

            // StoreDataUpdates::dispatch($update);

            return $this->sendResponse(message: 'Data uploaded and job dispatched');
        } catch (Exception $ex) {
            return $this->sendError($ex->getMessage());
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
