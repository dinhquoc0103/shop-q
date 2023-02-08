<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailOrderComplete extends Mailable
{
    use Queueable, SerializesModels;

    protected $purchaseOrderData;
    protected $products;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($purchaseOrder, $products)
    {
        $this->purchaseOrder = $purchaseOrder;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Đặt Hàng Thành Công")
                    ->view("emails.emailOrderComplete")->with([
                            "purchaseOrder" => $this->purchaseOrder,
                            "products" => $this->products,
                        ]);
    }
}