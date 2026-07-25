<?php

namespace Pterodactyl\Http\Controllers\Admin\Kroxy;

use Illuminate\View\View;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Kroxy\KroxyAnnouncementRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class KroxyAnnouncementController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private SettingsRepositoryInterface $settings,
        private ViewFactory $view
    ) {}

    public function index(): View
    {
        return $this->view->make('admin.kroxy.announcement', [
            'announcement' => $this->settings->get('settings::kroxy:announcement', false),
            'announcementColor' => $this->settings->get('settings::kroxy:announcementColor', '#16aaaa'),
            'announcementIcon' => $this->settings->get('settings::kroxy:announcementIcon', 'megaphone'),
            'announcementMessage' => $this->settings->get('settings::kroxy:announcementMessage', 'We have a brand new game panel design!'),
            'announcementCta' => $this->settings->get('settings::kroxy:announcementCta', false),
            'announcementCtaTitle' => $this->settings->get('settings::kroxy:announcementCtaTitle', 'Buy now!'),
            'announcementCtaLink' => $this->settings->get('settings::kroxy:announcementCtaLink', '/'),
            'announcementDismissable' => $this->settings->get('settings::kroxy:announcementDismissable', false),
        ]);
    }

    public function store(KroxyAnnouncementRequest $request)
    {
        foreach ($request->normalize() as $key => $value) {
            $this->settings->set('settings::' . $key, $value);
        }
        $this->alert->success('Theme settings have been updated successfully.')->flash();
        return redirect()->route('admin.kroxy.announcement');
    }
}