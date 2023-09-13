<x-dashboard.layout title='My Students' :items="['My Students']">
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
            width: calc((100% - 100px) / 3);
            /* background: red; */
        }

        section.show .header span.status,
        section.show .body span.status {
            width: 80px;
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
            width: 70%;
            margin-left: auto;
            margin-right: auto;
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

        .status .number {
            color: #fff;
            background: #FF9800;
            font-size: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            box-shadow: #222 -9px 5px 18px -9px;
            cursor: pointer;
            position: absolute;
            left: 25px;
            top: 2px;
            /* user-select: none; */
        }
    </style>
    <section class="show">
        @if (count($courses))
            <div class="search">
                <form action="{{ URL::current() }}"method='get'>
                    {{-- <x-dashboard.partials.select :items="$courses" name='course' :value="$course" class="mb-3" /> --}}
                    <input type="text" name="filter" value="{{ $filter }}"
                        placeholder="Search For A Specific Student">
                    <button type="submit">search</button>
                </form>
            </div>
            <div class="header">
                <span>number</span>
                <span>student name</span>
                <span>course name</span>
                <span class="status">Notices</span>
                {{-- <span>number of </span> --}}
            </div>
            @php
                $number = 1;
            @endphp
            @foreach ($courses as $course)
            @foreach ($course->students as $student )
                    <div class="body {{ $number++ % 2 == 0 ? 'body-bg-two' : 'body-bg-one' }}">
                    <span>{{ $number - 1 }}</span>
                    <span>{{ $student->name }}</span>
                    <span>{{ $course->name }}</span>
                    <span class="status" style="position: relative;">
                        {{-- <div class="number">1</div> --}}
                        <a href="" style="color:#009688"><i class="far fa-bell" style="font-size: 30px;"></i></a>
                    </span>
                </div>
            @endforeach
                
            @endforeach
        @else
            <div class="message ">No Students Found</div>
        @endif
    </section>
    <div class="mt-4">
        {{ $courses->withQueryString()->links() }}
    </div>
</x-dashboard.layout>
