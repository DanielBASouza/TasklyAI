<?php

namespace App\Notifications;

use App\Notifications\Channels\WhatsAppChannel;
use App\Notifications\Channels\WhatsAppMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ScheduleListNotification extends Notification
{
    use Queueable;

    private $message = "Olá, {{name}}!

📅 Sua Agenda Atualizada

Aqui estão seus compromissos:

{{tasks}}

🔔 Lembre-se: você pode adicionar, alterar ou remover compromissos diretamente pelo comando !agenda.

Precisa de ajuda com algo? 😊";
    protected $tasks = [];
    protected $name;

    /**
     * Create a new notification instance.
     */
    public function __construct($tasks, $name)
    {
        $this->tasks = $tasks->reduce(function ($carry, $item) {
            return "{$carry}\n🕒 {$item->description} às {$item->due_at->format('H:i')} no dia {$item->due_at->format('d/m')}";
        });
        $this->name = $name;

        $this->message = str_replace("{{name}}", $this->name, $this->message);
        $this->message = str_replace("{{tasks}}", $this->tasks??'Você não possui tarefas agendadas!', $this->message);
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
    public function toWhatsApp($notification): WhatsAppMessage
    {
        return (new WhatsAppMessage)
            ->content($this->message);
    }
}
