<!-- Team Start -->
@props([
    'instructors' => [],
])
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="section-title text-center position-relative mb-5">
            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">{{__('Instructors')}}</h6>
            <h1 class="display-4">{{__('Meet Our Instructors')}}</h1>
        </div>
        <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
            {{-- @dd($instructors) --}}
            @foreach ($instructors as $instructor)
            <div class="team-item">
                    <img class="img-fluid w-100" src="{{ asset('storage/' . $instructor->profile->avatar) }}"
                        alt="" style="width: 300px; height:330px;">
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3">{{ $instructor->name }}</h5>
                        <p class="mb-2">{{ $instructor->profile->job_title }}</p>
                        <div class="d-flex justify-content-center">
                            @php
                                $socails = $instructor->profile->socail_media;
                            @endphp
                            <a class="mx-1 p-1" href="{{ $socails['twitter'] }}"target="_block"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="mx-1 p-1" href="{{ $socails['facebook'] }}"target="_block"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="mx-1 p-1" href="{{ $socails['linkedin'] }}"target="_block"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="mx-1 p-1" href="{{ $socails['instagram'] }}"target="_block"><i
                                    class="fab fa-instagram"></i></a>
                            <a class="mx-1 p-1" href="{{ $socails['youtube'] }}" target="_block"><i
                                    class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
</div>
<!-- Team End -->
