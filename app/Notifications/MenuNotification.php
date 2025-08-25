<?php

namespace App\Notifications;

use App\Notifications\Channels\WhatsAppChannel;
use App\Notifications\Channels\WhatsAppMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MenuNotification extends Notification
{
    use Queueable;

    private string $message = "Olá! 😊 Aqui estão as opções disponíveis no nosso sistema para você. É só enviar o comando correspondente:

1️⃣ !menu – Exibe todas as opções disponíveis no sistema.
2️⃣ !agenda – Acesse sua agenda e visualize compromissos importantes.
3️⃣ !insights – Receba análises detalhadas e dicas valiosas sobre suas tarefas dos últimos dias.
4️⃣ !update – Atualize sua tarefa.

Qual opção você gostaria de usar? 🚀";

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [WhatsAppChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toWhatsApp($notification){
        return (new WhatsAppMessage)
            ->content($this->message);
    }
}
