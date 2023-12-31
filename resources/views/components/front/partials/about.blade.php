@props([
    'numberOfCategories' => 0,
    'numberOfCourses' => 0,
    'numberOfInstructors' => 0,
    'numberOfStudent' => 0,
])
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="{{ asset('assets/img/about.jpg') }}"
                        style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="section-title position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">{{__('About Us')}}</h6>
                    <h1 class="display-4">{{__('First Choice For Online Education Anywhere')}}</h1>
                </div>
                <p>{{__('Tempor erat elitr at rebum at at clita aliquyam consetetur. Diam dolor diam ipsum et, tempor voluptua
                    sit consetetur sit. Aliquyam diam amet diam et eos sadipscing labore. Clita erat ipsum et lorem et
                    sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor consetetur takimata eirmod,
                    dolores takimata consetetur invidunt magna dolores aliquyam dolores dolore. Amet erat amet et magna')}}
                </p>
                <div class="row pt-3 mx-0">
                    <div class="col-3 px-0">
                        <div class="bg-success text-center p-4">
                            <h1 class="text-white" data-toggle="counter-up">{{ $numberOfCategories }}</h1>
                            <h6 class="text-uppercase text-white">{{__('Available')}}<span class="d-block">{{__('Subjects')}}</span></h6>
                        </div>
                    </div>
                    <div class="col-3 px-0">
                        <div class="bg-primary text-center p-4">
                            <h1 class="text-white" data-toggle="counter-up">{{ $numberOfCourses }}</h1>
                            <h6 class="text-uppercase text-white">{{__('Online')}}<span class="d-block">{{__('Courses')}}</span></h6>
                        </div>
                    </div>
                    <div class="col-3 px-0">
                        <div class="bg-secondary text-center p-4">
                            <h1 class="text-white" data-toggle="counter-up">{{ $numberOfInstructors }}</h1>
                            <h6 class="text-uppercase text-white">{{__('Skilled')}}<span class="d-block">{{__('Instructors')}}</span></h6>
                        </div>
                    </div>
                    <div class="col-3 px-0">
                        <div class="bg-warning text-center p-4">
                            <h1 class="text-white" data-toggle="counter-up">{{ $numberOfStudent }}</h1>
                            <h6 class="text-uppercase text-white">{{__('Happy')}}<span class="d-block">{{__('Students')}}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
