@props([
    'coursesNames' => [],
    'filter' => '',
]);
<div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
    <div class="input-group">
        <div class="input-group-prepend">
            <button class="btn btn-outline-light bg-white text-body px-4 dropdown-toggle" type="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{__('Courses')}}</button>
            <div class="dropdown-menu">
                @foreach ($coursesNames as $coursesName)
                    <a class="dropdown-item"
                        href="{{ route('courses') . '?filter=' . $coursesName }}">{{ $coursesName }}</a>
                @endforeach
            </div>
        </div>
        <form action="{{ route('courses') }}" method="get" id="form-search" style="width: 55%;">
            <input type="text" name="filter" value="{{ old('filter', $filter) }}" class="form-control border-light"
                style="padding: 30px 25px;" placeholder="{{__('Keyword')}}">
        </form>
        <div class="input-group-append">
            <button onclick="document.getElementById('form-search').submit()"
                class="btn btn-secondary px-4 px-lg-5">{{__('Search')}}</button>
        </div>
    </div>
</div>
