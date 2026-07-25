@extends('layouts.kroxy', ['navbar' => 'index', 'sideEditor' => true])

@section('title')
    Kroxy Theme
@endsection

@section('content')
    <form action="{{ route('admin.kroxy') }}" method="POST">
        <div class="header">
            <p>General settings</p>
            <span class="description-text">Change the general settings of Kroxy Theme.</span>
        </div>
        <x-kroxy.input-field 
            id="kroxy:logo" 
            :value="$logo" 
            label="Panel logo (Dark mode)"
        />
        <x-kroxy.input-field
            id="kroxy:logoLight" 
            :value="$logoLight" 
            label="Panel logo (Light mode)"
        />
        <x-kroxy.switch 
            hr="true"
            id="kroxy:fullLogo"
            name="kroxy:fullLogo"
            :value="$fullLogo"
            label="Logo only"
            helpText="Enable or disable the text next to the panel logo." 
        />
        <div style="position:relative;">
            <x-kroxy.input-field 
                hr="true"
                id="kroxy:logoHeight" 
                :value="$logoHeight" 
                label="Panel logo height"
            />
            <div style="position:absolute;bottom:42px;right:16px">
                px
            </div>
        </div>
        <div>
            <p class="subtitle">Support links</p>
            <x-kroxy.callout
                message="Leave empty remove the a specific support link from your panel."
            />
        </div>
        <x-kroxy.input-field 
            hr="true"
            id="kroxy:discord" 
            :value="$discord" 
            label="Discord ID"
        />
        <x-kroxy.input-field
            id="kroxy:support" 
            :value="$support" 
            label="Supportcenter"
        />
        <div class="floating-button">
            {!! csrf_field() !!}
            <button type="submit" class="button button-primary">Save changes</button>
        </div>
    </form>
@endsection