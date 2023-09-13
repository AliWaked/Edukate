@props([
    'items' => [],
])
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard.dashboard.index')}}">Home</a></li>
    @foreach ($items as $item)
        <li class="breadcrumb-item">{{ $item }}</li> {{-- active --}}
    @endforeach
</ol>
