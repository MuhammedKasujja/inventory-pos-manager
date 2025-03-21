<?php

namespace App\Http\Controllers;

use App\Jobs\StoreDataUpdates;
use App\Models\DataUpload;
use Exception;
use Illuminate\Http\Request;

class DataUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(data: DataUpload::get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $update = DataUpload::create([
                'user_id' => $request->get('user_id'),
                'data' => $request->get('data'),
                'account_id' => $request->get('account_id'),
                'creator_id' => $request->get('creator_id'),
            ]);

            StoreDataUpdates::dispatch($update);

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
