<?php

namespace Pterodactyl\Http\Requests\Admin\Kroxy;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class KroxyStylingRequest extends AdminFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'kroxy:pageTitle' => 'required|in:true,false',

            'kroxy:background' => 'required|in:true,false',
            'kroxy:backgroundImage' => 'nullable|string',
            'kroxy:backgroundImageLight' => 'nullable|string',
            'kroxy:loginBackground' => 'nullable|string',
            'kroxy:backgroundFaded' => 'nullable|string',

            'kroxy:backdrop' => 'required|in:true,false',
            'kroxy:backdropPercentage' => 'required|numeric',
            
            'kroxy:radiusInput' => 'required|numeric',
            'kroxy:borderInput' => 'required|in:true,false',
            'kroxy:radiusBox' => 'required|numeric',

            'kroxy:flashMessage' => 'required|numeric',

            'kroxy:font' => 'required|string',
            'kroxy:icon' => 'required|string',
        ];
    }
}