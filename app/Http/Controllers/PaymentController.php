<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Config;
use App\Classes\Crypto;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        // $user = Auth::check();//dd($user);
        // if($user)
        // {
        //     return view('payment.payment');
        // }
        // return redirect()->intended('login/customer');
        return view('payment.payment');
    } 

    public function payment(Request $request)
    {
        $data = $request->all();
        return view('payment.dataForm', compact('data'));
    }

    public function checkout(Request $request)
    {
        $data = $request->all();
        $order_id='234';
        $sql_statement = 'put your sql query to find product amount and merchant_id';
     // fetch product amount from sql query
        $amount_value = '1';//$sql_statement->amount;
        // fetch merchant id from sql query
        $merchant_id = "2222";//$sql_statement->merchant_id;
        $merchant_data = "";
        $ccavanue_data = Config::get('payment.ccavanue'); //dd($ccavanue_data['access_code']);
        $merchant_data.='merchant_id'.'='.$ccavanue_data['mid'].'&'.'amount'.'='.$amount_value.'&'.'order_id'.'='.$order_id.'&';
        //$x = new Crypto;
        $encrypted_data = encrypt($merchant_data, $ccavanue_data['working_key']); //dd($encrypted_data);// Method for encrypting the data.
        $production_url='https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$ccavanue_data['access_code'];
        //dd($production_url);
        return view('payment.requestHandle', compact('production_url'));
    }
    
     // use product id and find amount and other details of product.
     //$product_id=isset($_POST['product_id']) ? $_POST['product_id'] : '' ;
    
    public function ccavResponseHandler(Request $request)
    {
        $data = $request->all();
        $ccavanue_data = Config::get('payment.ccavanue');
        $workingKey = $ccavanue_data['working_key'];       //Working Key should be provided here.
        $encResponse=$data["encResp"];          //This is the response sent by the CCAvenue Server
        $x = new Crypto;
        $rcvdString = $x->decrypt($encResponse,$workingKey);    //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
     
        for($i = 0; $i < $dataSize; $i++) 
        {
           $information=explode('=',$decryptValues[$i]);
           if($i==3)
           {
                $order_status=$information[1];
           }
        }
        // for($i = 0; $i < $dataSize; $i++) 
        // {
        //     $information=explode('=',$decryptValues[$i]);
        //     //echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
        // }
        return view('payment.response', compact('order_status','dataSize', 'decryptValues'));
    }
}
