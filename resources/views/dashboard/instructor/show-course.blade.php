<x-dashboard.layout title='Show Course Details' :items="['My Courses', $course->name]">
    <style>
        section.show .back a {
            text-transform: capitalize;
            border: 2px solid #2878EB;
            padding: 8px 15px;
            border-radius: 7px;
            transition: 0.5s;
            font-weight: 500px;
        }

        section.show {
            margin: 0;
            padding-bottom: 30px;
        }

        .course-info {
            position: relative;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }

        h1.name {
            margin-top: 25px;
            /* width: 70%; */
            color: #666;
            font-size: 35px;
            /* text-align: center; */
        }

        h1.name span {
            color: #2878EB;
            margin-left: 15px;
            display: inline-block;
        }

        .course-info img {

            /* margin-left: auto;
            margin-right: auto; */
            width: 100%;
            display: block;
            max-height: 400px;
            margin-top: 25px;
            margin-bottom: 30px;

        }

        .title {
            color: #666;
            font-weight: bold;
            font-size: 25px;
        }

        span.content {
            border: #3F51B5 solid 2px;
            margin-top: 20px;
            border-radius: 5px;
            padding: 20px 30px;
            display: block;
            color: #2878EB;
            font-size: 18px;
            word-wrap: break-word;
            /* text-transform: capitalize; */
            /* max-height: 400px;
            overflow-y: scroll; */
        }

        span.single {
            margin-left: 40px;
            color: #2878EB;
            font-size: 18px;
            text-transform: capitalize;
            display: inline-block;
            width: 35%;
            text-align: left;
            float: right;
        }

        p.border-botto {
            border-bottom: 2px #3F51B5 solid;
            padding-bottom: 22px;
            padding-top: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h2.header {
            letter-spacing: 12px;
            font-size: 35px;
            /* font-weight: normal; */
            color: #9E9E9E;
            font-style: italic;
            text-align: center;
            /* border-left: solid red 2px; */
            /* border-right: solid red 2px; */
            /* width: fit-content; */
            padding-bottom: 25px;
            padding-top: 60px;
        }

        div.lesson-name {
            color: #3F51B5;
            font-size: 25px;
            text-transform: capitalize;
            margin-bottom: 20px;
            font-weight: 500;
        }

        ul {
            list-style: none;
        }

        ul li span.name-lesson {
            color: #2878EB;
            font-size: 18px;
            display: inline-block;
            width: 85%;
            text-transform: capitalize;
            margin-bottom: 15px;
        }

        ul li .click {
            color: #2878EB;
            font-size: 14px;
            cursor: pointer;
            display: inline-block;
            border-radius: 5px;
            padding: 8px;
            transition: 0.3s;
        }

        ul li .click:hover {
            color: red;
            /* background-color: red; */
        }

        span.span-video .overlap {
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0%;
            z-index: 50000;
            background-color: #9e9e9e21;
            position: fixed;
        }

        i.close {
            color: #333;
            font-size: 24px;
            position: fixed;
            top: 5%;
            left: 95%;
            z-index: 50000;
            transition: 0.5s;
            cursor: pointer;
        }

        i.close:hover {
            color: red;
        }

        video.video {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 100vw;
            z-index: 500000;
            max-height: 98vh
        }

        video.video::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: red;
        }
    </style>
    <section class="show">
        <div class="back">
            @if (config('fortify.guard') == 'admin')
                <a href="{{ route('dashboard.course.index') }}">back</a>
            @else
                <a href="{{ route('dashboard.instructor.course.index') }}">back</a>
            @endif
        </div>
        <div class="course-info">
            <h1 class="name">Course Name:<span>{{ $course->name }}</span></h1>
            <img src="{{ asset('storage/' . $course->course_image) }}" alt="course image">
            <p class="border-botto"><span class="title">Category Name:</span> <span
                    class="single">{{ $course->category->name }}</span></p>
            <p class="border-botto"><span class="title">Course Price:</span> <span
                    class="single">${{ $course->price ?? 55 }}</span></p>
            <p class="border-botto"><span class="title">Skill Level:</span> <span
                    class="single">{{ $course->skill_level }}</span></p>
            <p class="border-botto"><span class="title">Langouage:</span> <span
                    class="single">{{ $course->language }}</span></p>
            <p class="border-botto"><span class="title">Number Of Student:</span> <span
                    class="single">{{ $numberOfStudents }}</span></p>
            <p class="border-botto"><span class="title">Rating:</span> <span
                    class="single">{{ round($numberOfStars / $numberOfStudents, 2) }}</span>
            </p>
            <p class="border-botto"><span class="title">Number Of Lesson:</span> <span
                    class="single">{{ count($course->section) }}</span></p>
            <p class="border-botto"><span class="title">Number Of Lecuers:</span> <span
                    class="single">{{ $lecucterCount }}</span></p>
            <p><span class="title">Course Description:</span> <span class="content">{{ $course->descriptions }}</span>
            </p>
        </div>
        <div class="course-info">
            <h2 class="header">Course Content</h2>
            <p class="lessons">
                @foreach ($course->section as $section)
                    <div class="lesson-name">{{ $section->lesson_title }}</div>
                    <ul>
                        @foreach ($section->lectures as $key => $value)
                            <li>
                                <span class="name-lesson">{{ $key }}</span>
                                <span class="click show-video" style="margin-left: 15px;">Show</span>
                                <span class="span-video">
                                    <div class="overlap" hidden></div>
                                    <i class="fas fa-times-circle close" hidden></i>
                                    <video src="{{ asset('storage/' . $value) }}" class="video" controls
                                        hidden></video>
                                </span>
                            </li>
                        @endforeach
                        <li>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem et quisquam officiis facilis corrupti reiciendis iste magni beatae odio, cumque reprehenderit alias tempora doloribus at a deserunt ullam corporis voluptatem.
                            <ul>
                                @if ($section->attachments)
                                    @foreach ($section->attachments as $key => $value)
                                        <li>
                                            <span
                                                class="name-lesson">{{ $file_name = str_split($key, strrpos($key, '*'))[0] }}</span>
                                            <a href="{{ route('dashboard.course.download', "path=$value&file_name=$file_name") }}"
                                                class="click">download</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    </ul>
                @endforeach
            </p>
            {{-- <h2 class="header" style="padding-top: 15px;">Attachments</h2> --}}
        </div>
    </section>
    <script>
        clicks = document.getElementsByClassName('show-video');
        videos = document.getElementsByClassName('video');
        closes = document.getElementsByClassName('close');
        overlaps = document.getElementsByClassName('overlap');
        for (let i = 0; i < clicks.length; i++) {
            num = i;
            clicks[i].onclick = function() {
                // console.log(i,num,overlaps[i]);
                console.log(videos, clicks);
                video = videos[i];
                overlaps[i].hidden = false;
                closes[i].hidden = false;
                video.autoplay = true;
                video.hidden = false;
                video.load();
                body = document.querySelector('body').style.overflow = 'hidden';
            }
            closes[i].onclick = function() {
                video = videos[i];
                overlaps[i].hidden = true;
                closes[i].hidden = true;
                video.hidden = true;
                video.pause();
                // stopVideo();
                body = document.querySelector('body').style.overflowY = 'scroll';
            }
        }
    </script>
    </x-dashbaord.layout>
