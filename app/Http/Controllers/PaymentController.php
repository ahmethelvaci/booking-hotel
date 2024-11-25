<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PaymentService;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\PaymentsCollection;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;

class PaymentController extends Controller
{
    public function __construct(protected PaymentService $service)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = $this->service->listPayments();
        
        if ($payments->total() > 0 && $payments->first() instanceof Model) {
            return new PaymentsCollection($payments);
        }

        return response()->json($payments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $payment = $this->service->createPayment($request->validated());
        
        if ($payment instanceof Model) {
            return new PaymentResource($payment);
        }

        return response()->json(['data' => $payment]);
    }
}
