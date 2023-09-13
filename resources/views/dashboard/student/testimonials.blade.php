<x-dashboard.layout title='Feedbacks' :items="['Show Feedbacks']">
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

        .status i {
            border: 2px solid #2878EB;
            padding: 5px 12px;
            border-radius: 5px;
            color: #2878EB;
        }

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
    </style>
    <section class="show">
        <a class="a" href="{{ route('student.testimonials.create') }}">send feedback</a>
        @if (count($testimonials))
            <div class="header">
                <span>number</span>
                <span>title</span>
                <span>date</span>
                <span class="status">Show</span>
            </div>
            @php
                $number = 0;
            @endphp
            @foreach ($testimonials as $testimonial)
                <div class="body {{ ++$number % 2 == 0 ? 'body-bg-two' : 'body-bg-one' }}">
                    <span>{{ $number }}</span>
                    <span>{{ $testimonial->title }}</span>
                    <span style="">{{ (new \Carbon\Carbon($testimonial->created_at))->diffForHumans() }}</span>
                    <span class="status" style="position: relative;">
                        <a href="{{ route('student.testimonials.show', $testimonial->id) }}" style=""><i
                                class="fas fa-eye" title="View Profile" style="font-size: 30px;"></i></a>
                    </span>
                </div>
            @endforeach
        @else
            <div class="message ">No Feedback</div>
        @endif
    </section>
    <div class="mt-4">
        {{-- {{ $students->withQueryString()->links() }} --}}
    </div>
</x-dashboard.layout>
