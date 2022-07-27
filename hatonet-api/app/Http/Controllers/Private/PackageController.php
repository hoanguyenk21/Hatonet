<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Private\PackageResource;
use App\Models\Order;
use App\Models\Package;
use App\Models\PackageMeta;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PackageController extends ApiController
{
    /**
     * Construct
     */
    public function __construct(Package $package, PackageMeta $packageMeta, Service $service)
    {
        $this->package = $package;
        $this->package_meta = $packageMeta;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;
        $records = $request->records;
        if(!empty($records)){
            $packages = $this->package->with('user')->paginate($records);
            return new PackageResource($packages);
        }
        if (!empty($status) || !empty($search)) {
            if (!empty($search) && empty($status)) {
                $packages = $this->package->where('user_name', 'LIKE', '%' . $search . '%')
                    ->with('user')
                    ->paginate(10);
                return new PackageResource($packages);

            }
            if (!empty($status) && !empty($search)) {
                $packages = $this->package->where('status', $status)
                    ->where('user_name', 'LIKE', '%' . $search . '%')
                    ->with('user')
                    ->paginate(10);
                return new PackageResource($packages);
            }
            $packages = $this->package->where('status', $status)
                ->with('user')
                ->paginate(10);
            return new PackageResource($packages);
        } else {
            $packages = $this->package->with('user')->paginate(10);
            return new PackageResource($packages);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $service_id = $request->input('service_id');
            $orderUsing = $request->input('orderUsing');
            $service = Service::find($service_id);
            if ($orderUsing && floatval($orderUsing['price_base']) < floatval($service['price_base'])) {

                $price_sale = floatval($service['price_sale']) - floatval($orderUsing['price_sale']);
                $result = $this->package->create([
                    'title' => $service->title,
                    'description' => $service->description,
                    'price_base' => $service->price_base,
                    'price_sale' => $price_sale,
                    'user_id' => auth()->user()->id,
                    'user_name' => Auth::user()->name,
                    'service_id' => $service_id,
                ]);
                foreach ($request->meta as $key => $val) {
                    $this->package_meta->create([
                        'meta_key' => ($key),
                        'meta_value' => ($val),
                        'package_id' => $result->id
                    ]);
                }
            } else if (!$orderUsing) {
                $result = $this->package->create([
                    'title' => $service->title,
                    'description' => $service->description,
                    'price_base' => $service->price_base,
                    'price_sale' => $service->price_sale,
                    'user_id' => auth()->user()->id,
                    'user_name' => auth()->user()->name,
                    'service_id' => $service_id,
                ]);
                foreach ($request->meta as $key => $val) {
                    $this->package_meta->create([
                        'meta_key' => ($key),
                        'meta_value' => ($val),
                        'package_id' => $result->id
                    ]);
                }
            } else {
                $result = $this->package->create([
                    'title' => $service->title,
                    'description' => $service->description,
                    'price_base' => $service->price_base,
                    'price_sale' => $service->price_sale,
                    'user_id' => Auth::user()->id,
                    'user_name' => Auth::user()->name,
                    'service_id' => $service_id,
                ]);
                foreach ($request->meta as $key => $val) {
                    $this->package_meta->create([
                        'meta_key' => ($key),
                        'meta_value' => ($val),
                        'package_id' => $result->id
                    ]);
                }
            }
            return response()->json($result, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $result = $this->package->where('id', $id)->with('meta')->first();
            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            $order = $request->input('order');
            $idOfActive = $request->input('idOfActive');
            $remainingUsageTime = $request->input('remainingUsageTime');
            $orderActive = Package::find($idOfActive);
            $orderPending = $this->package->findOrFail($id);
            $dataMeta = $orderPending->meta;

            if ($idOfActive && $order['status'] == 'active') {
                //echo 1;
                $orderActive->update([
                    'status' => 'unactive',
                ]);
                foreach ($request->meta as $key => $val) {
                    $metaByKey = $dataMeta->where('meta_key', $key)->first();
                    $metaByKey->meta_value = $val;
                    $metaByKey->save();
                }
                return response()->json(1, 200);
            }

            if ($order['status'] == 'active' && $remainingUsageTime <= 0) {
                //echo 2;
                $orderPending->update(['status' => 'active', 'start_day' => Carbon::now()]);
                foreach ($request->meta as $key => $val) {
                    $metaByKey = $dataMeta->where('meta_key', $key)->first();
                    $metaByKey->meta_value = $val;
                    $metaByKey->save();
                }
                return response()->json(2, 200);

            } elseif ($remainingUsageTime > 0 && $order['status'] == 'active') {
                //echo 3;
                $orderPending->update([
                    'start_day' => $orderActive['start_day'],
                    'status' => 'active'
                ]);
                foreach ($request->meta as $key => $val) {
                    $metaByKey = $dataMeta->where('meta_key', $key)->first();
                    $metaByKey->meta_value = $val;
                    $metaByKey->save();
                }
                return response()->json(3, 200);
                
            } else {
                //echo 4;
                $orderPending->update($order);
                foreach ($request->meta as $key => $val) {
                    $metaByKey = $this->order_meta->where('meta_key', $key)->first();
                    $metaByKey->meta_value = $val;
                    $metaByKey->save();
                }
                return response()->json(4, 200);
            }

            //return response()->json($orderPending, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = $this->package->findOrFail($id)->destroy($id);
            return response()->json($result, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => __("messages.not_content")], 403);
        }
    }
    public function vnpayPayment(Request $request){
        $service_id = $request->input('service_id');
        $orderUsing = $request->input('orderUsing');
        $id_packages = $request->input('id_packages');
        $service = Service::find($service_id);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:3000/order/billing";
        $vnp_TmnCode = "AY0BZPEY";//Mã website tại VNPAY 
        $vnp_HashSecret = "BWMPDHIBLDVYTEXWPAJJXWYPVRKEPREB"; //Chuỗi bí mật
        
        $vnp_TxnRef =  $id_packages ; //$_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn hàng'; //$_POST['order_desc'];
        $vnp_OrderType = 'billpayment'; //$_POST['order_type'];
        $vnp_Amount = $service->price_sale * 100; //$_POST['amount'] * 100;
        $vnp_Locale = 'vn'; //$_POST['language'];
        $vnp_BankCode = 'NCB'; //$_POST['bank_code'];
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate"=> $vnp_ExpireDate
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            header('Location: ' . $vnp_Url);
            die();
            // if (isset($_POST['redirect'])) {
            //     header('Location: ' . $vnp_Url);
            //     die();
            // } else {
            //     echo json_encode($returnData);
            // }
            // vui lòng tham khảo thêm tại code demo
    }
}