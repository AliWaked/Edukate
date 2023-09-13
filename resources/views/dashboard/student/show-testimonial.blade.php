<x-dashboard.layout title='Send New Feedback' :items="['Show Feedbacks', 'Create New Feedback']">
    <style>
        section.show a {
            text-transform: capitalize;
            display: inline-block;
            border: 2px solid #2878EB;
            padding: 8px 15px;
            border-radius: 7px;
            transition: 0.5s;
            font-weight: 500px;
            margin-bottom: 25px;

        }

        section.show a:hover {
            color: #fff;
            background-color: #2878EB;
        }

        div.content {
            border: 4px solid #2878EB;
            padding: 35px 46px;
            border-radius: 3px;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
            min-height: 250px;
            margin-bottom: 120px;
        }

        div.span {
            display: flex;
            justify-content: space-between;
            text-transform: capitalize;
            font-size: 25px;
            color: #3F51B5;
            margin-bottom: 20px;
        }

        p {
            color: gray;
            color: #666;
            font-size: 17px;
            line-height: 1.8;
        }
    </style>
    <section class="show">
        <a href="{{ route('student.testimonials.index') }}">back</a>
        <div class="content">
            <div class="span"><span>{{$testimonial->title}}</span><span>{{(new \Carbon\Carbon($testimonial->created_at))->diffForHumans(['part'=>4,'join'=>','])}}</span></div>
            <p>
                {{$testimonial->content}}
            </p>
        </div>
    </section>
</x-dashboard.layout>
