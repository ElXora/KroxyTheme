<?php

namespace Pterodactyl\Http\Controllers\Admin\Kroxy;

use Illuminate\View\View;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Kroxy\KroxySocialRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class KroxySocialController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private SettingsRepositoryInterface $settings,
        private ViewFactory $view
    ) {}

    public function index(): View
    {
        return $this->view->make('admin.kroxy.social', [
            'socials' => json_decode($this->settings->get('settings::kroxy:socials', '[]'), true),
            'socialButtons' => $this->settings->get('settings::kroxy:socialButtons', false),
            'discordBox' => $this->settings->get('settings::kroxy:discordBox', true),
        ]);
    }

    public function store(KroxySocialRequest $request)
    {
        foreach ($request->normalize() as $key => $value) {
            if (is_array($value)) {
                $value = array_filter($value, fn($item) => $item !== '' && $item !== null);
                if (empty($value)) {
                    continue;
                }
                $value = json_encode($value);
            } else {
                if ($value === '' || $value === null) {
                    continue;
                }
            }
            $this->settings->set('settings::' . $key, $value);
        }
        $this->alert->success('Theme settings have been updated successfully.')->flash();
        return redirect()->route('admin.kroxy.social');
    }
}