<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class StripeController extends Controller
{
    public function showForm()
    {
        return view('stripe.form');
    }

    public function processPayment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Suscripción mensual',
                    ],
                    'unit_amount' => 990,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        $user = Auth::user();
        if ($user) {
            $user->suscripcion_activa = true;
            $user->suscripcion_expira = now()->addMonth();
            $user->save();
        }
        return view('stripe.success');
    }

    public function cancel()
    {
        return view('stripe.cancel');
    }
}
