<?php

namespace Pterodactyl\Http\Controllers\Admin\Kroxy;

use Illuminate\View\View;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Kroxy\KroxyComponentsRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class KroxyComponentsController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private SettingsRepositoryInterface $settings,
        private ViewFactory $view
    ) {}

    public function index(): View
    {
        return $this->view->make('admin.kroxy.components', [
            'serverRow' => $this->settings->get('settings::kroxy:serverRow', 1),
            'statsCards' => $this->settings->get('settings::kroxy:statsCards', 2),
            'sideGraphs' => $this->settings->get('settings::kroxy:sideGraphs', 2),
            'graphs' => $this->settings->get('settings::kroxy:graphs', 2),
        ]);
    }

    public function store(KroxyComponentsRequest $request)
    {
        foreach ($request->normalize() as $key => $value) {
            $this->settings->set('settings::' . $key, $value);
        }
        $this->alert->success('Theme settings have been updated successfully.')->flash();
        return redirect()->route('admin.kroxy.components');
    }
}