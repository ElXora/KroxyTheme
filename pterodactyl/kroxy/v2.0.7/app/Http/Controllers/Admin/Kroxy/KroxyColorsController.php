<?php

namespace Pterodactyl\Http\Controllers\Admin\Kroxy;

use Illuminate\View\View;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Kroxy\KroxyColorsRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class KroxyColorsController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private SettingsRepositoryInterface $settings,
        private ViewFactory $view
    ) {}

    public function index(): View
    {
        return $this->view->make('admin.kroxy.colors', [
            'primary' => $this->settings->get('settings::kroxy:primary', '#FFFFFF'),
            'successText' => $this->settings->get('settings::kroxy:successText', '#DCEEDC'),
            'successBorder' => $this->settings->get('settings::kroxy:successBorder', '#4A9D4E'),
            'successBackground' => $this->settings->get('settings::kroxy:successBackground', '#2F6B32'),
            'dangerText' => $this->settings->get('settings::kroxy:dangerText', '#F5D9D9'),
            'dangerBorder' => $this->settings->get('settings::kroxy:dangerBorder', '#B24545'),
            'dangerBackground' => $this->settings->get('settings::kroxy:dangerBackground', '#7A2A2A'),
            'secondaryText' => $this->settings->get('settings::kroxy:secondaryText', '#C9C9C9'),
            'secondaryBorder' => $this->settings->get('settings::kroxy:secondaryBorder', '#3A3A3A'),
            'secondaryBackground' => $this->settings->get('settings::kroxy:secondaryBackground', '#242424'),
            'gray50' => $this->settings->get('settings::kroxy:gray50', '#FAFAFA'),
            'gray100' => $this->settings->get('settings::kroxy:gray100', '#E8E8E8'),
            'gray200' => $this->settings->get('settings::kroxy:gray200', '#C9C9C9'),
            'gray300' => $this->settings->get('settings::kroxy:gray300', '#9C9C9C'),
            'gray400' => $this->settings->get('settings::kroxy:gray400', '#6E6E6E'),
            'gray500' => $this->settings->get('settings::kroxy:gray500', '#3A3A3A'),
            'gray600' => $this->settings->get('settings::kroxy:gray600', '#242424'),
            'gray700' => $this->settings->get('settings::kroxy:gray700', '#181818'),
            'gray800' => $this->settings->get('settings::kroxy:gray800', '#101010'),
            'gray900' => $this->settings->get('settings::kroxy:gray900', '#000000'),
            'lightmode_primary' => $this->settings->get('settings::kroxy:lightmode_primary', '#0A0A0A'),
            'lightmode_successText' => $this->settings->get('settings::kroxy:lightmode_successText', '#DCEEDC'),
            'lightmode_successBorder' => $this->settings->get('settings::kroxy:lightmode_successBorder', '#4A9D4E'),
            'lightmode_successBackground' => $this->settings->get('settings::kroxy:lightmode_successBackground', '#2F6B32'),
            'lightmode_dangerText' => $this->settings->get('settings::kroxy:lightmode_dangerText', '#F5D9D9'),
            'lightmode_dangerBorder' => $this->settings->get('settings::kroxy:lightmode_dangerBorder', '#B24545'),
            'lightmode_dangerBackground' => $this->settings->get('settings::kroxy:lightmode_dangerBackground', '#7A2A2A'),
            'lightmode_secondaryText' => $this->settings->get('settings::kroxy:lightmode_secondaryText', '#3D3D3D'),
            'lightmode_secondaryBorder' => $this->settings->get('settings::kroxy:lightmode_secondaryBorder', '#D0D0D0'),
            'lightmode_secondaryBackground' => $this->settings->get('settings::kroxy:lightmode_secondaryBackground', '#EDEDED'),
            'lightmode_gray50' => $this->settings->get('settings::kroxy:lightmode_gray50', '#0A0A0A'),
            'lightmode_gray100' => $this->settings->get('settings::kroxy:lightmode_gray100', '#1E1E1E'),
            'lightmode_gray200' => $this->settings->get('settings::kroxy:lightmode_gray200', '#3D3D3D'),
            'lightmode_gray300' => $this->settings->get('settings::kroxy:lightmode_gray300', '#606060'),
            'lightmode_gray400' => $this->settings->get('settings::kroxy:lightmode_gray400', '#8A8A8A'),
            'lightmode_gray500' => $this->settings->get('settings::kroxy:lightmode_gray500', '#C4C4C4'),
            'lightmode_gray600' => $this->settings->get('settings::kroxy:lightmode_gray600', '#DEDEDE'),
            'lightmode_gray700' => $this->settings->get('settings::kroxy:lightmode_gray700', '#EFEFEF'),
            'lightmode_gray800' => $this->settings->get('settings::kroxy:lightmode_gray800', '#F7F7F7'),
            'lightmode_gray900' => $this->settings->get('settings::kroxy:lightmode_gray900', '#FFFFFF'),
        ]);
    }

    public function store(KroxyColorsRequest $request)
    {
        foreach ($request->normalize() as $key => $value) {
            $this->settings->set('settings::' . $key, $value);
        }
        $this->alert->success('Theme settings have been updated successfully.')->flash();
        return redirect()->route('admin.kroxy.colors');
    }
}