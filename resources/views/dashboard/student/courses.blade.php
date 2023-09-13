<x-dashboard.layout title='Courses' :items="['Courses']">
    <style>
        section.show .header {
            background-color: #2878EB;
            color: #fff;
            padding: 25px 40px;
            padding-right: 0;
            border-top-right-radius: 12px;
            border-top-left-radius: 12px;
            font-size: 20px;
            font-weight: 500;
            text-align: left;
        }

        section.show .body {
            color: #666;
            padding: 25px 40px;
            padding-right: 0;
            text-align: left;
            font-size: 18px;
        }

        section.show .body-bg-one {
            background-color: #ddd;
        }

        section.show .body-bg-two {
            background-color: #fff;
        }

        section.show .header span,
        section.show .body span {
            display: inline-block;
            text-transform: capitalize;
            width: calc((100% - 160px) / 3);
            /* background: red; */
        }

        section.show .header span.status,
        section.show .body span.status {
            width: 140px;
            text-align: center;
        }

        section.show .search {
            /* display: flex;
            justify-content: space-between;
            align-items: center; */
            margin-bottom: 25px;
        }

        /* section.show .search a {
            text-transform: capitalize;
            border: 2px solid #2878EB;
            padding: 8px 15px;
            border-radius: 7px;
            transition: 0.5s;
            font-weight: 500px;
        } */

        /* section.show .search a:hover {
            color: #fff;
            background-color: #2878EB;
        } */

        section.show .search form {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: fit-content;
            margin-left: auto;
            /* margin-right: auto; */
        }

        section.show .search form input,
        section.show .search form select {
            height: 40px;
            padding: 5px;
            outline: none;
            color: #7e7582;
            border: 2px solid #2878EB;
            border-radius: 5px;
            width: 270px;
        }

        section.show .search form select {
            color: #7e7582;
        }

        section.show .search form button {
            border: 2px solid #2878EB;
            padding: 0px 20px;
            height: 40px;
            color: #fff;
            background: #2878EB;
            border-radius: 20px;
            margin-left: 10px;
            width: 150px;
            text-transform: uppercase;
        }

        section.show .message {
            color: #2878EB;
            font-size: 40px;
            margin-top: 150px;
            text-align: center;
        }

        /*
        .status i {
            border: 2px solid #2878EB;
            padding: 5px 12px;
            border-radius: 5px;
            color: #2878EB;
        } */

        section.show a.a {
            text-transform: capitalize;
            display: inline-block;
            border: 2px solid #2878EB;
            padding: 8px 15px;
            border-radius: 7px;
            transition: 0.5s;
            font-weight: 500px;
            margin-bottom: 25px;

        }

        section.show a.a:hover {
            color: #fff;
            background-color: #2878EB;
        }

        .star i.far {
            color: #666666;
        }

        .star i.fas {
            color: #FF9800;
        }

        /* .star i.far:hover {
            color: yellow;
        } */

        .star i {
            cursor: pointer;
            display: inline-block;
            margin-left: 4px;
            transition: 0.5s;
        }
    </style>
    <section class="show">
        <a class="a" href="{{ route('student.testimonials.create') }}">Watch The Latest Courses</a>
        @if (count($courses))
            <div class="header">
                <span>number</span>
                <span>course name</span>
                <span>instructor name</span>
                <span class="status">rating</span>
                {{-- <span>number of </span> --}}
            </div>
            @php
                $number = 0;
                $array = [];
            @endphp
            @foreach ($courses as $course)
                {{-- {{dd($course->students()->where('user_id',auth()->user()->id)->first()->pivot->rating)}} --}}
                {{-- {{dd($course->pivot->rating)}} --}}
                <div class="body {{ ++$number % 2 == 0 ? 'body-bg-two' : 'body-bg-one' }}">
                    <span>{{ $number }}</span>
                    <span>{{ $course->name }}</span>
                    <span style="">{{ $course->user->name }}</span>
                    <span class="status"style="position: relative;">
                        <a class="star status-{{ $number }}" style="" id="star"
                            data-id="{{ $course->id }}">
                            @for ($i = 0; $i < 5; $i++)
                                <i
                                    class="far {{ $course->pivot->rating > $i ? 'fas' : '' }} fa-star status-{{ $number }}-{{ $i }}"></i>
                            @endfor

                            @php
                                $array[] = $course->pivot->rating;
                            @endphp
                            {{-- <i class="far fa-star status-{{ $number }}-1"></i> --}}
                            {{-- <i class="far fa-star status-{{ $number }}-2"></i> --}}
                            {{-- <i class="far fa-star status-{{ $number }}-3"></i> --}}
                            {{-- <i class="far fa-star status-{{ $number }}-4"></i> --}}
                        </a>
                    </span>
                </div>
            @endforeach
        @else
            <div class="message ">You Did Not Participate In Any Course</div>
        @endif
    </section>
    <div class="mt-4">
        {{ $courses->withQueryString()->links() }}
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            $length = document.getElementsByClassName('star').length;
            for (let i = 0; i < $length; i++) {
                for (let j = 0; j < 5; j++) {
                    const elements = document.getElementsByClassName(`status-${i}-${j}`);
                    if (elements.length > 0) {
                        var value = 0;
                        elements[0].onclick = function() {
                            for (let k = 0; k <= --j; k++) {
                                console.log(elements[k]);
                                elements[k].classList.add('fas');
                            }
                        }
                        // elements[0].onmouseover = function() {
                        //     for (let k = 0; k <= j; k++) {
                        //         console.log(elements[k]);
                        //         elements[k].classList.add('fas');
                        //     }
                        // }
                        // elements[0].onmouseout = function() {
                        //     this.classList.remove('fas');
                        // };
                    } else {
                        console.log(`No element found with class 'status-${i}-${j}'.`);
                    }
                }
            }
        });
    </script> --}}
    @if (count($courses))
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script>
            // implode()

            document.onclick = function() {
                console.log($value);
            }
        </script>
        <script>
            const _token = "{{ csrf_token() }}";
            document.addEventListener('DOMContentLoaded', function() {
                var $array = [];
                $value = "{{ implode(',', $array) }}";
                $rating_value = $value.split(',');
                for (let number = 1; number <= $rating_value.length; number++) {
                    $array[number] = $rating_value[number - 1];
                }
                stars = document.getElementsByClassName('star');
                $length = stars.length;
                // $array = [];
                for (let i = 1; i <= $length; i++) {
                    for (let j = 0; j < 5; j++) {
                        const elements = document.getElementsByClassName(`status-${i}-${j}`);
                        let numberOfIcons = 0;
                        elements[0].onmouseover = function() {
                            for (num = 0; num <= j; num++) {
                                document.getElementsByClassName(`status-${i}-${num}`)[0].classList.add('fas');
                            }
                        }
                        elements[0].onclick = function() {
                            $array[i] = j + 1;
                            const rating = j + 1;
                            const id = stars[i - 1].dataset.id;
                            console.log('hi');
                            for (let k = 0; k < 5; k++) {
                                document.getElementsByClassName(`status-${i}-${k}`)[0].classList.remove('fas');
                            }
                            for (num = 0; num <= j; num++) {
                                document.getElementsByClassName(`status-${i}-${num}`)[0].classList.add('fas');
                            }

                            fetch(`/student/dashboard/courses/${id}/update?_token=${_token}&rating=${rating}`, {
                                    method: "put",
                                })
                                .then((response) => {
                                    console.log(response);
                                });

                        }
                        elements[0].onmouseout = function() {
                            for (num = 0; num <= j; num++) {
                                document.getElementsByClassName(`status-${i}-${num}`)[0].classList.remove('fas');
                            }
                            for (let h = 0; h < $array[i]; h++) {
                                for (num = 0; num <= h; num++) {
                                    document.getElementsByClassName(`status-${i}-${num}`)[0].classList.add('fas');
                                }
                            }
                            this.style.color = '';
                        }
                    }
                }
            })
        </script>
    @endif
    {{-- <script>
        fetch(`/student/dashboard/courses/${id}/update`, {
                method: "put",
                headers: {
                    // 'Accept': 'application/json',
                    // 'Content-Type': 'application/json'
                },

                //make sure to serialize your JSON body
                // body: JSON.stringify({
                //     name: myName,
                //     password: myPassword
                // })
            })
            .then((response) => {
                //do something awesome that makes the world a better place
            });
    </script> --}}
</x-dashboard.layout>
