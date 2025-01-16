<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LowStockNotification extends Notification
{
    use Queueable;

    protected $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Estoque Baixo de Produto')
                    ->line('O estoque do produto está baixo:')
                    ->line('Produto: ' . $this->product->nameProduct)
                    ->line('Estoque Atual: ' . $this->product->currentQuantity)
                    ->line('Quantidade Mínima: ' . $this->product->minQuantity)
                    ->action('Reabastecer Estoque', url('/products/' . $this->product->code))
                    ->line('Por favor, reabasteça o estoque o mais rápido possível!');
    }

    public function toArray($notifiable)
    {
        return [
            'product_code' => $this->product->code,
            'product_name' => $this->product->nameProduct,
            'current_quantity' => $this->product->currentQuantity,
            'min_quantity' => $this->product->minQuantity,
        ];
    }
}

