@props([
    'type' => 'text',
    'name' => '',
    'placeholder' => '',
    'error' => '',
])
<input type="{{ $type }}" name="{{ $name }}" placeholder="{{ strtoupper($placeholder) }}" required>
<small style="color: red">{{ $error }}</small>
