<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree_Transaction;
use Braintree\Gateway as Gateway;
use App\Order;
use Illuminate\Mailable;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;
use App\User;

class PaymentsController extends Controller
{
    public function make()
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $token = $gateway->ClientToken()->generate();
        return view('payment',compact('token'));
    }
    
    
    public function checkout(Request $request){

        $cart = json_decode($request->cart, true);
       //ddd($cart);
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $reqAddress = $request->address;
        $reqCity = $request->city;
        $reqProv = $request->province;

        //concatenazione indirizzo di consegna
        $indirizzo = $reqAddress . " " . $reqCity . " " . $reqProv;
        /* ddd($indirizzo); */
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
    
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => $request->name,
                'lastName' => $request->surname,
                'email' => 'tony@avengers.com',
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
    
        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);
            
            //aggiunta ordine al database
            $order = new Order;
            $order->user_id = $request->user_id;
            $order->ui_name = $request->name;
            $order->ui_surname=$request->surname;
            $order->ui_email = $request->mail;
            $order->ui_address = $indirizzo;
            $order->ui_phone_number = $request->phone;
            $order->amount = $request->amount;
            //ddd($order);
            $order->save();

            //invio mail
            $user = User::where('id', $request->user_id)->get();
            //ddd($user[0]['email']);
            $restaurantMail = $user[0]['email'];
            $restaurantName = $user[0]['name'];
            $mail = [
                'name'=>$request->name,
                'surname'=>$request->surname,
                'mail'=>$request->mail,
                'address'=>$indirizzo,
                'phone'=>$request->phone,
                'total'=> $request->amount
            ];
            $mailOrder = $cart;

            //return (new OrderMail($mail,$cart))->render();
            Mail::to($restaurantMail)
            ->cc($request->mail)
            ->send(new OrderMail($mail, $cart,$restaurantName));
            return back()->with('success_message', 'La transazione è avvenuta con successo. ID transazione: '. $transaction->id);
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            


            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('La transazione non ha avuto esito positivo: l\'errore è: '.$result->message);
        }
    }
}
