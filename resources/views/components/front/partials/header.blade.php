@props([
    'title' => '',
    'breadcrumb' => ['home'],
    'search' => true,
    'coursesNames' => [],
    'filter' => '',
])
<div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px;">
    <div class="container text-center py-5">
        <h1 class="text-white display-1">{{ $title }}</h1>
        <div class="d-inline-flex text-white mb-5">
            <p class="m-0 text-uppercase"><a class="text-white" href="">{{ $breadcrumb[0] }}</a></p>
            <i class="fa fa-angle-double-right pt-1 px-3"></i>
            <p class="m-0 text-uppercase">{{ $breadcrumb[1] ?? '' }}</p>
        </div>
        @if ($search)
            <x-front.partials.search-courses :coursesNames="$coursesNames" :filter="$filter" />
        @endif
    </div>
</div>
