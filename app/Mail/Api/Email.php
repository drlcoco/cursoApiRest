<?php

namespace App\Mail\Api;

use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Providers\AppServiceProvider;

class Email extends Mailable
{
    use Queueable, SerializesModels;

     /**
     * The order instance.
     *
     * @var \App\Models\User
     */
     /**
     * The order instance.
     *
     * @var \App\Models\Product
     */
    public $user;
    public $product;
    public $products = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Product $products)
    {
        $this->user = $user;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = app('data');
        return $this->view('emails.email');
    }
}
