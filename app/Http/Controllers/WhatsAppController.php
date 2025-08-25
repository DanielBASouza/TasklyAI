<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewUserNotification;
use App\Services\StripeServices;
use App\Services\UserServices;
use App\Services\ConversationalServices;
use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function __construct(protected UserServices $userServices, protected StripeServices $stripeServices, protected ConversationalServices $conversationalServices)
    {

    }
    public function newMessage(Request $request)
    {
        $phone = "+" . $request->post('WaId');
        $user = User::where('phone', $phone)->first();

        if (!$user) {
            $user = $this->userServices->store($request->all());
        }

        if (!$user->subscribed()) {
            $this->stripeServices->payment($user);
        }

        $user->last_whatsapp_at = now();
        $user->save();

        $this->conversationalServices->setUser($user);
        $this->conversationalServices->handleIncomingMessage($request->all());
    }
}
