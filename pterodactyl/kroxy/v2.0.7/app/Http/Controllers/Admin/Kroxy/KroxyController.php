<?php

namespace Pterodactyl\Http\Controllers\Admin\Kroxy;

use Illuminate\View\View;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Kroxy\KroxyRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class KroxyController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private SettingsRepositoryInterface $settings,
        private ViewFactory $view
    ) {}

    public function index(): View
    {
        return $this->view->make('admin.kroxy.index', [
            'logo' => $this->settings->get('settings::kroxy:logo', '/kroxy/Kroxy.png'),
            'logoLight' => $this->settings->get('settings::kroxy:logoLight', '/kroxy/Kroxy.png'),
            'fullLogo' => $this->settings->get('settings::kroxy:fullLogo', false),
            'logoHeight' => $this->settings->get('settings::kroxy:logoHeight', '32'),
            'discord' => $this->settings->get('settings::kroxy:discord', '715281172422197300'),
            'support' => $this->settings->get('settings::kroxy:support', 'https://discord.gg/geCjrRbAwC'),
        ]);
    }

    public function store(KroxyRequest $request)
    {
        foreach ($request->normalize() as $key => $value) {
            $this->settings->set('settings::' . $key, $value);
        }
        $this->alert->success('Theme settings have been updated successfully.')->flash();
        return redirect()->route('admin.kroxy');
    }
}