<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use Livewire\Component;
use Stripe\StripeClient;

class InvoiceEdit extends Component
{
    public $invoice_id;
    public $invoice;
    public $name;
    public $price;
    public $quantity;
    public $total;
    public $enableAddItem = false;


    public function mount() {
        $this->invoice = Invoice::findOrFail($this->invoice_id);
    }

    public function render()
    {
        return view('livewire.invoice-edit');
    }

    public function addNewItem() {
        $this->enableAddItem = !$this->enableAddItem;
    }

    public function saveNewItem() {
        InvoiceItem::create([
           'name' => $this->name,
           'price' => $this->price,
           'quantity' => $this->quantity,
           'invoice_id' => $this->invoice_id,
            'total' => $this->total,
        ]);

        $this->name = '';
        $this->price = '';
        $this->quantity = '';

        $this->addNewItem();

        flash()->addSuccess('Added!');
        return redirect(route('invoice-show', $this->invoice_id));
    }

    public function refund($payment_id) {
        $payment = Payment::findOrFail($payment_id);
        if(strlen($payment->transaction_id) === 8) {
            $payment->delete();
            flash()->addSuccess('Cash Payment refunded');
        } else {
            $stripe = new StripeClient(env('STRIPE_SECRET'));
            $stripe->refunds->create([
               'charge' => $payment->transaction_id,
            ]);
            $payment->delete();
            flash()->addSuccess('Stripe payment refunded');
        }

        return redirect(route('invoice-show', $this->invoice_id));
    }
}
