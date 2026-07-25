@extends('layouts.kroxy', ['navbar' => 'layout', 'sideEditor' => true])

@section('title')
    Kroxy Layout
@endsection

@section('content')

    <form action="{{ route('admin.kroxy.layout') }}" method="POST">
        <div class="header">
            <p>General layout settings</p>
            <span class="description-text">Change the general layout settings of Kroxy Theme.</span>
        </div>
        <div>
            <p class="subtitle">General Layout</p>
            <div class="layout-grid">
                <x-kroxy.layout-option 
                    id="kroxy:layout:1" 
                    name="kroxy:layout"
                    value="1"
                    :oldValue="$layout" 
                    label="Sidebar"
                    img="/kroxy/layout/layout-1.svg"
                />
                <x-kroxy.layout-option 
                    id="kroxy:layout:2" 
                    name="kroxy:layout"
                    value="2"
                    :oldValue="$layout" 
                    label="Sidebar Power Actions"
                    img="/kroxy/layout/layout-2.svg"
                />
                <x-kroxy.layout-option 
                    id="kroxy:layout:3" 
                    name="kroxy:layout"
                    value="3"
                    :oldValue="$layout" 
                    label="Top Navigation"
                    img="/kroxy/layout/layout-3.svg"
                />
                <x-kroxy.layout-option 
                    id="kroxy:layout:4" 
                    name="kroxy:layout"
                    value="4"
                    :oldValue="$layout" 
                    label="Slim Sidebar"
                    img="/kroxy/layout/layout-4.svg"
                />
                <x-kroxy.layout-option 
                    id="kroxy:layout:5" 
                    name="kroxy:layout"
                    value="5"
                    :oldValue="$layout" 
                    label="Sidebar Filled Hover"
                    img="/kroxy/layout/layout-5.svg"
                />
            </div>
        </div>

        <div class="input-field">
            <label for="kroxy:logoPosition">Search or select bar</label>
            <select name="kroxy:searchComponent" value="{{ old('kroxy:searchComponent', $searchComponent) }}">
                <option value="1">Server select bar</option>
                <option value="2" @if(old('kroxy:searchComponent', $searchComponent) == '2') selected @endif>Searchbar</option>
            </select>
            <small>Where do you want the logo on the login screen.</small>
        </div>

        <hr />
        
        <div class="header">
            <p>Login layout settings</p>
            <span class="description-text">Change the layout settings of the auth pages of Kroxy Theme.</span>
        </div>
        <div>
            <p class="subtitle">Login layout</p>
            <div class="layout-grid">
                <x-kroxy.layout-option 
                    id="kroxy:loginLayout:1" 
                    name="kroxy:loginLayout"
                    value="1"
                    :oldValue="$loginLayout" 
                    label="Default"
                    img="/kroxy/layout/loginLayout-1.svg"
                />
                <x-kroxy.layout-option 
                    id="kroxy:loginLayout:2" 
                    name="kroxy:loginLayout"
                    value="2"
                    :oldValue="$loginLayout" 
                    label="Side Banner"
                    img="/kroxy/layout/loginLayout-2.svg"
                />
                <x-kroxy.layout-option 
                    id="kroxy:loginLayout:3" 
                    name="kroxy:loginLayout"
                    value="3"
                    :oldValue="$loginLayout" 
                    label="Floating Image"
                    img="/kroxy/layout/loginLayout-3.svg"
                />
                <x-kroxy.layout-option 
                    id="kroxy:loginLayout:4" 
                    name="kroxy:loginLayout"
                    value="4"
                    :oldValue="$loginLayout" 
                    label="Flat"
                    img="/kroxy/layout/loginLayout-4.svg"
                />
            </div>
        </div>

        <div class="input-field">
            <label for="kroxy:socialPosition">Social position</label>
            <select name="kroxy:socialPosition" value="{{ old('kroxy:socialPosition', $socialPosition) }}">
                <option value="1">Above form</option>
                <option value="2" @if(old('kroxy:socialPosition', $socialPosition) == '2') selected @endif>Under form</option>
            </select>
            <small>Where do you want the social buttons on the login screen.</small>
        </div>
        <div class="input-field">
            <label for="kroxy:logoPosition">Logo Position</label>
            <select name="kroxy:logoPosition" value="{{ old('kroxy:logoPosition', $logoPosition) }}">
                <option value="1">Above form</option>
                <option value="2" @if(old('kroxy:logoPosition', $logoPosition) == '2') selected @endif>Top corner</option>
            </select>
            <small>Where do you want the logo on the login screen.</small>
        </div>
        <div class="floating-button">
            {!! csrf_field() !!}
            <button type="submit" class="button button-primary">Save changes</button>
        </div>
    </form>
@endsection