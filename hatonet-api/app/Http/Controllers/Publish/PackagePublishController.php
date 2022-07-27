<?php

namespace App\Http\Controllers\Publish;

use App\Http\Controllers\ApiController;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Private\PackageResource;
use App\Models\Package;
use stdClass;

class PackagePublishController extends ApiController
{
    public function __construct(Package $package, User $user)
    {
        $this->package = $package;
        $this->user = $user;
    }

    public function index(Request $request)
    {
        try {
            $status = $request->status;
            $userId = $request->userId;
            if (!empty($userId)) {
                if(!empty($status)){
                    $packages = $this->package->where('user_id', $userId)
                        ->where(function($query) use($status){
                            $query->where('status', $status);
                        })
                        ->with('user')
                        ->paginate(10);
                    return new PackageResource($packages);
                }
                $packages = $this->package->where('user_id', $userId)
                    ->with('user')
                    ->paginate(10);
                return new PackageResource($packages);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    public function store(Request $request)
    {
        try {
            $orderUsing = $request->input('orderUsing');
            $service = Service::find($orderUsing['service_id']);
            $serviceStart = $orderUsing['start_day'];
            $usageTime = $service->use_time * 30;
            $date1 = new DateTime($serviceStart);
            $date2 = new DateTime();
            $interval = $date1->diff($date2);
            $remainingUsageTime = $usageTime - $interval->days;
            return response()->json($remainingUsageTime);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    public function update(Request $request, $id)
    {
        //try {
            $service_id = $request->input("service_id");
            $status = $request->input("status");
            $service = Service::find($service_id);
            $result = $this->package->findOrFail($id);
            if ($status) {
                $result->update([
                    'stop_day' => Carbon::now(),
                    'status' => $status,
                ]);
            }
            return response()->json($result, 200);
        // } catch (\Throwable $th) {
        //     return response()->json(['message' => __("messages.not_content")], 403);
        // }
    }
}
