<?php

namespace Pterodactyl\Http\Requests\Admin\Kroxy;

use Pterodactyl\Traits\Helpers\AvailableLanguages;
use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class KroxyAdvancedRequest extends AdminFormRequest
{
    use AvailableLanguages;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'kroxy:profileType' => 'required|string',
            'kroxy:modeToggler' => 'required|in:true,false',
            'kroxy:langSwitch' => 'required|in:true,false',
            'kroxy:defaultLang' => 'required|string|in:' . implode(',', array_keys($this->getAvailableLanguages())),
            'kroxy:languageOptions' => 'required|array|min:1',
            'kroxy:ipFlag' => 'required|in:true,false',
            'kroxy:lowResourcesAlert' => 'required|in:true,false',
            'kroxy:alertLink' => 'nullable|url|max:255',
            'kroxy:dashboardPage' => 'required|in:true,false',
            'kroxy:registration' => 'required|in:true,false',
            'kroxy:defaultMode' => 'required|in:darkmode,lightmode',
            'kroxy:copyright' => 'required|string|max:255',
        ];
    }
}