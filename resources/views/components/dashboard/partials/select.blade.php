@props([
    'name' => '',
    'label' => '',
    'id' => '',
    'items' => [],
    'value' => '',
    'required' => false,
])
<div class="mt-3">
    <label for="{{ $id }}">{{ __($label) }}</label>
    <select name="{{ $name }}" id="{{ $id }}" {{ $attributes }}
        @if ($required) required @endif style="text-transform:capitalize;">
        @if (is_object($items))
            @foreach ($items as $item)
                <option value="{{ $item->id }}" @selected($item->id == $value)>{{ __($item->name )}}</option>
            @endforeach
        @else
            @foreach ($items as $item)
                <option value="{{ $item }}" @selected($item == $value)>{{ __($item) }}</option>
            @endforeach
        @endif
    </select>
    <br>
    <x-front.partials.input-error :error="$errors->first($name)" />
</div>
