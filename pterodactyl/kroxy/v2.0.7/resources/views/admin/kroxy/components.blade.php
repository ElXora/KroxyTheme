@extends('layouts.kroxy', ['navbar' => 'components', 'sideEditor' => false])

@section('title')
    Kroxy Layout
@endsection

@php
    $serverRowOptions = [
        ['img' => '/kroxy/components/ServerRow-1.svg', 'value' => 1, 'label' => 'Enable'],
        ['img' => '/kroxy/components/ServerRow-2.svg', 'value' => 2, 'label' => 'Disable'],
        ['img' => '/kroxy/components/ServerRow-3.svg', 'value' => 3, 'label' => 'Disable'],
    ];
    $statCardsOptions = [
        ['img' => '/kroxy/components/Console.svg', 'value' => 1, 'label' => 'No statistics cards'],
        ['img' => '/kroxy/components/StatsCards-1.svg', 'value' => 2, 'label' => 'Statistics cards top'],
        ['img' => '/kroxy/components/StatsCards-2.svg', 'value' => 3, 'label' => 'Statistics cards bottom'],
    ];
    $sideGraphOptions = [
        ['img' => '/kroxy/components/Console.svg', 'value' => 1, 'label' => 'No vertical graphs'],
        ['img' => '/kroxy/components/SideGraphs-1.svg', 'value' => 2, 'label' => 'Vertical graphs left'],
        ['img' => '/kroxy/components/SideGraphs-2.svg', 'value' => 3, 'label' => 'Vertical graphs right'],
    ];
    $graphsOptions = [
        ['img' => '/kroxy/components/Console.svg', 'value' => 1, 'label' => 'No horizontal graphs'],
        ['img' => '/kroxy/components/Graphs-1.svg', 'value' => 2, 'label' => 'Horizontal graphs top'],
        ['img' => '/kroxy/components/Graphs-2.svg', 'value' => 3, 'label' => 'Horizontal graphs bottom'],
    ];
@endphp

@section('content')

    <form action="{{ route('admin.kroxy.components') }}" method="POST" class="content-box content-box-wide">
        <div class="header">
            <p>Components Settings</p>
            <span class="description-text">Customize the components shown on Kroxy Theme.</span>
        </div>
        
        <x-kroxy.form-wrapper 
            title="Dashboard page" 
            description="Customize the dashboard server page easily with a drag and drop"
        >
            <a class="drag-n-drop-banner" href="{{ route('admin.kroxy.dashboard') }}">
                <h3>Customize dashboard page with drag and drop!</h3>
                <p>Open Dashboard Editor <i data-lucide="arrow-right"></i></p>
            </a>
        </x-kroxy.form-wrapper>

        <x-kroxy.form-wrapper 
            title="Server cards" 
            description="Choose a different style for the server cards shown on the homepage"
        >
            <x-kroxy.option-picture-2
                id="kroxy:serverRow" 
                :value="$serverRow"
                :options="$serverRowOptions"
            />
        </x-kroxy.form-wrapper>

        <x-kroxy.form-wrapper 
            title="Console page" 
            description="Customize what and how stats is shown on the console page"
        >
            <x-kroxy.option-picture-2
                id="kroxy:statsCards" 
                :value="$statsCards"
                :options="$statCardsOptions"
            />
            <x-kroxy.option-picture-2
                id="kroxy:sideGraphs" 
                :value="$sideGraphs"
                :options="$sideGraphOptions"
            />
            <x-kroxy.option-picture-2
                id="kroxy:graphs" 
                :value="$graphs"
                :options="$graphsOptions"
            />
        </x-kroxy.form-wrapper>

        <div class="floating-button">
            {!! csrf_field() !!}
            <button type="submit" class="button button-primary">Save changes</button>
        </div>
    </form>
@endsection