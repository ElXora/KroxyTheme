<?php

namespace Pterodactyl\Http\Requests\Admin\Kroxy;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class KroxyAnnouncementRequest extends AdminFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'kroxy:announcement' => 'required|in:false,true',
            'kroxy:announcementColor' => 'required|string',
            'kroxy:announcementIcon' => 'required|string',
            'kroxy:announcementMessage' => 'nullable|string',
            'kroxy:announcementCta' => 'required|in:false,true',
            'kroxy:announcementCtaTitle' => 'required|string',
            'kroxy:announcementCtaLink' => 'required|string',
            'kroxy:announcementDismissable' => 'required|in:false,true',
        ];
    }
}