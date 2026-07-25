<?php

namespace Pterodactyl\Http\Requests\Admin\Kroxy;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class KroxyRequest extends AdminFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'kroxy:logo' => ['required', 'string', 'regex:/^(https?:\/\/[^\s]+|\/[^\s]*)$/i'],
            'kroxy:logoLight' => 'required|string',
            'kroxy:fullLogo' => 'required|in:true,false',
            'kroxy:logoHeight' => 'required|numeric',
            'kroxy:discord' => 'nullable|numeric',
            'kroxy:support' => 'nullable|string|url',
        ];
    }
}