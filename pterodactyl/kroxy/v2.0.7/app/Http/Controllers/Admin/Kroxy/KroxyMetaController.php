<?php

namespace Pterodactyl\Http\Controllers\Admin\Kroxy;

use Illuminate\View\View;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Kroxy\KroxyMetaRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class KroxyMetaController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private SettingsRepositoryInterface $settings,
        private ViewFactory $view
    ) {}

    public function index(): View
    {
        return $this->view->make('admin.kroxy.meta', [
            'meta_color' => $this->settings->get('settings::kroxy:meta_color', '#4a35cf'),
            'meta_title' => $this->settings->get('settings::kroxy:meta_title', 'Pterodactyl Panel'),
            'meta_description' => $this->settings->get('settings::kroxy:meta_description', 'Our official Pterodactyl panel'),
            'meta_image' => $this->settings->get('settings::kroxy:meta_image', '/kroxy/meta-tags.png'),
            'meta_favicon' => $this->settings->get('settings::kroxy:meta_favicon', '/kroxy/Kroxy.png'),
        ]);
    }

    public function store(KroxyMetaRequest $request)
    {
        foreach ($request->normalize() as $key => $value) {
            $this->settings->set('settings::' . $key, $value);
        }
        $this->alert->success('Theme settings have been updated successfully.')->flash();
        return redirect()->route('admin.kroxy.meta');
    }
}