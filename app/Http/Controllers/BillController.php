<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bill;

class BillController extends Controller
{

    /**
     * Ngân hàng	NCB
        Số thẻ	9704198526191432198
        Tên chủ thẻ	NGUYEN VAN A
        Ngày phát hành	07/15
        Mật khẩu OTP	123456
        
     * http://192.168.2.39:8000/?vnp_Amount=40000000&vnp_BankCode=NCB&vnp_BankTranNo=VNP14482143&vnp_CardType=ATM&vnp_OrderInfo=Thanh+to%C3%A1n+h%C3%A1o+%C4%91%C6%A1n&vnp_PayDate=20240627182652&vnp_ResponseCode=00&vnp_TmnCode=KEZ10GK3&vnp_TransactionNo=14482143&vnp_TransactionStatus=00&vnp_TxnRef=62981719487560vnp_SecureHash=2661c72f6da6bc4c4e1181eb39a53b7aa137387bc82d2cda810b854321f0fb6b0004c7cd3eb7e6c64c3422913a0ea97d8bd08bbfdb8f1cf76f4874a23f6521c6
     * */ 
    public function Naptien(Request $request, $id)
    {
        $menh_gia = [
            '1' => 20000,
            '2' => 50000,
            '3' => 100000,
            '4' => 200000,
            '5' => 300000,
            '6' => 400000,
            '7' => 500000
        ];

        if (isset($request['menh_gia']) && array_key_exists($request['menh_gia'], $menh_gia)) {
           $amount = $menh_gia[$request['menh_gia']];
        } else {
            $amount = 20000;
        }

        $user = User::find($id);
        $bill = new Bill();

        if($user) {
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://192.168.2.39:8000/Nap-tien-thanh-cong/".$id;
            $vnp_TmnCode = "KEZ10GK3"; //Mã website tại VNPAY 
            $vnp_HashSecret = "JA4HEI3W8AF7QIAYX18W1DKAQ7W1WIMH"; //Chuỗi bí mật
    
            $vnp_TxnRef = rand(0,9999).'_'.$user->id.'_'.time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = "Nạp tiền";
            $vnp_OrderType = "NTP_Novel";
            $vnp_Amount = $amount * 100;
            $vnp_Locale = "vn";
            $vnp_BankCode = "NCB";
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
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }

            $bill->idUser = $id;
            $bill->iMoney = $amount;
            $bill->iCoint = $amount / 1000;
            $bill->vnp_TxnRef = $vnp_TxnRef;
            $bill->iStatus = 0;
            $bill->save();

            header('Location: ' . $vnp_Url);
            die();
        }
    }

    public function Naptienthanhcong(Request $request, $id) {

        // dd($request);
        $user = User::find($id);
        
        $vnp_TxnRef = $request['vnp_TxnRef'];
        $vnp_ResponseCode = $request['vnp_ResponseCode'];
        $vnp_TransactionStatus = $request['vnp_TransactionStatus'];

        if (empty($vnp_TxnRef) || empty($vnp_ResponseCode) || empty($vnp_TransactionStatus)) {
            return view('user.thankyou', [
                'message' => 'Thiếu thông tin nhanh toán rồi. Nếu có lỗi xảy ra hãy viết báo cáo',
            ]);
        } else {
            $bill = Bill::where('vnp_TxnRef', $vnp_TxnRef)
                        ->first();
            if (!$bill) {
                return view('user.thankyou', [
                    'message' => 'Không tìm thấy hóa đơn của bạn trong hệ thống. Nếu có lỗi xảy ra hãy viết báo cáo',
                ]);
            } else {

                if($user) {
                    $user->iCoint = $user->iCoint + $bill->iCoint;
                    $user->save();
                } else {
                    return view('user.thankyou', [
                        'message' => 'không tìm thấy thông tin người dùng của bạn. Nếu có lỗi xảy ra hãy viết báo cáo',
                    ]);
                }

                if($bill->iStatus == 1) {
                    return view('user.thankyou', [
                        'message' => 'Hóa đơn của bạn đã đươc thanh toán. Nếu có lỗi xảy ra hãy viết báo cáo',
                    ]);
                }

                if($vnp_ResponseCode == '00' && $vnp_TransactionStatus = '00') {
                    $bill->iStatus = 1;
                    $bill->save();

                    return view('user.thankyou', [
                        'message' => 'Hóa đơn của bạn đã đươc thanh toán thành công hãy kiểm tra số xu của mình trong ví ở trang cá nhân. Nếu có lỗi xảy ra hãy viết báo cáo',
                    ]);
                }
            }
        }

        
    }
}
