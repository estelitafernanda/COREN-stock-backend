<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MovementNotification extends Notification
{
    use Queueable;

    protected $movement;

    public function __construct($movement)
    {
        $this->movement = $movement;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; 
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Nova Movimentação de Produto')
                    ->line('Uma nova movimentação foi registrada:')
                    ->line('Produto: ' . $this->movement->product->nameProduct)
                    ->line('Quantidade: ' . $this->movement->quantity)
                    ->line('Data: ' . $this->movement->movementDate)
                    ->action('Ver Movimentação', url('/movements/' . $this->movement->idMovement))
                    ->line('Obrigado por utilizar nosso sistema!');
    }

    public function toArray($notifiable)
    {
        return [
            'movement_id' => $this->movement->idMovement,
            'product_name' => $this->movement->product->nameProduct,
            'quantity' => $this->movement->quantity,
            'movement_date' => $this->movement->movementDate,
        ];
    }
}

