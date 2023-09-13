<x-front.layout>
    <x-front.partials.header title="{{__('Course Detail')}}" :breadcrumb="[__('Home'), __('Course Detail')]" :search="false" />
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-5">
                        <div class="section-title position-relative mb-5">
                            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">{{__('Course Detail')}}
                            </h6>
                            <h1 class="display-4">{{ $course->name }}</h1>
                        </div>
                        <img class="img-fluid rounded w-100 mb-4" src="{{ asset('storage/' . $course->course_image) }}"
                            style="max-height: 300px;" alt="Image">
                        <p style="word-wrap: break-word;">{{ $course->descriptions }}</p>
                        <div class="courseContent">
                            <p class="head-course">{{__('Course Content')}}</p>
                            <ul class="list-les">
                                @foreach ($course->section as $section)
                                    <li>
                                        <div class="accordion">
                                            <p class="faqText">{{ $section->lesson_title }}</p>
                                            <i class="zmdi zmdi-chevron-down"></i>
                                        </div>
                                        <div class="panel default">
                                            @foreach ($section->lectures as $key => $value)
                                                <div class="list-lessons">
                                                    <div class="name-lesson">
                                                        <i class="zmdi zmdi-play-circle-outline"></i>
                                                        <p>{{ $key }}</p>
                                                    </div>
                                                    <div class="act-lessons">
                                                        <time class="number-site">{{date('i:s',$section->getVideoDuration('storage/'.$value))}}</time>
                                                        <span>{{__('Complete')}}</span>
                                                        <i class="zmdi zmdi-check"></i>
                                                    </div>
                                                </div>
                                            @endforeach

                                            {{-- <div class="list-lessons">
                                                <div class="name-lesson">
                                                    <i class="zmdi zmdi-play-circle-outline"></i>
                                                    <p>Lesson Two : Defining leadership</p>
                                                </div>
                                                <div class="act-lessons">
                                                    <time class="number-site">7 : 30 m</time>
                                                    <span>Complete</span>
                                                    <i class="zmdi zmdi-check"></i>
                                                </div>
                                            </div>
                                            <div class="list-lessons">
                                                <div class="name-lesson">
                                                    <i class="zmdi zmdi-play-circle-outline"></i>
                                                    <p>Lesson Three : Defining leadership</p>
                                                </div>
                                                <div class="act-lessons">
                                                    <time class="number-site">7 : 30 m</time>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </li>
                                @endforeach
                                {{-- <li>
                                    <div class="accordion">
                                        <p class="faqText">First Lesson :</p>
                                        <i class="zmdi zmdi-chevron-down"></i>
                                    </div>
                                    <div class="panel default">
                                        <div class="list-lessons">
                                            <div class="name-lesson">
                                                <i class="zmdi zmdi-play-circle-outline"></i>
                                                <p>Lesson 2: Defining leadership</p>
                                            </div>
                                            <div class="act-lessons">
                                                <time class="number-site">7 : 30 m</time>
                                                <span>Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="accordion">
                                        <p class="faqText">First Lesson :</p>
                                        <i class="zmdi zmdi-chevron-down"></i>
                                    </div>
                                    <div class="panel default">
                                        <div class="list-lessons">
                                            <div class="name-lesson">
                                                <i class="zmdi zmdi-play-circle-outline"></i>
                                                <p>Lesson 2: Defining leadership</p>
                                            </div>
                                            <div class="act-lessons">
                                                <time class="number-site">7 : 30 m</time>
                                                <span>Complete</span>
                                            </div>
                                        </div>
                                    </div> --}}
                                </li>
                            </ul>
                        </div>

                        <div class="attachments-course">
                            <p class="head-course">{{__('Attachments')}}</p>
                            <ul class="list-attach">
                                @foreach ($course->section as $section)
                                    <li>
                                        @foreach ($section->attachments as $key => $value)
                                            <div class="name-attach">
                                                <small><i class="icon-pdf">pdf</i></small>
                                                <p>{{ Str::beforeLast($key, '*') }}</p>
                                            </div>
                                            <div class="act-attach">
                                                <a href="{{ route('dashboard.course.download', ['path' => $value, 'file_name' => Str::beforeLast($key, '*')]) }}"
                                                    style="text-decoration: none;">
                                                    <span id="download" style="cursor: pointer;"
                                                        {{-- onclick="console.log('hi');fetch(`/courses/download/Attachment?path={{ $value }}&file_name={{ $key }}`,{method:'get'}).then(response => console.log(response))" --}}>Download</span>
                                                </a>
                                            </div>
                                        @endforeach
                                    </li>
                                @endforeach
                                {{-- 
                                <li>
                                    <div class="name-attach">
                                        <small><i class="icon-word">w</i></small>
                                        <p>Software Solutions . Docx</p>
                                    </div>
                                    <div class="act-attach">
                                        <a>
                                            <span>Download</span>
                                        </a>
                                    </div>
                                </li> --}}
                            </ul>
                        </div>
                        <div class="course-presenter">
                            <p class="head-course">{{__('Course Presenter')}}</p>
                            <div class="sec-presenter">
                                <figure>
                                    <img src="{{ $course->user->image }}" />
                                </figure>
                                <div class="sec-tit">
                                    <h3>{{ $course->user->name }}</h3>
                                    <p>{{ $course->user->job_title }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="comment-course">
                            <p class="head-course">{{__('A Comment')}}</p>
                            <ul id="ul-comment">
                                {{-- @dd($comments); --}}
                                @foreach ($comments as $comment)
                                    <li>
                                        <div class="name-cooment">
                                            <h5>{{ $comment->student->name }} </h5>
                                            <time>{{ (new \Carbon\Carbon($comment->created_at))->diffForHumans() }}</time>
                                        </div>
                                        <p>{{ $comment->comment }}</p>
                                    </li>
                                @endforeach

                                {{-- <li>
                                    <div class="name-cooment">
                                        <h5>Ali Omar </h5>
                                        <time>1 / 2 / 2020</time>
                                    </div>
                                    <p>Bring new visitors to the site, when the website is when the website is archived
                                        in a correct and sound manner they target the clien directly through the
                                        semantic phrase keywords that visitors are Archiving websites are useful for
                                        bloggers reerb nmfkkf their writings.</p>
                                </li> --}}
                                {{-- <li>
                                    <div class="name-cooment">
                                        <h5>Ali Omar </h5>
                                        <time>1 / 2 / 2020</time>
                                    </div>
                                    <p>Bring new visitors to the site, when the website is when the website is archived
                                        in a correct and sound manner they target the clien directly through the
                                        semantic phrase keywords that visitors are Archiving websites are useful for
                                        bloggers reerb nmfkkf their writings.</p>
                                </li> --}}
                            </ul>
                            <form class="add-comment">

                                <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
                                    <div class="input-group">
                                        {{-- <form action="" action="post"> --}}
                                        <input type="text" class="form-control border-light"
                                            style="padding: 30px 25px;" placeholder="{{__('Write A Comment')}}" id="comment">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-secondary px-4 px-lg-5"
                                                id="send">{{__('Send')}}</button>
                                        </div>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <h2 class="mb-3">{{__("Related Courses")}}</h2>

                    <div class="owl-carousel related-carousel position-relative" style="padding: 0 30px;">
                        @foreach ($courses->get() as $course)
                            <a class="courses-list-item position-relative d-block overflow-hidden mb-2"
                                href="{{ route('pages.courseDetail', $course->slug) }}">
                                <img class="img-fluid" src="{{ asset('storage/' . $course->course_image) }}"
                                    alt="">
                                <div class="courses-text">
                                    <h4 class="text-center text-white px-3">{{ $course->name }}</h4>
                                    <div class="border-top w-100 mt-3">
                                        <div class="d-flex justify-content-between p-4">
                                            <span class="text-white"><i
                                                    class="fa fa-user mr-2"></i>{{ $course->user->name }}</span>
                                            @php
                                                $students = $course->students();
                                                $stud = $students->where('rating', '<>', 0);
                                                if ($stud->count()) {
                                                    $rating = round($stud->sum('rating') / $stud->count(), 2);
                                                }
                                            @endphp
                                            <span class="text-white"><i
                                                    class="fa fa-star mr-2"></i>{{ $rating ?? '0' }}
                                                <small>({{ $students->count() }})</small></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                        {{-- <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="detail.html">
                            <img class="img-fluid" src="img/courses-2.jpg" alt="">
                            <div class="courses-text">
                                <h4 class="text-center text-white px-3">Web design & development courses for
                                    beginners</h4>
                                <div class="border-top w-100 mt-3">
                                    <div class="d-flex justify-content-between p-4">
                                        <span class="text-white"><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                                        <span class="text-white"><i class="fa fa-star mr-2"></i>4.5
                                            <small>(250)</small></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="detail.html">
                            <img class="img-fluid" src="img/courses-3.jpg" alt="">
                            <div class="courses-text">
                                <h4 class="text-center text-white px-3">Web design & development courses for
                                    beginners</h4>
                                <div class="border-top w-100 mt-3">
                                    <div class="d-flex justify-content-between p-4">
                                        <span class="text-white"><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                                        <span class="text-white"><i class="fa fa-star mr-2"></i>4.5
                                            <small>(250)</small></span>
                                    </div>
                                </div>
                            </div>
                        </a> --}}
                    </div>
                </div>

                <div class="col-lg-4 mt-5 mt-lg-0">
                    <div class="bg-primary mb-5 py-3">
                        <h3 class="text-white py-3 px-4 m-0">{{__('Course Features')}}</h3>
                        <div class="d-flex justify-content-between border-bottom px-4">
                            <h6 class="text-white my-3">{{__('Instructor')}}</h6>
                            <h6 class="text-white my-3">{{ $course->user->name }}</h6>
                        </div>
                        <div class="d-flex justify-content-between border-bottom px-4">
                            @php
                                $students = $course->students();
                                $stud = $students->where('rating', '<>', 0);
                                if ($stud->count()) {
                                    $rating = round($stud->sum('rating') / $stud->count(), 2);
                                }
                            @endphp
                            <h6 class="text-white my-3">{{__('Rating')}}</h6>
                            <h6 class="text-white my-3">{{ $rating ?? '0' }}
                                <small>({{ $students->count() }})</small>
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between border-bottom px-4">
                            <h6 class="text-white my-3">{{__("Lectures")}}</h6>
                            <h6 class="text-white my-3">15</h6>
                        </div>
                        <div class="d-flex justify-content-between border-bottom px-4">
                            <h6 class="text-white my-3">{{__("Duration")}}</h6>
                            <h6 class="text-white my-3">
                                {{(int)($course->duration / 60) }} {{__('minutes')}}</h6>
                        </div>
                        <div class="d-flex justify-content-between border-bottom px-4">
                            <h6 class="text-white my-3">{{__('Skill level')}}</h6>
                            <h6 class="text-white my-3">{{ __($course->skill_level) }}</h6>
                        </div>
                        <div class="d-flex justify-content-between px-4">
                            <h6 class="text-white my-3">{{__('Language')}}</h6>
                            <h6 class="text-white my-3">{{ $course->language }}</h6>
                        </div>
                        <h5 class="text-white py-3 px-4 m-0">{{__('Course Price')}}: ${{ $course->price }}</h5>
                        <div class="py-3 px-4">
                            {{-- @dd(Auth::user()->courses->where('id',$course->id)->status) --}}
                            @if(($user = Auth::guard('web')->user()))
                            @if($user->courses->where('id',$course->id)->first())
                            <a class="btn btn-block btn-secondary py-3 px-5" href="{{route('student.dashboard.index')}}">{{__("Go To Dashboard")}}</a>
                            @else 
                            <a class="btn btn-block btn-secondary py-3 px-5" href="{{route('payment',$course->id)}}">{{__('Enroll Now')}}</a>
                            @endif
                            @endif
                        </div>
                    </div>

                    <div class="mb-5">
                        <h2 class="mb-3">{{__('Categories')}}</h2>
                        <ul class="list-group list-group-flush">
                            @foreach ($categories->get() as $category)
                                {{-- @dd($categories->count()) --}}
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <a href="{{ route('courses') . '?category=' . $category->id }}"
                                        class="text-decoration-none h6 m-0">{{ $category->name }}</a>
                                    <span
                                        class="badge badge-primary badge-pill">{{ $category->courses()->count() }}</span>
                                </li>
                            @endforeach
                            {{-- <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <a href="" class="text-decoration-none h6 m-0">Web Development</a>
                                <span class="badge badge-primary badge-pill">131</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <a href="" class="text-decoration-none h6 m-0">Online Marketing</a>
                                <span class="badge badge-primary badge-pill">78</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <a href="" class="text-decoration-none h6 m-0">Keyword Research</a>
                                <span class="badge badge-primary badge-pill">56</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <a href="" class="text-decoration-none h6 m-0">Email Marketing</a>
                                <span class="badge badge-primary badge-pill">98</span>
                            </li> --}}
                        </ul>
                    </div>

                    <div class="mb-5">
                        <h2 class="mb-4">{{__('Recent Courses')}}</h2>
                        @forelse ($courses->get() as $single_course)
                            <a class="d-flex align-items-center text-decoration-none mb-4"
                                href="{{ route('pages.courseDetail', $single_course->slug) }}">
                                <img class="img-fluid rounded" src="{{ asset('storage/' . $single_course->course_image) }}"
                                    alt="" width="50px">
                                <div class="pl-3">
                                    <h6>{{ $single_course->name }}</h6>
                                    <div class="d-flex">
                                        <small class="text-body mr-3"><i
                                                class="fa fa-user text-primary mr-2"></i>{{ $single_course->user->name }}</small>
                                        @php
                                            $students = $single_course->students();
                                            $stud = $students->where('rating', '<>', 0);
                                            if ($stud->count()) {
                                                $rating = round($stud->sum('rating') / $stud->count(), 2);
                                            }
                                        @endphp
                                        <small class="text-body"><i
                                                class="fa fa-star text-primary mr-2"></i>{{ $rating ?? '0' }}
                                            ({{ $stud->count() }})
                                        </small>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <a class="d-flex align-items-center text-decoration-none mb-4 justify-center text-black"
                                style="text-align: center;color:#333;width:fit-content;margin-left:auto;margin-right:auto;font-size:25px;font-weight:600;">
                                {{__('No Courses')}}</a>
                        @endforelse
                        {{-- <a class="d-flex align-items-center text-decoration-none mb-4" href="">
                            <img class="img-fluid rounded" src="img/courses-80x80.jpg" alt="">
                            <div class="pl-3">
                                <h6>Web design & development courses for beginners</h6>
                                <div class="d-flex">
                                    <small class="text-body mr-3"><i class="fa fa-user text-primary mr-2"></i>Jhon
                                        Doe</small>
                                    <small class="text-body"><i class="fa fa-star text-primary mr-2"></i>4.5
                                        (250)</small>
                                </div>
                            </div>
                        </a>
                        <a class="d-flex align-items-center text-decoration-none mb-4" href="">
                            <img class="img-fluid rounded" src="img/courses-80x80.jpg" alt="">
                            <div class="pl-3">
                                <h6>Web design & development courses for beginners</h6>
                                <div class="d-flex">
                                    <small class="text-body mr-3"><i class="fa fa-user text-primary mr-2"></i>Jhon
                                        Doe</small>
                                    <small class="text-body"><i class="fa fa-star text-primary mr-2"></i>4.5
                                        (250)</small>
                                </div>
                            </div>
                        </a>
                        <a class="d-flex align-items-center text-decoration-none" href="">
                            <img class="img-fluid rounded" src="img/courses-80x80.jpg" alt="">
                            <div class="pl-3">
                                <h6>Web design & development courses for beginners</h6>
                                <div class="d-flex">
                                    <small class="text-body mr-3"><i class="fa fa-user text-primary mr-2"></i>Jhon
                                        Doe</small>
                                    <small class="text-body"><i class="fa fa-star text-primary mr-2"></i>4.5
                                        (250)</small>
                                </div>
                            </div>
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('send').onclick = function() {
            value = document.getElementById('comment').value;
            console.log(value);
            fetch("/courses/{{ $course->id }}/send-comment?_token={{ csrf_token() }}&comment=" + value, {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    // 'url': '/payment',
                    // "X-CSRF-Token": document.querySelector('input[name=_token]').value
                },
            }).then(response => {
                // console.log(response);
                if (response.status == 201) {
                    document.getElementById('ul-comment').innerHTML += ` <li>
                                <div class="name-cooment">
                                    <h5>{{ auth()->user()?->name }} </h5>
                                    <time>{{ (new \Carbon\Carbon())->diffForHumans() }}</time>
                                </div>
                                <p>${value}</p>
                            </li>`;
                    document.getElementById('comment').value = '';
                }
            });
        }
    </script>
</x-front.layout>
