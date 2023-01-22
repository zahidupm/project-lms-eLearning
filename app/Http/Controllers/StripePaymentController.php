<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\StripeClient;
use function Livewire\invade;

class StripePaymentController extends Controller
{
    public function stripePayment(Request $request) {

        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'card_expiry_date' => 'required',
            'card_ccv' => 'required',
            'amount' => 'required',
            'invoice_id' => 'required|integer',
        ]);

        if($validator->fails()) {
            flash()->addWarning('PLease fill all the fields');
            return redirect()->back();
        } else {
            $stripe = new StripeClient(env('STRIPE_SECRET'));

            $token = $stripe->tokens->create([
               'card' => [
                   'number' => $request->card_no,
                   'exp_month' => explode('/', $request->card_expiry_date)[0],
                   'exp_year' => explode('/', $request->card_expiry_date)[1],
                   'cvc' => $request->card_ccv,
               ]
            ]);

            $charge = $stripe->charges->create([
                'amount' => intval($request->amount * 100),
                'currency' => 'usd',
                'description' => 'Example charge',
                'source' => $token->id,
            ]);

            Payment::create([
               'amount' => $request->amount,
               'invoice_id' => $request->invoice_id,
            ]);

            flash()->addSuccess('Payment successfull');
            return redirect()->back();
        }

    }
}
