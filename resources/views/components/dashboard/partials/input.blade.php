@props([
    'name' => '',
    'label' => '',
    'id' => '',
    'type' => 'text',
    'required' => false,
])
<div class="mt-3">
    <label for="{{ $id }}">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}"  id="{{ $id }}"
        {{ $attributes }} @if ($required) required @endif>
    <br>
    <x-front.partials.input-error :error="$errors->first($name)" />
</div>
