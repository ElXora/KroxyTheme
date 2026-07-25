<?php

namespace Pterodactyl\Http\Requests\Admin\Kroxy;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class KroxyComponentsRequest extends AdminFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'kroxy:serverRow' => 'required|numeric',

            'kroxy:statsCards' => 'required|numeric',
            'kroxy:sideGraphs' => 'required|numeric',
            'kroxy:graphs' => 'required|numeric',
        ];
    }
}