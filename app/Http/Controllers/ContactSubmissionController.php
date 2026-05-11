<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactSubmissionRequest;
use App\Models\ContactSubmission;
use Illuminate\Http\JsonResponse;

class ContactSubmissionController extends Controller
{
    public function store(StoreContactSubmissionRequest $request): JsonResponse
    {
        $submission = ContactSubmission::create([
            ...$request->validated(),
            'status' => ContactSubmission::STATUS_NEW,
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 512),
        ]);

        return response()->json([
            'ok' => true,
            'id' => $submission->id,
            'message' => "Message sent! We'll be in touch shortly.",
        ]);
    }
}
