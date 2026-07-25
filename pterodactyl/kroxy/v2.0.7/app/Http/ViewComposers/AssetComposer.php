<?php

namespace Pterodactyl\Http\ViewComposers;

use Illuminate\View\View;
use Pterodactyl\Services\Helpers\AssetHashService;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class AssetComposer
{
    /**
     * AssetComposer constructor.
     */
    public function __construct(private AssetHashService $assetHashService, private SettingsRepositoryInterface $settings)
    {
    }

    /**
     * Provide access to the asset service in the views.
     */
    public function compose(View $view): void
    {
        $view->with('asset', $this->assetHashService);
        $view->with('siteConfiguration', [
            'name' => config('app.name') ?? 'Pterodactyl',
            'kroxy' => [
                /* GENERAL */
                'logo' => $this->settings->get('settings::kroxy:logo', '/kroxy/Kroxy.png'),
                'logoLight' => $this->settings->get('settings::kroxy:logoLight', '/kroxy/KroxyLight.png'),
                'fullLogo' => $this->settings->get('settings::kroxy:fullLogo', false),
                'logoHeight' => $this->settings->get('settings::kroxy:logoHeight', '32'),
                'discord' => $this->settings->get('settings::kroxy:discord', ''),
                'support' => $this->settings->get('settings::kroxy:support', 'https://kroxy.eu.cc/discord'),

                /* ANNOUNCEMENT */
                'announcement' => $this->settings->get('settings::kroxy:announcement', false),
                'announcementColor' => $this->settings->get('settings::kroxy:announcementColor', '#1A1A1A'),
                'announcementIcon' => $this->settings->get('settings::kroxy:announcementIcon', "megaphone"),
                'announcementMessage' => $this->settings->get('settings::kroxy:announcementMessage', 'We have a brand new game panel design!'),
                'announcementCta' => $this->settings->get('settings::kroxy:announcementCta', false),
                'announcementCtaTitle' => $this->settings->get('settings::kroxy:announcementCtaTitle', 'Buy now!'),
                'announcementCtaLink' => $this->settings->get('settings::kroxy:announcementCtaLink', '/'),
                'announcementDismissable' => $this->settings->get('settings::kroxy:announcementDismissable', false),

                /* STYLING */
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

                /* LAYOUTS */
                'layout' => $this->settings->get('settings::kroxy:layout', 1),
                'searchComponent' => $this->settings->get('settings::kroxy:searchComponent', 1),

                'logoPosition' => $this->settings->get('settings::kroxy:logoPosition', 1),
                'socialPosition' => $this->settings->get('settings::kroxy:socialPosition', 1),
                'loginLayout' => $this->settings->get('settings::kroxy:loginLayout', 1),

                /* COMPONENTS */
                'serverRow' => $this->settings->get('settings::kroxy:serverRow', 1),
                'statsCards' => $this->settings->get('settings::kroxy:statsCards', 2),
                'sideGraphs' => $this->settings->get('settings::kroxy:sideGraphs', 2),
                'graphs' => $this->settings->get('settings::kroxy:graphs', 2),

                /* DASHBOARD WIDGETS */
                'dashboardWidgets' => json_decode($this->settings->get('settings::kroxy:dashboardWidgets', '[]'), true),

                /* COLORS DARKMODE */
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

                /* COLORS LIGHTMODE */
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

                /* META DATA */
                'meta_color' => $this->settings->get('settings::kroxy:meta_color', '#0A0A0A'),
                'meta_title' => $this->settings->get('settings::kroxy:meta_title', 'Kroxy Panel'),
                'meta_description' => $this->settings->get('settings::kroxy:meta_description', 'Kroxy — premium game server management panel.'),
                'meta_image' => $this->settings->get('settings::kroxy:meta_image', '/kroxy/meta-tags.png'),
                'meta_favicon' => $this->settings->get('settings::kroxy:meta_favicon', '/kroxy/Kroxy.png'),

                /* EMAIL */
                'mail_color' => $this->settings->get('settings::kroxy:mail_color', '#000000'),
                'mail_backgroundColor' => $this->settings->get('settings::kroxy:mail_backgroundColor', '#F5F5F5'),
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

                /* Advanced */
                'profileType'       => $this->settings->get('settings::kroxy:profileType', 'gravatar'),
                'modeToggler'       => $this->settings->get('settings::kroxy:modeToggler', true),
                'langSwitch'        => $this->settings->get('settings::kroxy:langSwitch', true),
                'defaultLang'      => $this->settings->get('settings::kroxy:defaultLang', 'en'),
                'languageOptions'    => json_decode($this->settings->get('settings::kroxy:languageOptions', '[{"key":"en","name":"English"}]'), true) ?? [['key' => 'en', 'name' => 'English']],
                'ipFlag'            => $this->settings->get('settings::kroxy:ipFlag', true),
                'lowResourcesAlert' => $this->settings->get('settings::kroxy:lowResourcesAlert', false),
                'alertLink'         => $this->settings->get('settings::kroxy:alertLink', ''),
                'dashboardPage'       => $this->settings->get('settings::kroxy:dashboardPage', true),
                'registration'     => $this->settings->get('settings::kroxy:registration', false),
                'defaultMode' => $this->settings->get('settings::kroxy:defaultMode', 'darkmode'),
                'copyright' => $this->settings->get('settings::kroxy:copyright', 'Powered by Kroxy'),

                /* SOCIALS */
                'socials' => json_decode($this->settings->get('settings::kroxy:socials', '[]'), true),
                'socialButtons' => $this->settings->get('settings::kroxy:socialButtons', false),
                'discordBox' => $this->settings->get('settings::kroxy:discordBox', true),
            ],
            'locale' => config('app.locale') ?? 'en',
            'recaptcha' => [
                'enabled' => config('recaptcha.enabled', false),
                'method' => config('recaptcha.method', 'recaptcha'),
                'siteKey' => config('recaptcha.website_key') ?? '',
            ],
            'turnstile' => [
                'siteKey' => config('turnstile.site_key') ?? '',
            ],
        ]);
    }
}
