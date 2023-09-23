<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Store;
use App\Models\IPLog;

class StoreController extends Controller
{
    public function setGuestActive(Request $request) {
        $guest = IPLog::where('ip_address', $request->ip())->first();

        if(!$guest) {
            abort(400);
        }

        $guest->active = 1;
        $guest->save();
    }

    public function setGuestInactive(Request $request) {
        $guest = IPLog::where('ip_address', $request->ip())->first();
        if(!$guest) {
            abort(400);
        }
        $guest->active = 0;
        $guest->save();
    }
    public function setActive(Request $request, $id) {
        $store = Store::find($id);
        if(!$store) {
            $this->setGuestActive($request);
            abort(400);
        }

        $store->active = 1;
        $store->save();
        return response()->json(['message'=> 'success']);
    }
    public function setInactive(Request $request,$id) {
        $store = Store::find($id);
        if(!$store) {
            $this->setGuestInactive($request);
            abort(400);
        }
        $store->active = 0;
        $store->save();
        return response()->json(['message'=> 'success']);
    }

    public function setAddress(Request $request)
    {
        // Find the IPLog record with the specified IP address
        $ipLog = IPLog::where('ip_address', $request->ip())->first();

        if ($ipLog) {
            // Update the 'address' field
            $ipLog->address = $request->input('address');
            $ipLog->save();

            return response()->json(['message' => 'Address set successfully']);
        }

        return response()->json(['message' => 'IP address not found'], 404);
    }

}
