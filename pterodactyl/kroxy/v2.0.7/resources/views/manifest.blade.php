{{-- PWA Manifest --}}
{
    "name": "{{ $siteConfiguration['kroxy']['meta_title'] ?? 'Pterodactyl Panel' }}",
    "short_name": "Pterodactyl",
    "description": "{{ $siteConfiguration['kroxy']['meta_description'] ?? 'Game server management panel' }}",
    "start_url": "/",
    "display": "standalone",
    "background_color": "{{ $siteConfiguration['kroxy']['meta_color'] ?? '#0e0e1a' }}",
    "theme_color": "{{ $siteConfiguration['kroxy']['meta_color'] ?? '#0e0e1a' }}",
    "orientation": "portrait-primary",
    "icons": [
        {
            "src": "{{ $siteConfiguration['kroxy']['meta_favicon'] ?? '/favicons/android-chrome-192x192.png' }}",
            "sizes": "192x192",
            "type": "image/png"
        }
    ]
}