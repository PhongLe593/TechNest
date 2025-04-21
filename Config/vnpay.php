<?php
class VNPayConfig
{
    // VNPay merchant credentials
    const VNPAY_MERCHANT_CODE = 'YTXQDF9I'; // Replace with your actual merchant code
    const VNPAY_SECRET_KEY = 'AF26FMTM5PNG1M2004K8DZI1NW0DWPCD'; // Replace with your actual secret key
    
    // VNPay environment URLs
    const VNPAY_URL = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'; // Sandbox environment
    // const VNPAY_URL = 'https://pay.vnpay.vn/vpcpay.html'; // Production environment
    
    const VNPAY_RETURN_URL = 'http://localhost/technest/?act=checkout&xuli=vnpay_return';
    
    // VNPay parameters
    const VNP_VERSION = '2.1.0';
    const VNP_COMMAND = 'pay';
    const VNP_CURRENCY_CODE = 'VND';
    const VNP_LOCALE = 'vn';
} 