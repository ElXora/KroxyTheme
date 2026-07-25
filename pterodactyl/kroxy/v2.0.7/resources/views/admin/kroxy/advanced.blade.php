@extends('layouts.kroxy', ['navbar' => 'advanced', 'sideEditor' => false])

@section('title')
    Kroxy Advanced
@endsection

@section('content')
    <form action="{{ route('admin.kroxy.advanced') }}" method="POST" class="content-box">
        <div class="header">
            <p>Advanced settings</p>
            <span class="description-text">Change Kroxy advanced settings.</span>
        </div>

        <x-kroxy.form-wrapper 
            title="Customize Kroxy" 
            description="Change Kroxy advanced settings."
        >
            <x-kroxy.input-field 
                id="kroxy:copyright" 
                :value="$copyright" 
                label="Copyright Text"
            />
            <div class="input-field">
                <label for="kroxy:defaultMode">Default mode</label>
                <select
                    id="kroxy:defaultMode"
                    name="kroxy:defaultMode"
                >
                    <option value="darkmode">Darkmode</option>
                    <option value="lightmode" @if(old('kroxy:defaultMode', $defaultMode) == 'lightmode') selected @endif>Lightmode</option>
                </select>
            </div>
            <div class="input-field">
                <label for="kroxy:profileType">Profile Style</label>
                <select
                    id="kroxy:profileType"
                    name="kroxy:profileType"
                >
                    <option value="boring">Boring Avatars</option>
                    <option value="avataaars" @if(old('kroxy:profileType', $profileType) == 'avataaars') selected @endif>Avataaars Neutral</option>
                    <option value="bottts" @if(old('kroxy:profileType', $profileType) == 'bottts') selected @endif>Bottts Neutral</option>
                    <option value="identicon" @if(old('kroxy:profileType', $profileType) == 'identicon') selected @endif>Identicon</option>
                    <option value="initials" @if(old('kroxy:profileType', $profileType) == 'initials') selected @endif>Initials</option>
                    <option value="gravatar" @if(old('kroxy:profileType', $profileType) == 'gravatar') selected @endif>Gravatar</option>
                </select>
            </div>
            <hr />
            <x-kroxy.switch 
                id="kroxy:lowResourcesAlert"
                name="kroxy:lowResourcesAlert"
                :value="$lowResourcesAlert"
                label="Low Resources Alert"
            />
            <x-kroxy.input-field 
                id="kroxy:alertLink" 
                :value="$alertLink" 
                label="Low Resources Alert Link"
                helpText="The link users will be directed to when clicking the 'Upgrade Server' button in the low resources alert."
            />
            <x-kroxy.switch
                id="kroxy:ipFlag"
                name="kroxy:ipFlag"
                :value="$ipFlag"
                label="IP Flag"
            />
            <x-kroxy.switch
                id="kroxy:modeToggler"
                name="kroxy:modeToggler"
                :value="$modeToggler"
                label="Dark/light mode Toggler"
            />
            <x-kroxy.switch
                id="kroxy:langSwitch"
                name="kroxy:langSwitch"
                :value="$langSwitch"
                label="Language Switcher"
            />
            @php
                $languageOptionsArray = json_decode($languageOptions, true) ?? [['key' => 'en', 'name' => 'English']];
                $activeLanguageKeys = array_column($languageOptionsArray, 'key');
            @endphp

            <script>const languages = @json($activeLanguageKeys);</script>

            <div class="input-field">
                <label for="kroxy:defaultLang">Default Language</label>
                <select
                    id="kroxy:defaultLang"
                    name="kroxy:defaultLang"
                >
                    @foreach($languageOptionsArray as $lang)
                        <option value="{{ $lang['key'] }}" @if(old('kroxy:defaultLang', $defaultLang) == $lang['key']) selected @endif>{{ $lang['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-field">
                <label>Available Languages</label>
                <div class="languages-options">
                    @foreach($languages as $key => $value)
                        <label>
                            <input 
                                type="checkbox" 
                                name="kroxy:languageOptions[]" 
                                value="{{ $key }}" 
                                @if(in_array($key, $activeLanguageKeys)) checked @endif
                            />
                            <span></span>
                            {{ $value }}
                        </label>
                    @endforeach
                </div>
            </div>

            <x-kroxy.switch
                id="kroxy:dashboardPage"
                name="kroxy:dashboardPage"
                :value="$dashboardPage"
                label="Dashboard Page"
            />
            <x-kroxy.switch
                id="kroxy:registration"
                name="kroxy:registration"
                :value="$registration"
                label="User Registration"
            />
        </x-kroxy.form-wrapper>

        <div class="floating-button">
            {!! csrf_field() !!}
            <button type="submit" class="button button-primary">Save changes</button>
        </div>
    </form>
    <div class="header">
        <p>Kroxy Presets</p>
        <span class="description-text">Import and export presets.</span>
    </div>
    <form action="{{ route('admin.kroxy.advanced.preset') }}" method="POST" id="kroxy-preset-form" style="margin-top:40px;">
            {!! csrf_field() !!}
        <x-kroxy.form-wrapper 
            title="Import / Export Kroxy Preset"
            description="Export or import Kroxy advanced settings presets."
        >
            <p>Keep in mind: although we try to keep our products safe with input sanitization, importing presets may still break your installation. Only use presets from people you trust or from official sources (such as BuiltByBit or Kroxy.gg).</p>

            <div style="display:flex; gap:10px;">
                <button type="button" class="button button-primary" onclick="exportKroxyPreset()">
                    Export preset
                </button>

                <button type="button" class="button button-secondary" onclick="document.getElementById('preset-file-input').click()">
                    Import preset
                </button>

                <!-- Hidden file input -->
                <input type="file" id="preset-file-input" accept=".kroxy" style="display:none" />
                <input type="hidden" id="kroxy-preset-json" name="preset_json" value='@json($kroxySettings)' />
            </div>
        </x-kroxy.form-wrapper>
    </form>

<script>
    // EXPORT FUNCTION
    function exportKroxyPreset() {
        const json = document.getElementById('kroxy-preset-json').value.trim();
        const blob = new Blob([json], { type: "application/json" });
        const url = URL.createObjectURL(blob);

        const a = document.createElement("a");
        a.href = url;
        a.download = "preset.kroxy";
        a.click();

        URL.revokeObjectURL(url);
    }

    // IMPORT FUNCTION
    document.getElementById("preset-file-input").addEventListener("change", function () {
        const file = this.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            try {
                const text = e.target.result;

                // Optional: validate JSON
                JSON.parse(text);

                // Put JSON into textarea
                document.getElementById("kroxy-preset-json").value = text;

                // Auto-submit form
                document.getElementById("kroxy-preset-form").submit();
            } catch (err) {
                alert("Invalid preset file: not valid JSON.");
            }
        };
        reader.readAsText(file);
    });
</script>
@endsection