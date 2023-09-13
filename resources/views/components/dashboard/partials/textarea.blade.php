@props([
    'label' => '',
    'name' => '',
    'id' => '',
    'value' => null
])
<div class="mt-3">
    <label for="{{$id}}">{{ $label }}</label>
    <textarea {{$attributes}} name="{{$name}}" id="{{$id}}" required>{{ $value??old($name)  }}</textarea>
    <br>
    <x-front.partials.input-error :error="$errors->first($name)" />
</div>
