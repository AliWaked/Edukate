<x-front.layout title='Edukate'>

    <div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center my-5 py-5">
            <h1 class="text-white mt-4 mb-4">{{__('Learn From Home')}}</h1>
            <h1 class="text-white display-1 mb-5">{{__('Education Courses')}}</h1>
            <x-front.partials.search-courses :coursesNames="$courses->pluck('name')" />
        </div>
    </div>

    {{-- start about section --}}
    <x-front.partials.about title='About' :breadcrumb="['Home', 'about']" :numberOfCategories="$numberOfCategories" :numberOfCourses="$courses->count()" :numberOfInstructors="$numberOfInstructors"
        :numberOfStudent="$numberOfStudent" />
    {{-- end about section --}}

    {{-- start feature section  --}}
    <div class="container-fluid bg-image" style="margin: 90px 0;">
        <x-front.partials.feature />
    </div>
    {{-- end feature section  --}}

    <!-- Courses Start -->
    <div class="container-fluid px-0 py-5">
        <div class="row mx-0 justify-content-center pt-5">
            <div class="col-lg-6">
                <div class="section-title text-center position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">{{__('Our Courses')}}</h6>
                    <h1 class="display-4">{{__('Checkout New Releases Of Our Courses')}}</h1>
                </div>
            </div>
        </div>
        <div class="owl-carousel courses-carousel">
            @foreach ($courses->take(6) as $course)
                <div class="courses-item position-relative">
                    <img class="img-fluid" src="{{ asset('storage/' . $course->course_image) }}" alt="">
                    <div class="courses-text">
                        <h4 class="text-center text-white px-3">{{ $course->name }}</h4>
                        <div class="border-top w-100 mt-3">
                            <div class="d-flex justify-content-between p-4">
                                <span class="text-white"><i class="fa fa-user mr-2"></i>{{ $course->user->name }}</span>
                                @php
                                    $students = $course->students();
                                    $stud = $students->where('rating', '<>', 0);
                                    if ($stud->count()) {
                                        $rating = round($stud->sum('rating') / $stud->count(), 2);
                                    }
                                @endphp
                                <span class="text-white"><i class="fa fa-star mr-2"></i>{{ $rating ?? '0' }}
                                    <small>({{ $students->count() }})</small></span>
                            </div>
                        </div>
                        <div class="w-100 bg-white text-center p-4">
                            <a class="btn btn-primary" href="{{ route('pages.courseDetail', $course->slug) }}">{{__('Course Detail')}}</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="row justify-content-center bg-image mx-0 mb-5">
            <div class="col-lg-6 py-5">
                <div class="bg-white p-5 my-5">
                    <h1 class="text-center mb-4">{{__('30% Off For New Students')}}</h1>
                    <form>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control bg-light border-0" placeholder="{{__('Your Name')}}"
                                        style="padding: 30px 20px;">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="email" class="form-control bg-light border-0"
                                        placeholder="{{__('Your Email')}}" style="padding: 30px 20px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="custom-select bg-light border-0 px-3" style="height: 60px;">
                                        <option selected>{{__('Select A courses')}}</option>
                                        <option value="1">courses 1</option>
                                        <option value="2">courses 1</option>
                                        <option value="3">courses 1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-primary btn-block" type="submit" style="height: 60px;">{{__('Sign Up Now')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Courses End -->

    {{-- start team section --}}
    <x-front.partials.instructor :instructors="$instructors" />
    {{-- end team section --}}

    {{-- Testimonial Start --}}
    <x-front.partials.testimonial :testimonials="$testimonials" />
    {{-- Testimonial End --}}

    <!-- Contact Start -->
    <x-front.partials.contact />
    <!-- Contact End -->

</x-front.layout>
