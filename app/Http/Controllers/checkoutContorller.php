<?php

namespace App\Http\Controllers;

use App\Models\bill;
use App\Models\cart;
use App\Models\city;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkoutContorller extends Controller
{
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
        $vnp_HashSecret = "VBUEHKBFEXKXQMMNNLJCIHZQUSICDJEI";
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($vnp_ResponseCode == '00') {
                $done = "GD thành công";
                $cart = cart::all()->where('id_cart_user','CART_CS'.Auth::user()->user_id);
                foreach($cart as $crt){
                    bill::create([
                        'id_bill'=>$vnp_TxnRef,
                        'id_product'=>$crt->id_product,
                        'name_product'=>$crt->name_product,
                        'amount'=>$crt->amount_product,
                        'price'=>$crt->price_product,
                        'username'=>Auth::user()->name,
                        'email'=>Auth::user()->email,
                        'phone'=>Auth::user()->phone,
                        'date_create'=>Carbon::now('Asia/Ho_Chi_Minh')->toDateString(),
                        'method'=>$vnp_CardType,
                        'bank'=>$vnp_BankCode,
                        'code_bank'=>$vnp_BankTranNo,
                        'code_vnpay'=>$vnp_TransactionNo,
                        'address'=>Auth::user()->district.', '.Auth::user()->city.', '.Auth::user()->province,
                        'total'=>$vnp_Amount,
                        'status_product_bill'=>'Xử lý'
                    ]);
                    cart::where('id_cart_user','CART_CS'.Auth::user()->user_id)->delete();
                }
                $get_data_for_bill = bill::all()->where('id_bill',$vnp_TxnRef);
                foreach($get_data_for_bill as $gdtfb){
                    $date_bill = $gdtfb->date_create;
                    $vnp_TxnRef_bill = $request->id;
                    $vnp_BankCode_bill = $gdtfb->bank;
                    $vnp_BankTranNo_bill = $gdtfb->code_bank;
                    $vnp_TransactionNo_bill = $gdtfb->code_vnpay;
                    $vnp_CardType_bill = $gdtfb->method;
                    
                    $name_bill = $gdtfb->username;
                    $email_bill = $gdtfb->email;
                    $phone_bill = $gdtfb->phone;
                    $address_bill = $gdtfb->address;
                    session()->flash('gd', $done);
                    return view('interiors.blocks.bill', compact('get_data_for_bill','date_bill','vnp_TxnRef','vnp_BankCode',
                    'vnp_BankTranNo','vnp_TransactionNo','vnp_CardType','vnp_Amount','done','vnp_TxnRef_bill','vnp_BankCode_bill',
                    'vnp_BankTranNo_bill','vnp_TransactionNo_bill','vnp_CardType_bill','name_bill','email_bill','phone_bill','address_bill'));
                }
                // dd($get_data_for_bill);
            } 
            else {
                $done = "GD Không thành công";
                session()->flash('gd', $done);
                return redirect()->route('cart');
                }
        } else {
            $done = "Chữ ký không hợp lệ";
            session()->flash('gd', $done);
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
        $vnp_HashSecret = "VBUEHKBFEXKXQMMNNLJCIHZQUSICDJEI";
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($vnp_ResponseCode == '00') {
                $done = "GD thành công";
                $cart = cart::all()->where('id_cart_user','CART_CS'.Auth::user()->user_id)
                ->where('id_product',$request->vnp_OrderInfo); // sử dụng biến vnp_OrderInfo dể làm điểu kiện
                // dd($cart);return;
                foreach($cart as $crt){
                    bill::create([
                        'id_bill'=>$vnp_TxnRef,
                        'id_product'=>$crt->id_product,
                        'name_product'=>$crt->name_product,
                        'amount'=>$crt->amount_product,
                        'price'=>$crt->price_product,
                        'username'=>Auth::user()->name,
                        'email'=>Auth::user()->email,
                        'phone'=>Auth::user()->phone,
                        'date_create'=>Carbon::now('Asia/Ho_Chi_Minh')->toDateString(),
                        'method'=>$vnp_CardType,
                        'bank'=>$vnp_BankCode,
                        'code_bank'=>$vnp_BankTranNo,
                        'code_vnpay'=>$vnp_TransactionNo,
                        'address'=>Auth::user()->district.', '.Auth::user()->city.', '.Auth::user()->province,
                        'total'=>$vnp_Amount,
                        'status_product_bill'=>'Xử lý'
                    ]);
                    cart::where('id_cart_user','CART_CS'.Auth::user()->user_id)
                    ->where('id_product',$crt->id_product)
                    ->delete();
                }
                $get_data_for_bill = bill::all()->where('id_bill',$vnp_TxnRef);
                foreach($get_data_for_bill as $gdtfb){
                    $date_bill = $gdtfb->date_create;
                    $vnp_TxnRef_bill = $request->id;
                    $vnp_BankCode_bill = $gdtfb->bank;
                    $vnp_BankTranNo_bill = $gdtfb->code_bank;
                    $vnp_TransactionNo_bill = $gdtfb->code_vnpay;
                    $vnp_CardType_bill = $gdtfb->method;
                    
                    $name_bill = $gdtfb->username;
                    $email_bill = $gdtfb->email;
                    $phone_bill = $gdtfb->phone;
                    $address_bill = $gdtfb->address;
                    session()->flash('gd', $done);
                    return view('interiors.blocks.bill', compact('get_data_for_bill','date_bill','vnp_TxnRef','vnp_BankCode',
                    'vnp_BankTranNo','vnp_TransactionNo','vnp_CardType','vnp_Amount','done','vnp_TxnRef_bill','vnp_BankCode_bill',
                    'vnp_BankTranNo_bill','vnp_TransactionNo_bill','vnp_CardType_bill','name_bill','email_bill','phone_bill','address_bill'));
                }
                // dd($get_data_for_bill);
            } 
            else {
                $done = "GD Không thành công";
                session()->flash('gd', $done);
                return redirect()->route('cart');
                }
        } else {
            $done = "Chữ ký không hợp lệ";
            session()->flash('gd', $done);
            return redirect()->route('cart');
        }
    }
    public function vnpay_payment(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_Returnurl = "http://127.0.0.1:8000/return-vnpay";
        $vnp_TmnCode = "MX3URQXB";//Mã website tại VNPAY 
        $vnp_HashSecret = "VBUEHKBFEXKXQMMNNLJCIHZQUSICDJEI"; //Chuỗi bí mật
        
        $vnp_TxnRef = 'ICS0'.time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán qua VNPAY';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->total_vnpay * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
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
    }
    public function vnpay_payment_qr(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_Returnurl = "http://127.0.0.1:8000/return-vnpay";
        $vnp_TmnCode = "MX3URQXB";//Mã website tại VNPAY 
        $vnp_HashSecret = "VBUEHKBFEXKXQMMNNLJCIHZQUSICDJEI"; //Chuỗi bí mật
        
        $vnp_TxnRef = 'ICS0'.time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán qua VNPAY';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->total_vnpay * 100;
        $vnp_Locale = 'vn';
        // $vnp_BankCode = 'NCB';
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
            // vui lòng tham khảo thêm tại code demo
    }
    public function vnpay_payment_don_atm(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_Returnurl = "http://127.0.0.1:8000/return-vnpay-don";
        $vnp_TmnCode = "MX3URQXB";//Mã website tại VNPAY 
        $vnp_HashSecret = "VBUEHKBFEXKXQMMNNLJCIHZQUSICDJEI"; //Chuỗi bí mật
        
        $vnp_TxnRef = 'ICS0'.time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->total_vnpay_idpr;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->total_vnpay * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
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
    }
    public function vnpay_payment_don_qr(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        // $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_Returnurl = "http://127.0.0.1:8000/return-vnpay-don";
        $vnp_TmnCode = "MX3URQXB";//Mã website tại VNPAY 
        $vnp_HashSecret = "VBUEHKBFEXKXQMMNNLJCIHZQUSICDJEI"; //Chuỗi bí mật
        
        $vnp_TxnRef = 'ICS0'.time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán qua VNPAY';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->total_vnpay * 100;
        $vnp_Locale = 'vn';
        // $vnp_BankCode = 'NCB';
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
            // vui lòng tham khảo thêm tại code demo
    }


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
    public function checkout_cod_post(Request $request)
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
        // print_r( $id_bill);
        //     print_r( $id_product);
        //     print_r( $name_product);
        //     print_r( $amount_product);
        //     print_r( $price);
        //     print_r( $username);
        //     print_r( $email);
        //     print_r( $phone);
        //     print_r( $date_create);
        //     print_r( $method);
        //     print_r( $address);
        //     print_r( $total);
        // print_r( $status_product_bill);

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
                'method'=>$method[$i],
                'address'=>$address[$i],
                'total'=>$total[$i],
                'status_product_bill'=>$status_product_bill[$i]
            ]);
        }
        cart::where('id_cart_user','CART_CS'.Auth::user()->user_id)->delete();
        session()->flash('check_cod_don','Đặt hàng thành công');
        return redirect(route('cart'));
    }
    public function checkout_cod_get_don(Request $request)
    {
        $cart = cart::all()->where('id_cart_user','CART_CS'.Auth::user()->user_id)
        ->where('id_product',$request->id);
        // dd($cart);
        foreach($cart as $crt){
            bill::create([
                'id_bill'=>'ICS0'.time().'COD',
                'id_product'=>$crt->id_product,
                'name_product'=>$crt->name_product,
                'amount'=>$crt->amount_product,
                'price'=>$crt->price_product,
                'username'=>Auth::user()->name,
                'email'=>Auth::user()->email,
                'phone'=>Auth::user()->phone,
                'date_create'=>Carbon::now('Asia/Ho_Chi_Minh')->toDateString(),
                'method'=>'COD',
                'address'=>Auth::user()->district.', '.Auth::user()->city.', '.Auth::user()->province,
                'total'=>$request->total_cod,
                'status_product_bill'=>'Xử lý'
            ]);
            cart::where('id_cart_user','CART_CS'.Auth::user()->user_id)
            ->where('id_product', $request->id)
            ->delete();//chus ys xoas 1 thif caanf theem id sp
            session()->flash('check_cod_don','Đặt hàng thành công');
            return redirect()->route('cart');
        }
    }

    public function ship_done(Request $request)
    {
        bill::where('id_bill',$request->id)->update([
            'status_product_bill'=>'Thành công'
        ]);
        session()->flash('ship_done', 'Cảm ơn bạn đã tin tưởng và sử dụng sản phẩm của chúng tôi.');
        return back();
    }

    public function bill_dashboad()
    {
        // $bill_ = bill::all();
        $bill_xuly = bill::where('status_product_bill','Xử lý')->limit(10)->paginate(10);

        $count_xl = bill::all()->where('status_product_bill','Xử lý')->count();
        $count_vc = bill::all()->where('status_product_bill','Vận chuyển')->count();
        $count_hd = bill::all()->where('status_product_bill','Hàng đến')->count();
        return view('dashboards.clients.list-bill', compact('bill_xuly','count_xl','count_vc','count_hd'));
    }
    public function bill_vanchuyen_dashboad()
    {
        $bill_vanchuyen = bill::where('status_product_bill','Vận chuyển')->limit(10)->paginate(10);
        // dd($bill_vanchuyen);
        $count_xl = bill::all()->where('status_product_bill','Xử lý')->count();
        $count_vc = bill::all()->where('status_product_bill','Vận chuyển')->count();
        $count_hd = bill::all()->where('status_product_bill','Hàng đến')->count();
        return view('dashboards.clients.list-bill-vanchuyen', compact('bill_vanchuyen','count_xl','count_vc','count_hd'));
    }
    public function bill_hangden_dashboad()
    {
        $bill_hangden = bill::where('status_product_bill','Hàng đến')->limit(10)->paginate(10);
        
        $count_xl = bill::all()->where('status_product_bill','Xử lý')->count();
        $count_vc = bill::all()->where('status_product_bill','Vận chuyển')->count();
        $count_hd = bill::all()->where('status_product_bill','Hàng đến')->count();
        return view('dashboards.clients.list-bill-hangden', compact('bill_hangden','count_xl','count_vc','count_hd'));
    }
    public function bill_thanhcong_dashboad()
    {
        $bill_thanhcong = bill::where('status_product_bill', 'Thành công')->limit(10)->paginate(10);
        
        $count_xl = bill::all()->where('status_product_bill','Xử lý')->count();
        $count_vc = bill::all()->where('status_product_bill','Vận chuyển')->count();
        $count_hd = bill::all()->where('status_product_bill','Hàng đến')->count();
        return view('dashboards.clients.list-bill-thanhcong', compact('bill_thanhcong','count_xl','count_vc','count_hd'));
    }
    public function up_bill_dashboad(Request $request)
    {
        bill::where('id_bill',$request->id)->update([
            'status_product_bill'=>'Vận chuyển'
        ]);
        session()->flash('up_xl', '');
        return back();
    }
    public function up_bill_vanchuyen(Request $request)
    {
        bill::where('id_bill', $request->id)->update([
            'status_product_bill'=>'Hàng đến'
        ]);
        session()->flash('up_vc', '');
        return back();
    }
}
