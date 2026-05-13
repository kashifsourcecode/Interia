<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnterpriseQuoteRequest;
use App\Models\EnterpriseQuoteRequest;
use Illuminate\Http\JsonResponse;

class EnterpriseQuoteController extends Controller
{
    public function store(StoreEnterpriseQuoteRequest $request): JsonResponse
    {
        $submission = EnterpriseQuoteRequest::create([
            ...$request->validated(),
            'status' => EnterpriseQuoteRequest::STATUS_NEW,
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 512),
        ]);

        return response()->json([
            'ok' => true,
            'id' => $submission->id,
            'message' => 'Quote request received. Our enterprise team will reach out within one business day.',
        ]);
    }
}
