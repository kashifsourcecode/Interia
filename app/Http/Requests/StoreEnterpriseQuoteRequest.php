<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnterpriseQuoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:191'],
            'phone' => ['nullable', 'string', 'max:64'],
            'job_title' => ['nullable', 'string', 'max:191'],

            'company' => ['required', 'string', 'max:191'],
            'website' => ['nullable', 'string', 'max:191'],
            'industry' => ['nullable', 'string', 'max:120'],

            'employee_count' => ['nullable', 'string', 'max:64'],
            'endpoint_count' => ['nullable', 'string', 'max:64'],
            'location_count' => ['nullable', 'string', 'max:64'],

            'current_it_setup' => ['nullable', 'string', 'max:120'],

            'cloud_platforms' => ['nullable', 'array'],
            'cloud_platforms.*' => ['string', 'max:64'],

            'services_needed' => ['nullable', 'array'],
            'services_needed.*' => ['string', 'max:120'],

            'compliance_needs' => ['nullable', 'array'],
            'compliance_needs.*' => ['string', 'max:64'],

            'budget_range' => ['nullable', 'string', 'max:64'],
            'timeline' => ['nullable', 'string', 'max:64'],
            'preferred_contact' => ['nullable', 'string', 'max:64'],

            'details' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
