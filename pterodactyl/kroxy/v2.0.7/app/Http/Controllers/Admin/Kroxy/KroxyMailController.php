<?php

namespace Pterodactyl\Http\Controllers\Admin\Kroxy;

use Illuminate\View\View;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Kroxy\KroxyMailRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class KroxyMailController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private SettingsRepositoryInterface $settings,
        private ViewFactory $view
    ) {}

    public function index(): View
    {
        return $this->view->make('admin.kroxy.mail', [
            'mail_color' => $this->settings->get('settings::kroxy:mail_color', '#4a35cf'),
            'mail_backgroundColor' => $this->settings->get('settings::kroxy:mail_backgroundColor', '#F5F5FF'),
            'mail_logo' => $this->settings->get('settings::kroxy:mail_logo', 'https://kroxy.eu.cc/kroxy.png'),
            'mail_logoFull' => $this->settings->get('settings::kroxy:mail_logoFull', false),
            'mail_mode' => $this->settings->get('settings::kroxy:mail_mode', 'light'),
            'mail_discord' => $this->settings->get('settings::kroxy:mail_discord', 'https://kroxy.eu.cc/discord'),
            'mail_twitter' => $this->settings->get('settings::kroxy:mail_twitter', 'https://x.com'),
            'mail_facebook' => $this->settings->get('settings::kroxy:mail_facebook', 'https://facebook.com'),
            'mail_instagram' => $this->settings->get('settings::kroxy:mail_instagram', 'https://instagram.com'),
            'mail_linkedin' => $this->settings->get('settings::kroxy:mail_linkedin', 'https://linkedin.com'),
            'mail_youtube' => $this->settings->get('settings::kroxy:mail_youtube', 'https://youtube.com'),
            'mail_status' => $this->settings->get('settings::kroxy:mail_status', 'https://kroxy.eu.cc/status'),
            'mail_billing' => $this->settings->get('settings::kroxy:mail_billing', 'https://kroxy.eu.cc/billing'),
            'mail_support' => $this->settings->get('settings::kroxy:mail_support', 'https://kroxy.eu.cc/support'),
        ]);
    }

    public function store(KroxyMailRequest $request)
    {
        foreach ($request->normalize() as $key => $value) {
            $this->settings->set('settings::' . $key, $value);
        }
        $this->alert->success('Theme settings have been updated successfully.')->flash();
        return redirect()->route('admin.kroxy.mail');
    }
}