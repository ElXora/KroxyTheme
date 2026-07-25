<?php

namespace Pterodactyl\Http\Requests\Admin\Kroxy;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class KroxyLayoutRequest extends AdminFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'kroxy:layout' => 'required|numeric',
            'kroxy:searchComponent' => 'required|numeric',

            'kroxy:logoPosition' => 'required|numeric',
            'kroxy:socialPosition' => 'required|numeric',
            'kroxy:loginLayout' => 'required|numeric',
        ];
    }
}