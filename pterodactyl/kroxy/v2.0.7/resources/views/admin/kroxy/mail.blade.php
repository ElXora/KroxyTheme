@extends('layouts.kroxy', ['navbar' => 'mail', 'sideEditor' => false])

@section('title')
    Kroxy Mail
@endsection

@section('content')
    <form action="{{ route('admin.kroxy.mail') }}" method="POST" class="content-box">
        <div class="header">
            <p>Mail settings</p>
            <span class="description-text">Change the mail template settings.</span>
        </div>

        <x-kroxy.form-wrapper 
            title="Logo Settings" 
            description="Configure the logo settings for your mail templates."
        >
            <x-kroxy.input-field 
                id="kroxy:mail_logo" 
                :value="$mail_logo" 
                label="Mail logo"
            />
            <x-kroxy.switch 
                id="kroxy:mail_logoFull"
                name="kroxy:mail_logoFull"
                :value="$mail_logoFull"
                label="Logo only"
            />
        </x-kroxy.form-wrapper>
        <x-kroxy.form-wrapper 
            title="Mail Styling" 
            description="Configure the mail styling settings for your mail templates."
        >
            <div class="input-field">
                <label for="mail_color">Mail primary color</label>
                <x-kroxy.color-input
                    target="mail_color"
                    id="kroxy:mail_color"
                    :value="$mail_color"
                />
            </div>
            <div class="input-field">
                <label for="mail_backgroundColor">Mail background color</label>
                <x-kroxy.color-input
                    target="mail_backgroundColor"
                    id="kroxy:mail_backgroundColor" 
                    :value="$mail_backgroundColor"
                />
            </div>
            <div class="input-field">
                <label for="kroxy:mail_mode">Mail color mode</label>
                <select
                    id="kroxy:mail_mode"
                    name="kroxy:mail_mode"
                >
                    <option value="dark" @if(old('kroxy:mail_mode', $mail_mode) == 'dark') selected @endif>Dark mode</option>
                    <option value="light" @if(old('kroxy:mail_mode', $mail_mode) == 'light') selected @endif>Light mode</option>
                </select>
                <span style="font-size:0.8rem">If the background color is light, use a light setting. If the background color is dark, use a dark setting.</span>
            </div>
        </x-kroxy.form-wrapper>
        <x-kroxy.form-wrapper 
            title="Utility Links" 
            description="Configure the utility links settings for your mail templates. Leave empty to remove a specific utility link."
        >
            <x-kroxy.input-field 
                id="kroxy:mail_status" 
                :value="$mail_status"
                label="Mail status page"
            />
            <x-kroxy.input-field 
                id="kroxy:mail_billing" 
                :value="$mail_billing" 
                label="Mail billing"
            />
            <x-kroxy.input-field 
                id="kroxy:mail_support" 
                :value="$mail_support" 
                label="Mail support"
            />
        </x-kroxy.form-wrapper>
        <x-kroxy.form-wrapper 
            title="Mail socials" 
            description="Configure the mail socials settings for your mail templates. Leave empty to remove a specific social link."
        >
            <x-kroxy.input-field 
                id="kroxy:mail_discord" 
                :value="$mail_discord" 
                label="Mail discord"
            />
            <x-kroxy.input-field 
                id="kroxy:mail_twitter" 
                :value="$mail_twitter" 
                label="Mail Twitter"
            />
            <x-kroxy.input-field 
                id="kroxy:mail_facebook" 
                :value="$mail_facebook" 
                label="Mail Facebook"
            />
            <x-kroxy.input-field 
                id="kroxy:mail_instagram" 
                :value="$mail_instagram" 
                label="Mail Instagram"
            />
            <x-kroxy.input-field 
                id="kroxy:mail_linkedin" 
                :value="$mail_linkedin" 
                label="Mail Linkedin"
            />
            <x-kroxy.input-field 
                id="kroxy:mail_youtube" 
                :value="$mail_youtube" 
                label="Mail Youtube"
            />
        </x-kroxy.form-wrapper>

        <div class="floating-button">
            {!! csrf_field() !!}
            <button type="submit" class="button button-primary">Save changes</button>
        </div>
    </form>
@endsection