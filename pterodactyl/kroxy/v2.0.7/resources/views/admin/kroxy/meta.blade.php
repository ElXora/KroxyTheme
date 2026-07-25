@extends('layouts.kroxy', ['navbar' => 'meta', 'sideEditor' => true])

@section('title')
    Kroxy Meta data
@endsection

@section('content')
    <form action="{{ route('admin.kroxy.meta') }}" method="POST">
        <div class="header">
            <p>Meta Data settings</p>
            <span class="description-text">Change the meta data settings of Kroxy Theme.</span>
        </div>
        <x-kroxy.input-field 
            id="kroxy:meta_favicon" 
            :value="$meta_favicon" 
            label="Favicon"
        />
        <x-kroxy.input-field
            id="kroxy:meta_title" 
            :value="$meta_title" 
            label="Meta title"
        />
        <x-kroxy.input-field
            id="kroxy:meta_image" 
            :value="$meta_image" 
            label="Meta image"
        />
        <x-kroxy.textarea-field
            id="kroxy:meta_description" 
            :value="$meta_description" 
            label="Meta description"
        />
        <div class="input-field">
            <label for="kroxy:meta_color">Meta color</label>
            <x-kroxy.color-input
                target="meta_color"
                id="kroxy:meta_color" 
                :value="$meta_color"
            />
        </div>
        <div class="floating-button">
            {!! csrf_field() !!}
            <button type="submit" class="button button-primary">Save changes</button>
        </div>
    </form>

    <!-- <form action="{{ route('admin.kroxy.meta') }}" method="POST">
        <div class="input-field hr">
            <label for="kroxy:meta_favicon">Favicon</label>
            <input type="text" id="kroxy:meta_favicon" name="kroxy:meta_favicon" value="{{ old('kroxy:meta_favicon', $meta_favicon) }}" />
        </div>
        <div class="input-field hr">
            <label for="kroxy:meta_title">Meta title</label>
            <input type="text" id="kroxy:meta_title" name="kroxy:meta_title" value="{{ old('kroxy:meta_title', $meta_title) }}" />
        </div>
        <div class="input-field hr">
            <label for="kroxy:meta_image">Meta image</label>
            <input type="text" id="kroxy:meta_image" name="kroxy:meta_image" value="{{ old('kroxy:meta_image', $meta_image) }}" />
        </div>
        <div class="input-field">
            <label for="kroxy:meta_description">Meta description</label>
            <textarea type="text" id="kroxy:meta_description" name="kroxy:meta_description" width="100%" rows="5">{{ old('kroxy:meta_description', $meta_description) }}</textarea>
        </div>
        <div class="input-field hr">
            <label for="kroxy:meta_color">Meta color</label>
            <input type="color" id="kroxy:meta_color" name="kroxy:meta_color" value="{{ old('kroxy:meta_color', $meta_color) }}" />
        </div>
        <div class="floating-button">
            {!! csrf_field() !!}
            <button type="submit" class="button button-primary">Save changes</button>
        </div>
    </form> -->
@endsection