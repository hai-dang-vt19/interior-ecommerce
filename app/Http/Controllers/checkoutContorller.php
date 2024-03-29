<?php

namespace App\Http\Controllers;

use App\Models\bill;
use App\Models\cart;
use App\Models\city;
use App\Models\discount;
use App\Models\expense;
use App\Models\history;
use App\Models\Hosts;
use App\Models\product;
use App\Models\product_famous;
use App\Models\User;
use App\Models\user_famous;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkoutContorller extends Controller
{
    public function _hosts(){
        $hosts = Hosts::where('active','y')->get();
        foreach($hosts as $hst){
            $host = $hst->host;
            return $host;
        }
    }
    public function return_vnpay(Request $request)
    {
        $vnp_TxnRef = $request->vnp_TxnRef;
        $vnp_BankCode = $request->vnp_BankCode;
        $vnp_BankTranNo = $request->vnp_BankTranNo;
        $vnp_TransactionNo = $request->vnp_TransactionNo;
        $vnp_CardType = $request->vnp_CardType;
        $vnp_Amount = $request->vnp_Amount/100;
        $vnp_ResponseCode = $request->vnp_ResponseCode;

        // $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $vnp_HashSecret = "XJZONSMCWFAWVKHFSCLGCCIUIPLNCUPN";
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($vnp_ResponseCode == '00') {
                $done = "GD thành công";
                $cart = cart::all()->where('id_cart_user','CART_CS'.Auth::user()->user_id);
                foreach($cart as $crt){
                    $pr_service = city::where('name_city',Auth::user()->city)->get();
                    foreach($pr_service as $price_service){
                        bill::create([
                            'id_bill'=>$vnp_TxnRef,
                            'id_product'=>$crt->id_product,
                            'name_product'=>$crt->name_product,
                            'type_product'=>$crt->type_product,
                            'image_product'=>$crt->image_product,
                            'amount'=>$crt->amount_product,
                            // 'price'=>$price_all,
                            'price'=>$crt->price_product,
                            'username'=>Auth::user()->name,
                            'email'=>Auth::user()->email,
                            'phone'=>Auth::user()->phone,
                            'date_create'=>Carbon::now('Asia/Ho_Chi_Minh')->toDateString(),
                            'year_create'=>Carbon::now('Asia/Ho_Chi_Minh')->year,
                            'method'=>$vnp_CardType,
                            'price_service'=>$price_service->price,
                            'bank'=>$vnp_BankCode,
                            'code_bank'=>$vnp_BankTranNo,
                            'code_vnpay'=>$vnp_TransactionNo,
                            'address'=>Auth::user()->district.', '.Auth::user()->city.', '.Auth::user()->province,
                            'total'=>$vnp_Amount,
                            'status_product_bill'=>'1'
                        ]);
                    }
                    //**** 1 thêm vào data sản phẩm nổi bật */
                        $today = Carbon::now('Asia/Ho_Chi_Minh');
                        $product_famous = product_famous::all()->where('id_product',$crt->id_product)
                                                            ->where('day_c',$today->day)
                                                            ->where('month_c',$today->month)
                                                            ->where('year_c',$today->year);
                        $sum_amount = $product_famous->sum('amount_bill');
                        $samt = $sum_amount+1;
                        product_famous::updateOrCreate([
                            'id_product'=>$crt->id_product
                        ],[
                            'amount_bill'=>$samt,
                            'day_c'=>$today->day,
                            'month_c'=>$today->month,
                            'year_c'=>$today->year
                        ]);
                    //*** Xuwr lys theem data khasch hangf nooir abat */
                        $user_famous = user_famous::all()->where('user_id',Auth::user()->user_id)
                                                        ->where('day_c',$today->day)
                                                        ->where('month_c',$today->month)
                                                        ->where('year_c',$today->year);
                        $sum_amount_us = $user_famous->sum('amount_user');
                        $samtus = $sum_amount_us+1;
                        $sum_total_u = $user_famous->sum('total');
                        $total_u_f = $sum_total_u + $vnp_Amount;
                        user_famous::updateOrCreate([
                            'user_id'=>Auth::user()->user_id
                        ],[
                            'username'=>Auth::user()->name,
                            'amount_user'=>$samtus,
                            'day_c'=>$today->day,
                            'month_c'=>$today->month,
                            'year_c'=>$today->year,
                            'total'=>$total_u_f
                        ]);
                                                        
                    cart::where('id_cart_user','CART_CS'.Auth::user()->user_id)->delete();
                }
                session()->flash('success', $done);
                return back();
            } 
            else {
                $done = "GD Không thành công";
                session()->flash('error', $done);
                return redirect()->route('cart');
                }
        } else {
            $done = "Chữ ký không hợp lệ";
            session()->flash('error', $done);
            return redirect()->route('cart');
        }
    }
    public function return_vnpay_don(Request $request)
    {
        $vnp_TxnRef = $request->vnp_TxnRef;
        $vnp_BankCode = $request->vnp_BankCode;
        $vnp_BankTranNo = $request->vnp_BankTranNo;
        $vnp_TransactionNo = $request->vnp_TransactionNo;
        $vnp_CardType = $request->vnp_CardType;
        $vnp_Amount = $request->vnp_Amount/100;
        $vnp_ResponseCode = $request->vnp_ResponseCode;

        // $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $vnp_HashSecret = "XJZONSMCWFAWVKHFSCLGCCIUIPLNCUPN";
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($vnp_ResponseCode == '00') {
                $done = "GD thành công";
                $cart = cart::all()->where('id_cart_user','CART_CS'.Auth::user()->user_id)
                ->where('id_product',$request->vnp_OrderInfo); // sử dụng biến vnp_OrderInfo dể làm điểu kiện
                // dd($cart);return;
                foreach($cart as $crt){
                    $pr_service = city::where('name_city',Auth::user()->city)->get();
                    foreach($pr_service as $price_service){
                        bill::create([
                            'id_bill'=>$vnp_TxnRef,
                            'id_product'=>$crt->id_product,
                            'name_product'=>$crt->name_product,
                            'type_product'=>$crt->type_product,
                            'image_product'=>$crt->image_product,
                            'amount'=>$crt->amount_product,
                            // 'price'=>$price_all,
                            'price'=>$crt->price_product,
                            'username'=>Auth::user()->name,
                            'email'=>Auth::user()->email,
                            'phone'=>Auth::user()->phone,
                            'date_create'=>Carbon::now('Asia/Ho_Chi_Minh')->toDateString(),
                            'year_create'=>Carbon::now('Asia/Ho_Chi_Minh')->year,
                            'method'=>$vnp_CardType,
                            'price_service'=>$price_service->price,
                            'bank'=>$vnp_BankCode,
                            'code_bank'=>$vnp_BankTranNo,
                            'code_vnpay'=>$vnp_TransactionNo,
                            'address'=>Auth::user()->district.', '.Auth::user()->city.', '.Auth::user()->province,
                            'total'=>$vnp_Amount,
                            'status_product_bill'=>'1'
                        ]);
                    }
                    //**** 1 thêm vào data sản phẩm nổi bật */
                        $today = Carbon::now('Asia/Ho_Chi_Minh');
                        $product_famous = product_famous::all()->where('id_product',$crt->id_product)
                                                            ->where('day_c',$today->day)
                                                            ->where('month_c',$today->month)
                                                            ->where('year_c',$today->year);
                        $sum_amount = $product_famous->sum('amount_bill');
                        $samt = $sum_amount+1;
                        product_famous::updateOrCreate([
                            'id_product'=>$crt->id_product
                        ],[
                            'amount_bill'=>$samt,
                            'day_c'=>$today->day,
                            'month_c'=>$today->month,
                            'year_c'=>$today->year,
                        ]);
                    //*** Xuwr lys theem data khasch hangf nooir abat */
                        $user_famous = user_famous::all()->where('user_id',Auth::user()->user_id)
                                                        ->where('day_c',$today->day)
                                                        ->where('month_c',$today->month)
                                                        ->where('year_c',$today->year);
                        $sum_amount_us = $user_famous->sum('amount_user');
                        $samtus = $sum_amount_us+1;
                        $sum_total_u = $user_famous->sum('total');
                        $total_u_f = $sum_total_u + $vnp_Amount;
                        user_famous::updateOrCreate([
                            'user_id'=>Auth::user()->user_id
                        ],[
                            'username'=>Auth::user()->name,
                            'amount_user'=>$samtus,
                            'day_c'=>$today->day,
                            'month_c'=>$today->month,
                            'year_c'=>$today->year,
                            'total'=>$total_u_f
                        ]);
                    cart::where('id_cart_user','CART_CS'.Auth::user()->user_id)
                    ->where('id_product',$crt->id_product)
                    ->delete();
                }
                // $get_data_for_bill = bill::all()->where('id_bill',$vnp_TxnRef);
                session()->flash('success', $done);
                return back();
                // dd($get_data_for_bill);
            } 
            else {
                $done = "GD Không thành công";
                session()->flash('error', $done);
                return redirect()->route('cart');
                }
        } else {
            $done = "Chữ ký không hợp lệ";
            session()->flash('error', $done);
            return redirect()->route('cart');
        }
    }
    public function pay_all(Request $request) {
        $checkMethod = $request->checkMethodAll;
        if(empty($checkMethod)){
            session()->flash('error','Bạn chưa chọn phương thức thanh toán !');
            return back();
        }
        if(!empty($request->discountAll)){
            $dis = discount::where('name_discount',$request->discountAll)->where('status_discount','Phát hành')->sum('price');
            if($dis == 0){
                session()->flash('warning','Mã giảm giá không tồn tại');
                return back();
            }
            $new_total = $request->totalAll*((100-$dis)/100);
        }else{
            $new_total = $request->totalAll;
        }
        // dd($checkMethod);
        if ($checkMethod == 'ATM') {
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
            $vnp_Returnurl = $this->_hosts()."return-vnpay";
            $vnp_TmnCode = "HEYD7Y8N";//Mã website tại VNPAY 
            $vnp_HashSecret = "XJZONSMCWFAWVKHFSCLGCCIUIPLNCUPN"; //Chuỗi bí mật
            
            $vnp_TxnRef = 'ICS0'.time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán qua VNPAY';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $new_total * 100;
            $vnp_Locale = 'vn';
            // $vnp_BankCode = "NCB";
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
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
                "vnp_TxnRef" => $vnp_TxnRef
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
                if (isset($_POST['redirect'])) {// thêm name='redirect' vào nút thanh toán vnpay
                // if (isset($request->redirect)) {// thêm name='redirect' vào nút thanh toán vnpay
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
        }elseif($checkMethod == 'QR') {
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
            $vnp_Returnurl = $this->_hosts()."return-vnpay";
            $vnp_TmnCode = "HEYD7Y8N";//Mã website tại VNPAY 
            $vnp_HashSecret = "XJZONSMCWFAWVKHFSCLGCCIUIPLNCUPN"; //Chuỗi bí mật
            
            $vnp_TxnRef = 'ICS0'.time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán qua VNPAY';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $new_total * 100;
            $vnp_Locale = 'vn';
            // $vnp_BankCode = "NCB";
            $vnp_BankCode = 'VNPAYQR';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
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
                "vnp_TxnRef" => $vnp_TxnRef
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
                if (isset($_POST['redirect'])) {// thêm name='redirect' vào nút thanh toán vnpay
                // if (isset($request->redirect)) {// thêm name='redirect' vào nút thanh toán vnpay
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
        }elseif($checkMethod == 'COD'){

            $id_bill = $request->id_billAll;
            $username= $request->usernameAll;
            $email= $request->emailAll;
            $phone= $request->phoneAll;
            $date_create= $request->date_createAll;
            $method= $request->methodAll;
            $address= $request->addressAll;
            $status_product_bill = $request->status_product_billAll;

                $cartAll = cart::all()->where('id_cart_user','CART_CS'.Auth::user()->user_id);
                foreach($cartAll as $crt){
                    bill::create([
                        'id_bill'=>$id_bill,
                        'id_product'=>$crt->id_product,
                        'name_product'=>$crt->name_product,
                        'type_product'=>$crt->type_product,
                        'image_product'=>$crt->image_product,
                        'amount'=>$crt->amount_product,
                        'price'=>$crt->price_product,
                        'username'=>$username,
                        'email'=>$email,
                        'phone'=>$phone,
                        'date_create'=>$date_create,
                        'year_create'=>Carbon::now('Asia/Ho_Chi_Minh')->year,
                        'method'=>$method,
                        'price_service'=>$request->price_serviceAll,
                        'address'=>$address,
                        'total'=>$new_total,
                        'status_product_bill'=>$status_product_bill
                    ]);
                
                    //**** 1 thêm vào data sản phẩm nổi bật */
                        $today = Carbon::now('Asia/Ho_Chi_Minh');
                        $product_famous = product_famous::all()->where('id_product',$crt->id_product)
                                                            ->where('day_c',$today->day)
                                                            ->where('month_c',$today->month)
                                                            ->where('year_c',$today->year);
                        $sum_amount = $product_famous->sum('amount_bill');
                        $samt = $sum_amount+1;
                        product_famous::updateOrCreate([
                            'id_product'=>$crt->id_product
                        ],[
                            'amount_bill'=>$samt,
                            'day_c'=>$today->day,
                            'month_c'=>$today->month,
                            'year_c'=>$today->year
                        ]);
                    //*** Xuwr lys theem data khasch hangf nooir abat */
                            $get_tb = bill::where('id_bill',$request->id_bill)->distinct()->sum('total');
                            $user_famous = user_famous::all()->where('user_id',Auth::user()->user_id)
                                                            ->where('day_c',$today->day)
                                                            ->where('month_c',$today->month)
                                                            ->where('year_c',$today->year);
                            $sum_amount_us = $user_famous->sum('amount_user');
                            $samtus = $sum_amount_us+1;
                            $sum_total_u = $user_famous->sum('total');
                            $total_u_f = $sum_total_u + $get_tb;
                            user_famous::updateOrCreate([
                                'user_id'=>Auth::user()->user_id
                            ],[
                                'username'=>Auth::user()->name,
                                'amount_user'=>$samtus,
                                'day_c'=>$today->day,
                                'month_c'=>$today->month,
                                'year_c'=>$today->year,
                                'total'=>$total_u_f
                            ]);
                    cart::where('id_cart_user','CART_CS'.Auth::user()->user_id)->where('id_product',$crt->id_product)->delete();
                }
            session()->flash('success','Đặt hàng thành công');
            return back();
            // session()->flash('error','Chức năng COD chưa hoạt động');
            // return back();
        }else{
            session()->flash('error','Đặt hàng không thành công');
            return back();
        }
        session()->flash('warning','Lỗi hệ thống');
        return back();
    }

    public function pay_don(Request $request) {
        $checkMethod = $request->checkMethod;
        if(empty($checkMethod)){
            session()->flash('error','Bạn chưa chọn phương thức thanh toán !');
            return back();
        }
        if(!empty($request->discount)){
            $dis = discount::where('name_discount',$request->discount)->where('status_discount','Phát hành')->sum('price');
            if($dis == 0){
                session()->flash('warning','Mã giảm giá không tồn tại');
                return back();
            }
            $new_total = $request->total*((100-$dis)/100);
        }else{
            $new_total = $request->total;
        }
        // dd($checkMethod);

        if ($checkMethod == 'ATM') {
            // code atm
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
            $vnp_Returnurl = $this->_hosts()."return-vnpay-don";
            $vnp_TmnCode = "HEYD7Y8N";//Mã website tại VNPAY 
            $vnp_HashSecret = "XJZONSMCWFAWVKHFSCLGCCIUIPLNCUPN"; //Chuỗi bí mật
            
            $vnp_TxnRef = 'ICS0'.time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = $request->id_product;
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $new_total * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = "NCB";
            // $vnp_BankCode = 'VNPAYQR';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
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
                "vnp_TxnRef" => $vnp_TxnRef
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
                if (isset($_POST['redirect'])) {// thêm name='redirect' vào nút thanh toán vnpay
                // if (isset($request->redirect)) {// thêm name='redirect' vào nút thanh toán vnpay
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
        }elseif($checkMethod == 'QR') {
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
            $vnp_Returnurl = $this->_hosts()."return-vnpay-don";
            $vnp_TmnCode = "HEYD7Y8N";//Mã website tại VNPAY 
            $vnp_HashSecret = "XJZONSMCWFAWVKHFSCLGCCIUIPLNCUPN"; //Chuỗi bí mật
            
            $vnp_TxnRef = 'ICS0'.time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán qua VNPAY';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $new_total * 100;
            $vnp_Locale = 'vn';
            // $vnp_BankCode = "NCB";
            $vnp_BankCode = 'VNPAYQR';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
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
                "vnp_TxnRef" => $vnp_TxnRef
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
                if (isset($_POST['redirect'])) {// thêm name='redirect' vào nút thanh toán vnpay
                // if (isset($request->redirect)) {// thêm name='redirect' vào nút thanh toán vnpay
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
        }elseif($checkMethod == 'COD'){

            $id_bill = $request->id_bill;
            $id_product = $request->id_product;
            $name_product = $request->name_product;
            $amount_product = $request->amount_product;
            $price = $request->price;
            $username= $request->username;
            $email= $request->email;
            $phone= $request->phone;
            $date_create= $request->date_create;
            $method= $request->method;
            $address= $request->address;
            // $total = $request->total;
            $status_product_bill = $request->status_product_bill;
            $images = $request->images;
            $types = $request->types;

                bill::create([
                    'id_bill'=>$id_bill,
                    'id_product'=>$id_product,
                    'name_product'=>$name_product,
                    'type_product'=>$types,
                    'image_product'=>$images,
                    'amount'=>$amount_product,
                    'price'=>$price,
                    'username'=>$username,
                    'email'=>$email,
                    'phone'=>$phone,
                    'date_create'=>$date_create,
                    'year_create'=>Carbon::now('Asia/Ho_Chi_Minh')->year,
                    'method'=>$method,
                    'price_service'=>$request->price_service,
                    'address'=>$address,
                    'total'=>$new_total,
                    'status_product_bill'=>$status_product_bill
                ]);
                //**** 1 thêm vào data sản phẩm nổi bật */
                    $today = Carbon::now('Asia/Ho_Chi_Minh');
                    $product_famous = product_famous::all()->where('id_product',$id_product)
                                                        ->where('day_c',$today->day)
                                                        ->where('month_c',$today->month)
                                                        ->where('year_c',$today->year);
                    $sum_amount = $product_famous->sum('amount_bill');
                    $samt = $sum_amount+1;
                    product_famous::updateOrCreate([
                        'id_product'=>$id_product
                    ],[
                        'amount_bill'=>$samt,
                        'day_c'=>$today->day,
                        'month_c'=>$today->month,
                        'year_c'=>$today->year
                    ]);
                //*** Xuwr lys theem data khasch hangf nooir abat */
                        $get_tb = bill::where('id_bill',$request->id_bill)->distinct()->sum('total');
                        $user_famous = user_famous::all()->where('user_id',Auth::user()->user_id)
                                                        ->where('day_c',$today->day)
                                                        ->where('month_c',$today->month)
                                                        ->where('year_c',$today->year);
                        $sum_amount_us = $user_famous->sum('amount_user');
                        $samtus = $sum_amount_us+1;
                        $sum_total_u = $user_famous->sum('total');
                        $total_u_f = $sum_total_u + $get_tb;
                        user_famous::updateOrCreate([
                            'user_id'=>Auth::user()->user_id
                        ],[
                            'username'=>Auth::user()->name,
                            'amount_user'=>$samtus,
                            'day_c'=>$today->day,
                            'month_c'=>$today->month,
                            'year_c'=>$today->year,
                            'total'=>$total_u_f
                        ]);
                cart::where('id_cart_user','CART_CS'.Auth::user()->user_id)->where('id_product',$id_product)->delete();
            
            session()->flash('success','Đặt hàng thành công');
            return back();
            // session()->flash('error','Chức năng COD chưa hoạt động');
            // return back();
        }else{
            session()->flash('error','Đặt hàng không thành công');
            return back();
        }
        session()->flash('warning','Lỗi hệ thống');
        return back();
    }

    public function ship_done(Request $request)
    {
        // dd($request->all());
        bill::where('id_bill',$request->id_bill)->update([
            'status_product_bill'=>'4'
        ]);
        session()->flash('success', 'Cảm ơn bạn đã tin tưởng và sử dụng sản phẩm của chúng tôi.');
        return back();
    }
    public function destroy_bill(Request $request)
    {
        $year = Carbon::now('Asia/Ho_Chi_Minh')->year;
        // thêm giá vào expenses_incurred, update status_bil = 0
        bill::where('id_bill', $request->id)->update([
            'status_product_bill'=>'0'
        ]);

        $today = Carbon::now('Asia/Ho_Chi_Minh');
        $bill_amt = bill::all()->where('id_bill', $request->id);
        foreach($bill_amt as $bill_a){
            $id_product = $bill_a->id_product;
            $product_old = product::where('id_product',$id_product)->sum('amount');
            $amt = $product_old+$bill_a->amount;
            product::where('id_product',$id_product)->update(['amount'=>$amt]);

            //**** product famous */
                $product_famous = product_famous::all()->where('id_product',$bill_a->id_product)
                                                    ->where('day_c',$today->day)
                                                    ->where('month_c',$today->month)
                                                    ->where('year_c',$today->year);
                $sum_amount = $product_famous->sum('amount_bill');
                $samt = $sum_amount - $bill_a->amount;
                if($samt > 0){
                    product_famous::updateOrCreate([
                        'id_product'=>$bill_a->id_product
                    ],[
                        'amount_bill'=>$samt,
                        'day_c'=>$today->day,
                        'month_c'=>$today->month,
                        'year_c'=>$today->year,
                    ]);
                }else{
                    product_famous::updateOrCreate([
                        'id_product'=>$bill_a->id_product
                    ],[
                        'amount_bill'=>'0',
                        'day_c'=>$today->day,
                        'month_c'=>$today->month,
                        'year_c'=>$today->year,
                    ]);
                }
            //*** user famous */
                $us = User::all()->where('email',$bill_a->email);
                if($us != "[]"){
                    foreach($us as $users){
                        $user_famous = user_famous::all()->where('user_id',$users->user_id)
                                                        ->where('day_c',$today->day)
                                                        ->where('month_c',$today->month)
                                                        ->where('year_c',$today->year);
                        $sum_amount_us = $user_famous->sum('amount_user');
                        $samtus = $sum_amount_us - $bill_a->amount;
                        $sum_total_u = $user_famous->sum('total');
                        $total_u_f = $sum_total_u - $bill_a->total;
                        if($total_u_f > 0){
                            user_famous::updateOrCreate([
                                'user_id'=>$users->user_id
                            ],[
                                'username'=>$users->name,
                                'amount_user'=>$samtus,
                                'day_c'=>$today->day,
                                'month_c'=>$today->month,
                                'year_c'=>$today->year,
                                'total'=>$total_u_f
                            ]);
                        }else{
                            user_famous::updateOrCreate([
                                'user_id'=>$users->user_id
                            ],[
                                'username'=>$users->name,
                                'amount_user'=>'0',
                                'day_c'=>$today->day,
                                'month_c'=>$today->month,
                                'year_c'=>$today->year,
                                'total'=>'0'
                            ]);
                        }
                    }
                }
            
            $check_ex = expense::all()->where('years',$year);
            $bill_price_service = bill::where('id_bill', $request->id)->distinct()->sum('price_service');
            if($check_ex == '[]'){
                if($bill_a->status_product_bill == "1"){
                    expense::updateOrCreate(['years'=>$year,'expense_incurred'=>'0']);
                }else{
                    foreach($check_ex as $check_e){
                        $incurred_old = $check_e->expense_incurred;
                    }
                    $incurred = $incurred_old+$bill_price_service;
                    expense::updateOrCreate([
                        'years'=>$year
                    ],[
                        'expense_incurred'=>$incurred
                    ]);
                }
            }else{
                if($bill_a->status_product_bill == "1"){
                    foreach($check_ex as $check_e){
                        $incurred_old = $check_e->expense_incurred;;
                    }
                    expense::updateOrCreate([
                        'years'=>$year,
                        'expense_incurred'=>$incurred_old
                    ]);
                    // echo '1 - '.$incurred_old;return;
                }else{
                    foreach($check_ex as $check_e){
                        $incurred_old = $check_e->expense_incurred;
                    }
                    $incurred = $incurred_old+$bill_price_service;
                    expense::updateOrCreate([
                        'years'=>$year
                    ],[
                        'expense_incurred'=>$incurred
                    ]);
                    // echo '2 - '.$incurred;return;
                }
            }
        }
        session()->flash('success', 'Hủy đơn hàng thành công');
        return back();
    }

// -------------------------------------- dashboard
    public function checkout_cod(Request $request)
    {
        $cart = cart::all()->where('id_cart_user','CART_CS'.Auth::user()->user_id);
        $total = $request->tt_cod;
        $phuphi = city::all()->where('name_city', Auth::user()->city);
        foreach($phuphi as $phu){
            $phi = $phu->price;
            return view('interiors.blocks.checkout_cod', compact('cart','total','phi'));
        }
    }
    public function checkout_cod_post(Request $request) // Chưa 1 được hàng - khách nổi bật
    {
        $get_cart = cart::all()->where('id_cart_user','CART_CS'.Auth::user()->user_id)->count();
        // echo $get_cart.'<br>';

        $id_bill = array_slice($request->id_bill,0,$get_cart,true);
        $id_product = array_slice($request->id_product,0,$get_cart,true);
        $name_product = array_slice($request->name_product,0,$get_cart,true);
        $amount_product = array_slice($request->amount_product,0,$get_cart,true);
        $price = array_slice($request->price,0,$get_cart,true);
        $username= array_slice($request->username,0,$get_cart,true);
        $email= array_slice($request->email,0,$get_cart,true);
        $phone= array_slice($request->phone,0,$get_cart,true);
        $date_create= array_slice($request->date_create,0,$get_cart,true);
        $method= array_slice($request->method,0,$get_cart,true);
        $address= array_slice($request->address,0,$get_cart,true);
        $total = array_slice($request->total,0,$get_cart,true);
        $status_product_bill= array_slice($request->status_product_bill,0,$get_cart,true);

        $pr_service = city::where('name_city',Auth::user()->city)->get();
        foreach($pr_service as $price_service){
            for($i=0;$i<$get_cart;$i++){ // Thêm thành công
                bill::create([
                    'id_bill'=>$id_bill[$i],
                    'id_product'=>$id_product[$i],
                    'name_product'=>$name_product[$i],
                    'amount'=>$amount_product[$i],
                    'price'=>$price[$i],
                    'username'=>$username[$i],
                    'email'=>$email[$i],
                    'phone'=>$phone[$i],
                    'date_create'=>$date_create[$i],
                    'year_create'=>Carbon::now('Asia/Ho_Chi_Minh')->year,
                    'method'=>$method[$i],
                    'price_service'=>$price_service->price[$i],
                    'address'=>$address[$i],
                    'total'=>$total[$i],
                    'status_product_bill'=>$status_product_bill[$i]
                ]);
                //**** 1 thêm vào data sản phẩm nổi bật */
                    $today = Carbon::now('Asia/Ho_Chi_Minh');
                    $product_famous = product_famous::all()->where('id_product',$id_product[$i])
                                                        ->where('day_c',$today->day)
                                                        ->where('month_c',$today->month)
                                                        ->where('year_c',$today->year);
                    $sum_amount = $product_famous->sum('amount_bill');
                    $samt = $sum_amount+1;
                    product_famous::updateOrCreate([
                        'id_product'=>$id_product[$i]
                    ],[
                        'amount_bill'=>$samt[$i],
                        'day_c'=>$today->day[$i],
                        'month_c'=>$today->month[$i],
                        'year_c'=>$today->year[$i]
                    ]);
                //*** Xuwr lys theem data khasch hangf nooir abat */
                        $get_tb = bill::where('id_bill',$request->id_bill)->distinct()->sum('total');
                        $user_famous = user_famous::all()->where('user_id',Auth::user()->user_id)
                                                        ->where('day_c',$today->day)
                                                        ->where('month_c',$today->month)
                                                        ->where('year_c',$today->year);
                        $sum_amount_us = $user_famous->sum('amount_user');
                        $samtus = $sum_amount_us+1;
                        $sum_total_u = $user_famous->sum('total');
                        $total_u_f = $sum_total_u + $get_tb;
                        user_famous::updateOrCreate([
                            'user_id'=>Auth::user()->user_id
                        ],[
                            'username'=>Auth::user()->name,
                            'amount_user'=>$samtus,
                            'day_c'=>$today->day,
                            'month_c'=>$today->month,
                            'year_c'=>$today->year,
                            'total'=>$total_u_f
                        ]);
            }
        }
        
        cart::where('id_cart_user','CART_CS'.Auth::user()->user_id)->delete();
        session()->flash('check_cod_don','Đặt hàng thành công');
        return redirect(route('cart'));
    }
    public function checkout_cod_get_don(Request $request)
    {
        $cart = cart::all()->where('id_cart_user','CART_CS'.Auth::user()->user_id)->where('id_product',$request->id);
        $total = $request->tt_cod;
        $phuphi = city::all()->where('name_city', Auth::user()->city);
        foreach($phuphi as $phu){
            $phi = $phu->price;
            return view('interiors.blocks.checkout_cod_don', compact('cart','total','phi'));
        }
    }
    public function checkout_cod_post_don(Request $request)
    {
        $get_cart = cart::all()->where('id_cart_user','CART_CS'.Auth::user()->user_id)->count();
        // echo $get_cart.'<br>';

        $id_bill = array_slice($request->id_bill,0,$get_cart,true);
        $id_product = array_slice($request->id_product,0,$get_cart,true);
        $name_product = array_slice($request->name_product,0,$get_cart,true);
        $amount_product = array_slice($request->amount_product,0,$get_cart,true);
        $price = array_slice($request->price,0,$get_cart,true);
        $username= array_slice($request->username,0,$get_cart,true);
        $email= array_slice($request->email,0,$get_cart,true);
        $phone= array_slice($request->phone,0,$get_cart,true);
        $date_create= array_slice($request->date_create,0,$get_cart,true);
        $method= array_slice($request->method,0,$get_cart,true);
        $address= array_slice($request->address,0,$get_cart,true);
        $total = array_slice($request->total,0,$get_cart,true);
        $status_product_bill= array_slice($request->status_product_bill,0,$get_cart,true);

        $pr_service = city::where('name_city',Auth::user()->city)->get();
        foreach($pr_service as $price_service){
            for($i=0;$i<$get_cart;$i++){ // Thêm thành công
                bill::create([
                    'id_bill'=>$id_bill[0],
                    'id_product'=>$id_product[0],
                    'name_product'=>$name_product[0],
                    'amount'=>$amount_product[0],
                    'price'=>$price[0],
                    'username'=>$username[0],
                    'email'=>$email[0],
                    'phone'=>$phone[0],
                    'date_create'=>$date_create[0],
                    'year_create'=>Carbon::now('Asia/Ho_Chi_Minh')->year,
                    'method'=>$method[0],
                    'price_service'=>$price_service->price[0],
                    'address'=>$address[0],
                    'total'=>$total[0],
                    'status_product_bill'=>$status_product_bill[0]
                ]);
                //**** 1 thêm vào data sản phẩm nổi bật */
                    $today = Carbon::now('Asia/Ho_Chi_Minh');
                    $product_famous = product_famous::all()->where('id_product',$id_product[0])
                                                        ->where('day_c',$today->day)
                                                        ->where('month_c',$today->month)
                                                        ->where('year_c',$today->year);
                    $sum_amount = $product_famous->sum('amount_bill');
                    $samt = $sum_amount+1;
                    product_famous::updateOrCreate([
                        'id_product'=>$id_product[0]
                    ],[
                        'amount_bill'=>$samt[0],
                        'day_c'=>$today->day[0],
                        'month_c'=>$today->month[0],
                        'year_c'=>$today->year[0]
                    ]);
                //*** Xuwr lys theem data khasch hangf nooir abat */
                        $get_tb = bill::where('id_bill',$request->id_bill)->distinct()->sum('total');
                        $user_famous = user_famous::all()->where('user_id',Auth::user()->user_id)
                                                        ->where('day_c',$today->day)
                                                        ->where('month_c',$today->month)
                                                        ->where('year_c',$today->year);
                        $sum_amount_us = $user_famous->sum('amount_user');
                        $samtus = $sum_amount_us+1;
                        $sum_total_u = $user_famous->sum('total');
                        $total_u_f = $sum_total_u + $get_tb;
                        user_famous::updateOrCreate([
                            'user_id'=>Auth::user()->user_id
                        ],[
                            'username'=>Auth::user()->name,
                            'amount_user'=>$samtus,
                            'day_c'=>$today->day,
                            'month_c'=>$today->month,
                            'year_c'=>$today->year,
                            'total'=>$total_u_f
                        ]);
                cart::where('id_cart_user','CART_CS'.Auth::user()->user_id)->where('id_product',$id_product[0])->delete();
            }
        }
        session()->flash('check_cod_don','Đặt hàng thành công');
        return redirect(route('cart'));
    }


    public function bill_dashboad()
    {
        // $bill_ = bill::all();
        $bill_xuly = bill::where('status_product_bill','1')->limit(10)->paginate(10);

        $count_xl = bill::all()->where('status_product_bill','1')->count();
        $count_vc = bill::all()->where('status_product_bill','2')->count();
        $count_hd = bill::all()->where('status_product_bill','3')->count();
        
        $product = product::all()->where('status','Còn hàng');
        return view('dashboards.clients.list-bill', compact('bill_xuly','count_xl','count_vc','count_hd','product'));
    }
    
    public function bill_vanchuyen_dashboad()
    {
        $bill_vanchuyen = bill::where('status_product_bill','2')->limit(10)->paginate(10);
        // dd($bill_vanchuyen);
        $count_xl = bill::all()->where('status_product_bill','1')->count();
        $count_vc = bill::all()->where('status_product_bill','2')->count();
        $count_hd = bill::all()->where('status_product_bill','3')->count();

        $product = product::all()->where('status','Còn hàng');
        return view('dashboards.clients.list-bill-vanchuyen', compact('bill_vanchuyen','count_xl','count_vc','count_hd','product'));
    }
    public function bill_hangden_dashboad()
    {
        $bill_hangden = bill::where('status_product_bill','3')->orderbydesc('method')->limit(10)->paginate(10);
        
        $count_xl = bill::all()->where('status_product_bill','1')->count();
        $count_vc = bill::all()->where('status_product_bill','2')->count();
        $count_hd = bill::all()->where('status_product_bill','3')->count();

        $product = product::all()->where('status','Còn hàng');
        return view('dashboards.clients.list-bill-hangden', compact('bill_hangden','count_xl','count_vc','count_hd','product'));
    }
    public function bill_thanhcong_dashboad()
    {
        $bill_thanhcong = bill::where('status_product_bill', '4')->limit(10)->paginate(10);
        
        $count_xl = bill::all()->where('status_product_bill','1')->count();
        $count_vc = bill::all()->where('status_product_bill','2')->count();
        $count_hd = bill::all()->where('status_product_bill','3')->count();

        $product = product::all()->where('status','Còn hàng');
        return view('dashboards.clients.list-bill-thanhcong', compact('bill_thanhcong','count_xl','count_vc','count_hd','product'));
    }
    public function up_bill_dashboad(Request $request)
    {
        bill::where('id_bill',$request->id)->update([
            'status_product_bill'=>'2'
        ]);
        session()->flash('up_xl', '');
        return back();
    }
    public function up_bill_vanchuyen(Request $request)
    {
        bill::where('id_bill', $request->id)->update([
            'status_product_bill'=>'3'
        ]);
        session()->flash('up_vc', '');
        return back();
    }
    public function up_bill_xacnhan_store(Request $request)
    {
        bill::where('id_bill', $request->id)->update([
            'status_product_bill'=>'4'
        ]);
        session()->flash('up_vc', '');
        return back();
    }
    // thanh toán trang admin
    public function up_to_cart_dashboard(Request $request)
    {
        $id_cart_user = $request->id_cart_user;
        $id_product = $request->id_product;
        $price_product = $request->price_product;
        $amount_product = $request->amount_product;
        // echo $id_cart_user.'<br>';
        // echo $id_product.'<br>';
        // echo $price_product.'<br>';
        // echo $amount_product.'<br>';
        
        if($amount_product == null){
            session()->flash('er', 'Chưa nhập số lượng');
            return back();
        }
        $total_sales = $price_product*$amount_product; // Lưu vào biến total_sales
        // echo $total_sales;
        // dd($request->all());
        $cart = cart::where('id_cart_user',$id_cart_user)->where('id_product',$id_product)->get();

        if ($cart == "[]") {
            cart::create([
                'id_cart_user'=>$id_cart_user,
                'id_product'=>$id_product,
                'name_product'=>$request->name_product,
                'price_product'=>$price_product,
                'datecreate'=>$request->date_create,
                'status_product'=>'Còn hàng',
                'amount_product'=>$amount_product,
                'total_sales'=>$total_sales
            ]);
            // echo 'if';return;
        } else {
            foreach($cart as $crt){
                cart::where('id_cart_user',$id_cart_user)->where('id_product',$id_product)
                ->update([
                    'amount_product'=>$crt->amount_product+$amount_product,
                    'total_sales'=>$crt->total_sales+$total_sales
                ]);
            }
            // echo 'else';return;
        }
        $update_amount_product = $request->amount_old-$amount_product;
        product::where('id_product',$request->id_product)->update(['amount'=>$update_amount_product]);
        // session()->flash('sc', '');
        return back();
    }
    public function drestroy_cart_dashboad(Request $request)
    {
        $getPr = product::where('id_product',$request->id_product)->get();
        foreach($getPr as $pr){
            $old_amount = $pr->amount;
            $sum = $old_amount+$request->amount;
            $pr->update(['amount'=>$sum]);
        }
        cart::where('id',$request->id)->delete();
        return back();
    }
    public function return_db(Request $request)
    {
        $vnp_TxnRef = $request->vnp_TxnRef;
        $vnp_BankCode = $request->vnp_BankCode;
        $vnp_BankTranNo = $request->vnp_BankTranNo;
        $vnp_TransactionNo = $request->vnp_TransactionNo;
        $vnp_CardType = $request->vnp_CardType;
        $vnp_Amount = $request->vnp_Amount/100;
        $vnp_ResponseCode = $request->vnp_ResponseCode;
        $phone = $request->vnp_OrderInfo;

        // $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $vnp_HashSecret = "XJZONSMCWFAWVKHFSCLGCCIUIPLNCUPN";
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($vnp_ResponseCode == '00') {
                $done = "GD thành công";
                $cart = cart::all()->where('id_cart_user','STORE-'.Auth::user()->user_id);
                foreach($cart as $crt){
                    bill::create([
                        'id_bill'=>$vnp_TxnRef,
                        'id_product'=>$crt->id_product,
                        'name_product'=>$crt->name_product,
                        'amount'=>$crt->amount_product,
                        'price'=>$crt->price_product,
                        'date_create'=>Carbon::now('Asia/Ho_Chi_Minh')->toDateString(),
                        'year_create'=>Carbon::now('Asia/Ho_Chi_Minh')->year,
                        'method'=>$vnp_CardType,
                        'bank'=>$vnp_BankCode,
                        'code_bank'=>$vnp_BankTranNo,
                        'code_vnpay'=>$vnp_TransactionNo,
                        'total'=>$vnp_Amount,
                        'status_product_bill'=>'STOP'
                    ]);
                    //**** 1 thêm vào data sản phẩm nổi bật */
                    $today = Carbon::now('Asia/Ho_Chi_Minh');
                    $product_famous = product_famous::all()->where('id_product',$crt->id_product)
                                                        ->where('day_c',$today->day)
                                                        ->where('month_c',$today->month)
                                                        ->where('year_c',$today->year);
                    $sum_amount = $product_famous->sum('amount_bill');
                    $samt = $sum_amount+1;
                    product_famous::updateOrCreate([
                        'id_product'=>$crt->id_product
                    ],[
                        'amount_bill'=>$samt,
                        'day_c'=>$today->day,
                        'month_c'=>$today->month,
                        'year_c'=>$today->year
                    ]);
                }
                $discounts = discount::all()->where('status_discount','Phát hành');
                $get_data_for_bill = bill::all()->where('id_bill',$vnp_TxnRef);
                foreach($get_data_for_bill as $gdtfb){
                    $id_bill_ = $gdtfb->id_bill;
                    return view('dashboards.clients.new-bill-user', compact('get_data_for_bill','id_bill_','discounts','phone'));
                }
                // dd($get_data_for_bill);
            } 
            else {
                $done = "GD Không thành công";
                session()->flash('fail', $done);
                return redirect()->route('create_bill_dashboard');
                }
        } else {
            $done = "Chữ ký không hợp lệ";
            session()->flash('fail', $done);
            return redirect()->route('create_bill_dashboard');
        }
    }
    public function update_after_pay(Request $request)
    {
        $old_bill = bill::where('id_bill',$request->id_bill)->distinct()->sum('total');
        if(!empty($request->discount)){
            // $dis = (100-$request->discount)/100;
            $new_total = $old_bill*((100-$request->discount)/100); 
        }else{
            $new_total = $old_bill;
        }
        $check_user = User::where('email',$request->email)
                        ->orwhere('phone',$request->phone)
                        ->get();
        
        foreach($check_user as $itm_ckUser){
            if($check_user == "[]"){
                $username = $request->username;
                $phone = $request->phone;
                $email = $request->email;
            }else{
                $username = $itm_ckUser->username;
                $phone = $itm_ckUser->phone;
                $email = $itm_ckUser->email;
            }
            if(!empty($request->address)){
                $address = $request->address;
            }else{
                $address = $itm_ckUser->city.', '.$itm_ckUser->province.', '.$itm_ckUser->district;
            }
        }
        
        bill::where('id_bill',$request->id_bill)->where('status_product_bill','STOP')
        ->update([
            'username'=>$username,
            'phone'=>$phone,
            'email'=>$email,
            'address'=>$address,
            'method'=>'STORE',
            'status_product_bill'=>'1',
            'total'=>$new_total
        ]);
        cart::where('id_cart_user','STORE-'.Auth::user()->user_id)->delete();
        // $bill_amount = bill::all()->where('id_bill',$request->id_bill);
        // foreach($bill_amount as $bill_amt){
        //     $amount = $bill_amt->amount;
        //     $sum_old_amount = product::where('id_product', $bill_amt->id_product)->sum('amount');
        //     $amount_new = $amount+$sum_old_amount;
        //     product::where('id_product',$bill_amt->id_product)->update([
        //         'amount'=>$amount_new
        //     ]);
        // }
        session()->flash('pay_sc','Thanh  toán thành công');
        return redirect(route('bill_dashboad'));
    }
    public function destroy_bill_dashboard(Request $request)
    {
        $bill = bill::all()->where('id_bill',$request->id_bill);
        foreach($bill as $bills){
            $id_product = $bills->id_product;
            //**** 1 thêm vào data sản phẩm nổi bật */
            $today = Carbon::now('Asia/Ho_Chi_Minh');
            $product_famous = product_famous::all()->where('id_product',$id_product)
                                                ->where('day_c',$today->day)
                                                ->where('month_c',$today->month)
                                                ->where('year_c',$today->year);
            $sum_amount = $product_famous->sum('amount_bill');
            $samt = $sum_amount-1;
            product_famous::updateOrCreate([
                'id_product'=>$id_product
            ],[
                'amount_bill'=>$samt
            ]);
        }
        

        bill::where('status_product_bill','STOP')->delete();
        return redirect(route('create_bill_dashboard'));
    }
    public function pay_store(Request $request){
        if($request->checkMethod == 1){
            $cart = cart::all()->where('id_cart_user','STORE-'.Auth::user()->user_id);
            if($request->total_cart == 0){
                session()->flash('er', 'Chưa có sản phẩm');
                return back();
            }
            foreach($cart as $crt){
                bill::create([
                    'id_bill'=>'STORE-'.Auth::user()->user_id.time(),
                    'id_product'=>$crt->id_product,
                    'name_product'=>$crt->name_product,
                    'amount'=>$crt->amount_product,
                    'price'=>$crt->price_product,
                    'date_create'=>Carbon::now('Asia/Ho_Chi_Minh')->toDateString(),
                    'year_create'=>Carbon::now('Asia/Ho_Chi_Minh')->year,
                    'method'=>'STORE',
                    'total'=>$request->total_cart,
                    'status_product_bill'=>'STOP'
                ]);
                
                //**** 1 thêm vào data sản phẩm nổi bật */
                $today = Carbon::now('Asia/Ho_Chi_Minh');
                $product_famous = product_famous::all()->where('id_product',$crt->id_product)
                                                    ->where('day_c',$today->day)
                                                    ->where('month_c',$today->month)
                                                    ->where('year_c',$today->year);
                $sum_amount = $product_famous->sum('amount_bill');
                $samt = $sum_amount+1;
                product_famous::updateOrCreate([
                    'id_product'=>$crt->id_product
                ],[
                    'amount_bill'=>$samt,
                    'day_c'=>$today->day,
                    'month_c'=>$today->month,
                    'year_c'=>$today->year
                ]);
            }
            $get_ = bill::where('status_product_bill','STOP')
                            ->where('method','STORE')
                            ->orderbydesc('id')->first('id_bill');
            $id_bill_ = substr($get_, 12, -2);
            $discounts = discount::all()->where('status_discount','Phát hành');
            $get_data_for_bill = bill::all()->where('id_bill',$id_bill_);
            $phone = $request->phone;
            return view('dashboards.clients.new-bill-user', compact('get_data_for_bill','id_bill_','discounts','phone'));
        }elseif($request->checkMethod == 2){
            if($request->total_cart == 0){
                session()->flash('er', 'Chưa có sản phẩm');
                return back();
            }
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
            $vnp_Returnurl = $this->_hosts()."return-db";
            $vnp_TmnCode = "HEYD7Y8N";//Mã website tại VNPAY 
            $vnp_HashSecret = "XJZONSMCWFAWVKHFSCLGCCIUIPLNCUPN"; //Chuỗi bí mật
            
            $vnp_TxnRef = 'STORE-'.Auth::user()->user_id.time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = $request->phone;
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $request->total_cart * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = "NCB";
            // $vnp_BankCode = 'VNPAYQR';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
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
                "vnp_TxnRef" => $vnp_TxnRef
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
                if (isset($_POST['redirect'])) {// thêm name='redirect' vào nút thanh toán vnpay
                // if (isset($request->redirect)) {// thêm name='redirect' vào nút thanh toán vnpay
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
                // vui lòng tham khảo thêm tại code demo
        }else{
            if($request->total_cart == 0){
                session()->flash('er', 'Chưa có sản phẩm');
                return back();
            }
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
            $vnp_Returnurl = $this->_hosts()."return-db";
            $vnp_TmnCode = "HEYD7Y8N";//Mã website tại VNPAY 
            $vnp_HashSecret = "XJZONSMCWFAWVKHFSCLGCCIUIPLNCUPN"; //Chuỗi bí mật
            
            $vnp_TxnRef = 'STORE-'.Auth::user()->user_id.time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = $request->phone;
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $request->total_cart * 100;
            $vnp_Locale = 'vn';
            // $vnp_BankCode = "NCB";
            $vnp_BankCode = 'VNPAYQR';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
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
                "vnp_TxnRef" => $vnp_TxnRef
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
                if (isset($_POST['redirect'])) {// thêm name='redirect' vào nút thanh toán vnpay
                // if (isset($request->redirect)) {// thêm name='redirect' vào nút thanh toán vnpay
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
                // vui l
        }
    }
    public function destroy_donhang_dashboard(Request $request)
    {
        $year = Carbon::now('Asia/Ho_Chi_Minh')->year;
        // thêm giá vào expenses_incurred, update status_bil = 0
        bill::where('id_bill', $request->id)->update([
            'status_product_bill'=>'0'
        ]);

        $today = Carbon::now('Asia/Ho_Chi_Minh');
        $bill_amt = bill::all()->where('id_bill', $request->id);
        foreach($bill_amt as $bill_a){
            $id_product = $bill_a->id_product;
            $product_old = product::where('id_product',$id_product)->sum('amount');
            $amt = $product_old+$bill_a->amount;
            product::where('id_product',$id_product)->update(['amount'=>$amt]);

            //**** product famous */
                $product_famous = product_famous::all()->where('id_product',$bill_a->id_product)
                                                    ->where('day_c',$today->day)
                                                    ->where('month_c',$today->month)
                                                    ->where('year_c',$today->year);
                $sum_amount = $product_famous->sum('amount_bill');
                $samt = $sum_amount - $bill_a->amount;
                if($samt > 0){
                    product_famous::updateOrCreate([
                        'id_product'=>$bill_a->id_product
                    ],[
                        'amount_bill'=>$samt,
                        'day_c'=>$today->day,
                        'month_c'=>$today->month,
                        'year_c'=>$today->year,
                    ]);
                }else{
                    product_famous::updateOrCreate([
                        'id_product'=>$bill_a->id_product
                    ],[
                        'amount_bill'=>'0',
                        'day_c'=>$today->day,
                        'month_c'=>$today->month,
                        'year_c'=>$today->year,
                    ]);
                }
            //*** user famous */
                $us = User::all()->where('email',$bill_a->email);
                if($us != "[]"){
                    foreach($us as $users){
                        $user_famous = user_famous::all()->where('user_id',$users->user_id)
                                                        ->where('day_c',$today->day)
                                                        ->where('month_c',$today->month)
                                                        ->where('year_c',$today->year);
                        $sum_amount_us = $user_famous->sum('amount_user');
                        $samtus = $sum_amount_us - $bill_a->amount;
                        $sum_total_u = $user_famous->sum('total');
                        $total_u_f = $sum_total_u - $bill_a->total;
                        if($total_u_f > 0){
                            user_famous::updateOrCreate([
                                'user_id'=>$users->user_id
                            ],[
                                'username'=>$users->name,
                                'amount_user'=>$samtus,
                                'day_c'=>$today->day,
                                'month_c'=>$today->month,
                                'year_c'=>$today->year,
                                'total'=>$total_u_f
                            ]);
                        }else{
                            user_famous::updateOrCreate([
                                'user_id'=>$users->user_id
                            ],[
                                'username'=>$users->name,
                                'amount_user'=>'0',
                                'day_c'=>$today->day,
                                'month_c'=>$today->month,
                                'year_c'=>$today->year,
                                'total'=>'0'
                            ]);
                        }
                    }
                }
            //
            $check_ex = expense::all()->where('years',$year);
            $bill_price_service = bill::where('id_bill', $request->id)->distinct()->sum('price_service');
            if($check_ex == '[]'){
                if($bill_a->status_product_bill == "1"){
                    expense::updateOrCreate(['years'=>$year,'expense_incurred'=>'0']);
                }else{
                    foreach($check_ex as $check_e){
                        $incurred_old = $check_e->expense_incurred;
                    }
                    $incurred = $incurred_old+$bill_price_service;
                    expense::updateOrCreate([
                        'years'=>$year
                    ],[
                        'expense_incurred'=>$incurred
                    ]);
                }
            }else{
                if($bill_a->status_product_bill == "1"){
                    foreach($check_ex as $check_e){
                        $incurred_old = $check_e->expense_incurred;;
                    }
                    expense::updateOrCreate([
                        'years'=>$year,
                        'expense_incurred'=>$incurred_old
                    ]);
                    // echo '1 - '.$incurred_old;return;
                }else{
                    foreach($check_ex as $check_e){
                        $incurred_old = $check_e->expense_incurred;
                    }
                    $incurred = $incurred_old+$bill_price_service;
                    expense::updateOrCreate([
                        'years'=>$year
                    ],[
                        'expense_incurred'=>$incurred
                    ]);
                    // echo '2 - '.$incurred;return;
                }
            }
        }

        // check save to history
        if(Auth::user()->name_roles == 'user'){
            session()->flash('huy_bill', 'Hủy đơn hàng thành công');
            return back();
        }else{
            history::create([
                'name_his'=>'Destroy',
                'user_his'=>Auth::user()->email,
                'description_his'=>'Hủy đơn hàng:'.$request->id
            ]);
            session()->flash('huy_bill', 'Hủy đơn hàng thành công');
            return back();
        }
    }
}
// Xửlý_1
// Vậnchuyển_2
// Hàngđến_3
// Thànhcông_4