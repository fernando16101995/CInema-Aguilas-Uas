<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class StripeTestController extends Controller
{
    public function showForm()
    {
        $stripeKey = env('STRIPE_KEY');
        return view('stripe-test', compact('stripeKey'));
    }

    public function processPayment(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $charge = Charge::create([
                'amount' => 10000, // 100 pesos en centavos
                'currency' => 'mxn',
                'source' => $request->stripeToken,
                'description' => 'Suscripción 1 mes',
            ]);
            $user = Auth::user();
            if ($user instanceof \App\Models\User) {
                $user->is_subscribed = true;
                $user->subscription_expires_at = Carbon::now()->addDays(30);
                $user->save();
            }
            return back()->with('success', '¡Suscripción activa por 1 mes!');
        } catch (\Exception $e) {
            Log::error('Stripe error: ' . $e->getMessage());
            return back()->with('error', 'Error en el pago: ' . $e->getMessage());
        }
    }
}
