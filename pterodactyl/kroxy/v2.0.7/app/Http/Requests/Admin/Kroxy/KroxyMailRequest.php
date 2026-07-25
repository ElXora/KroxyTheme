<?php

namespace Pterodactyl\Http\Requests\Admin\Kroxy;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class KroxyMailRequest extends AdminFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'kroxy:mail_color' => ['required', 'string', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'kroxy:mail_backgroundColor' => ['required', 'string', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'kroxy:mail_logo' => 'required|string',
            'kroxy:mail_logoFull' => 'required|in:true,false',
            'kroxy:mail_mode' => 'required|string',

            'kroxy:mail_discord' => 'nullable|url',
            'kroxy:mail_twitter' => 'nullable|string|url',
            'kroxy:mail_facebook' => 'nullable|string|url',
            'kroxy:mail_instagram' => 'nullable|string|url',
            'kroxy:mail_linkedin' => 'nullable|string|url',
            'kroxy:mail_youtube' => 'nullable|string|url',

            'kroxy:mail_status' => 'nullable|string|url',
            'kroxy:mail_billing' => 'nullable|string|url',
            'kroxy:mail_support' => 'nullable|string|url',
        ];
    }
}