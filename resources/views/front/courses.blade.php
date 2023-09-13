<x-front.layout>

    <!-- Header Start -->
    <x-front.partials.header title="{{__('Courses')}}" :breadcrumb="[__('Home') ,__('courses')]" :coursesNames="$coursesNames" :filter="$filter" />
    <!-- Header End -->


    <!-- Courses Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row mx-0 justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center position-relative mb-5">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">{{__('Our Courses')}}</h6>
                        <h1 class="display-4">{{__('Checkout New Releases Of Our Courses')}}</h1>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 pb-4">
                        <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="{{route('pages.courseDetail',$course->slug)}}">
                            <img class="img-fluid" src="{{ asset('storage/' . $course->course_image) }}" alt="">
                            <div class="courses-text">
                                <h4 class="text-center text-white px-3">{{ $course->name }}</h4>
                                <div class="border-top w-100 mt-3">
                                    <div class="d-flex justify-content-between p-4">
                                        @php
                                            $students = $course->students();
                                            $stud = $students->where('rating', '<>', 0);
                                            if ($stud->count()) {
                                                $rating = round($stud->sum('rating') / $stud->count(), 2);
                                            }
                                        @endphp
                                        <span class="text-white"><i
                                                class="fa fa-user mr-2"></i>{{ $course->user->name }}</span>
                                        <span class="text-white"><i class="fa fa-star mr-2"></i>{{ $rating ?? '0' }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach


                <div class="col-12 mt-5">
                    {{ $courses->withQueryString()->links() }}
                    {{-- <nav aria-label="Page navigation">
                        <ul class="pagination pagination-lg justify-content-center mb-0">
                            <li class="page-item disabled">
                                <a class="page-link rounded-0" id="previous" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            @for ($i = 1; $i <= $courses->lastPage(); $i++)
                                <li class="page-item active"><a class="page-link"
                                        href="{{ URL::current() . '?page=' . $i }}">{{ $i }}</a></li>
                            @endfor
                            <li class="page-item"><a class="page-link" href="{{ URL::current() . '?page=2' }}">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="{{ URL::current() . '?page=3' }}">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link rounded-0" href="#" id="next" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav> --}}
                    {{-- {{$courses->links()}} --}}
                    {{-- <script>
                        var pageNumber = 1;
                        var numberOfPages = "{{ $courses->lastPage() }}";
                        console.log()
                        previous = document.getElementById('previous');
                        next = document.getElementById('next');
                    </script> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Courses End -->
</x-front.layout>
