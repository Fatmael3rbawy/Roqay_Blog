<?php

namespace App\Http\Controllers;

use App\Http\Services\FatorahService;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Notifications\InvoicePaid;

class FatorahController extends Controller
{
    private $fatorahService;


    public function __construct(FatorahService $fatorahService)
    {
        $this->fatorahService = $fatorahService;
    }


    public function pay()
    {
        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'invoice_status' => 'pending'
        ]);

        $data = [
            'NotificationOption' => 'Lnk',
            'InvoiceValue' => '100',
            'CustomerName' => auth()->user()->name,
            'CallBackUrl'   => env('Success_URL'),
            'ErrorUrl'    => env('Error_URL'),
            'Language'  => 'en',
            'DisplayCurrencyIso' => 'KWD',
            'CustomerReference' =>  $transaction->id
        ];

        $response =  $this->fatorahService->sendPayment($data);
        $transaction->update([
            'invoice_id' => $response['Data']['InvoiceId'],
            'invoice_url' => $response['Data']['InvoiceURL'],

        ]);

        $payment_url = $response['Data']['InvoiceURL'];
        return view('auth.pay', compact('payment_url',));
    }

    public function payment_response($invoice_id)
    {
        $data = [
            'key' => $invoice_id,
            'KeyType' => 'InvoiceId'
        ];
        $payment_data = $this->fatorahService->getStatus($data);
        // dd($payment_data);
        $transaction = Transaction::where('invoice_id', $invoice_id);
        // dd($payment_data['Data']['InvoiceTransactions']);
        if ($t = $payment_data['Data']['InvoiceTransactions']) {
            switch ($t[0]['TransactionStatus']) {

                case ('Paied'):
                    $transaction->update([
                        'invoice_status' => $payment_data['Data']['InvoiceTransactions'][0]['TransactionStatus'],
                        'invoice_reference' => $payment_data['Data']['InvoiceReference'],
                        'created_date' => $payment_data['Data']['CreatedDate'],
                        'expiry_date' => $payment_data['Data']['ExpiryDate'],
                        'expiry_time' => $payment_data['Data']['ExpiryTime'],
                        'invoice_value' => $payment_data['Data']['InvoiceValue'],
                        'invoice_display_value' => $payment_data['Data']['InvoiceDisplayValue'],
                    ]);
                    // send notification
                    $user = auth()->user();
                    $user->notify(new InvoicePaid($user));
                    return redirect(route('dashboard'))->with('message', 'Your email has been activated successfully');
                    break;
                case ('Failed'):
                    $transaction->update([
                        'invoice_status' => $payment_data['Data']['InvoiceTransactions'][0]['TransactionStatus'],
                        'invoice_reference' => $payment_data['Data']['InvoiceReference'],
                        'created_date' => $payment_data['Data']['CreatedDate'],
                        'expiry_date' => $payment_data['Data']['ExpiryDate'],
                        'expiry_time' => $payment_data['Data']['ExpiryTime'],
                        'invoice_value' => $payment_data['Data']['InvoiceValue'],
                        'invoice_display_value' => $payment_data['Data']['InvoiceDisplayValue'],
                    ]);
                    auth()->logout();
                    return redirect(route('login'))->with('message', 'Your email not activated');
                    break;
            }
        } else {
            $transaction->update([
                'invoice_reference' => $payment_data['Data']['InvoiceReference'],
                'created_date' => $payment_data['Data']['CreatedDate'],
                'expiry_date' => $payment_data['Data']['ExpiryDate'],
                'expiry_time' => $payment_data['Data']['ExpiryTime'],
                'invoice_value' => $payment_data['Data']['InvoiceValue'],
                'invoice_display_value' => $payment_data['Data']['InvoiceDisplayValue'],
            ]);
        }
    }


    //call this function when payment status is success
    public function callback(Request $request)
    {
        $data = [
            'key' => $request->paymentId,
            'KeyType' => 'paymentId'
        ];
        $payment_data = $this->fatorahService->getStatus($data);
        //    dd($payment_data);

        /*
        update on transaction table
      */
        $invoice_id = $payment_data['Data']['InvoiceId'];
        $transaction = Transaction::where('invoice_id', $invoice_id)->first();
        $transaction->update([

            'invoice_status' => $payment_data['Data']['InvoiceStatus'],
            'invoice_reference' => $payment_data['Data']['InvoiceReference'],
            'created_date' => $payment_data['Data']['CreatedDate'],
            'expiry_date' => $payment_data['Data']['ExpiryDate'],
            'expiry_time' => $payment_data['Data']['ExpiryTime'],
            'invoice_value' => $payment_data['Data']['InvoiceValue'],
            'invoice_display_value' => $payment_data['Data']['InvoiceDisplayValue'],
        ]);
        // send notification
        $user = auth()->user();
        $user->notify(new InvoicePaid($user));
        return redirect(route('dashboard'))->with('message', 'Your email has been activated successfully');
    }

    //call this function when payment status is faild
    public function error()
    {
        auth()->logout();
        return redirect(route('login'))->with('message', 'Your email not activated');
    }
}
