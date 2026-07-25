<?php

namespace Pterodactyl\Http\Controllers\Admin\Kroxy;

use Illuminate\View\View;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Kroxy\KroxyAdvancedRequest;
use Pterodactyl\Http\Requests\Admin\Kroxy\KroxyPresetRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;
use Pterodactyl\Models\Setting;
use Pterodactyl\Traits\Helpers\AvailableLanguages;

class KroxyAdvancedController extends Controller
{
    use AvailableLanguages;

    public function __construct(
        private AlertsMessageBag $alert,
        private SettingsRepositoryInterface $settings,
        private ViewFactory $view
    ) {}

    public function index(): View
    {
        $kroxySettings = Setting::query()
            ->where('key', 'like', 'settings::kroxy:%')
            ->get()
            ->mapWithKeys(function (Setting $setting) {
                $shortKey = preg_replace('/^settings::kroxy:/', '', $setting->key);
                return [$shortKey => $setting->value];
            })
            ->toArray();

        return $this->view->make('admin.kroxy.advanced', [
            'profileType' => $this->settings->get('settings::kroxy:profileType', 'gravatar'),
            'modeToggler' => $this->settings->get('settings::kroxy:modeToggler', true),
            'langSwitch' => $this->settings->get('settings::kroxy:langSwitch', true),
            'defaultLang' => $this->settings->get('settings::kroxy:defaultLang', 'en'),
            'languageOptions' => $this->settings->get('settings::kroxy:languageOptions', '[{"key":"en","name":"English"}]'),
            'ipFlag' => $this->settings->get('settings::kroxy:ipFlag', true),
            'lowResourcesAlert' => $this->settings->get('settings::kroxy:lowResourcesAlert', false),
            'alertLink' => $this->settings->get('settings::kroxy:alertLink', ''),
            'dashboardPage' => $this->settings->get('settings::kroxy:dashboardPage', true),
            'registration' => $this->settings->get('settings::kroxy:registration', false),
            'defaultMode' => $this->settings->get('settings::kroxy:defaultMode', 'darkmode'),
            'copyright' => $this->settings->get('settings::kroxy:copyright', 'Designed by Weijers.one'),
            'kroxySettings' => $kroxySettings,
            'languages' => $this->getAvailableLanguages(false),
        ]);
    }

    public function preset(KroxyPresetRequest $request)
    {
        $validated = $request->validated();
        unset($validated['preset_json']);
        foreach ($validated as $key => $value) {
            $this->settings->set("settings::kroxy:{$key}", $value);
        }
        $this->alert->success('Preset imported and applied successfully.')->flash();
        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'applied' => $validated]);
        }
        return redirect()->route('admin.kroxy.advanced');
    }

    public function store(KroxyAdvancedRequest $request)
    {
        $data = $request->validated();
        if (isset($data['kroxy:languageOptions']) && is_array($data['kroxy:languageOptions'])) {
            $languages = $this->getAvailableLanguages();
            $languageOptions = [];
            foreach ($data['kroxy:languageOptions'] as $key) {
                if (is_string($key) && isset($languages[$key])) {
                    $languageOptions[] = ['key' => $key, 'name' => $languages[$key]];
                }
            }
            $data['kroxy:languageOptions'] = json_encode($languageOptions);
        }
        foreach ($data as $key => $value) {
            $this->settings->set('settings::' . $key, $value);
        }
        $this->alert->success('Theme settings have been updated successfully.')->flash();
        return redirect()->route('admin.kroxy.advanced');
    }
}