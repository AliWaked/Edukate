<ul>
{{-- {{dd($links)}} --}}
    @foreach ($links as $link)
        <a href="{{ route($link['route']) }}" class="style {{ Route::is($link['active']) ? 'active' : '' }}"><span><i
                    class="{{ $link['icon'] }}"></i></span>{{ $link['title'] }}</a>
    @endforeach
</ul>
