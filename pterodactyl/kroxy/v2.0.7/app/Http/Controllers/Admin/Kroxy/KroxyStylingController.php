<?php

namespace Pterodactyl\Http\Controllers\Admin\Kroxy;

use Illuminate\View\View;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Kroxy\KroxyStylingRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class KroxyStylingController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private SettingsRepositoryInterface $settings,
        private ViewFactory $view
    ) {}

    public function index(): View
    {
        return $this->view->make('admin.kroxy.styling', [
            'pageTitle' => $this->settings->get('settings::kroxy:pageTitle', true),
            'background' => $this->settings->get('settings::kroxy:background', true),
            'backgroundImage' => $this->settings->get('settings::kroxy:backgroundImage', ''),
            'backgroundImageLight' => $this->settings->get('settings::kroxy:backgroundImageLight', ''),
            'loginBackground' => $this->settings->get('settings::kroxy:loginBackground', '/kroxy/background-login.png'),
            'backgroundFaded' => $this->settings->get('settings::kroxy:backgroundFaded', 'default'),
            'backdrop' => $this->settings->get('settings::kroxy:backdrop', false),
            'backdropPercentage' => $this->settings->get('settings::kroxy:backdropPercentage', 100),
            'radiusInput' => $this->settings->get('settings::kroxy:radiusInput', 7),
            'radiusBox' => $this->settings->get('settings::kroxy:radiusBox', 10),
            'borderInput' => $this->settings->get('settings::kroxy:borderInput', true),
            'flashMessage' => $this->settings->get('settings::kroxy:flashMessage', 1),
            'font' => $this->settings->get('settings::kroxy:font', 'default'),
            'icon' => $this->settings->get('settings::kroxy:icon', 'heroicons'),
        ]);
    }

    public function store(KroxyStylingRequest $request)
    {
        foreach ($request->normalize() as $key => $value) {
            $this->settings->set('settings::' . $key, $value);
        }
        $this->alert->success('Theme settings have been updated successfully.')->flash();
        return redirect()->route('admin.kroxy.styling');
    }
}