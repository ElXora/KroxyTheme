<?php

namespace Pterodactyl\Http\Controllers\Admin\Kroxy;

use Illuminate\View\View;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Kroxy\KroxyLayoutRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class KroxyLayoutController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private SettingsRepositoryInterface $settings,
        private ViewFactory $view
    ) {}

    public function index(): View
    {
        return $this->view->make('admin.kroxy.layout', [
            'layout' => $this->settings->get('settings::kroxy:layout', 1),
            'searchComponent' => $this->settings->get('settings::kroxy:searchComponent', 1),
            'logoPosition' => $this->settings->get('settings::kroxy:logoPosition', 1),
            'socialPosition' => $this->settings->get('settings::kroxy:socialPosition', 1),
            'loginLayout' => $this->settings->get('settings::kroxy:loginLayout', 1),
        ]);
    }

    public function store(KroxyLayoutRequest $request)
    {
        foreach ($request->normalize() as $key => $value) {
            $this->settings->set('settings::' . $key, $value);
        }
        $this->alert->success('Theme settings have been updated successfully.')->flash();
        return redirect()->route('admin.kroxy.layout');
    }
}