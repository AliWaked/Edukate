<x-dashboard.layout title='Send New Feedback' :items="['Show Feedbacks', 'Create New Feedback']">
    <style>
        section.show a.back,
        section.show a.delete {
            text-transform: capitalize;
            display: inline-block;
            border: 2px solid #2878EB;
            padding: 8px 15px;
            border-radius: 7px;
            transition: 0.5s;
            font-weight: 500px;
            margin-bottom: 25px;

        }

        section.show a.delete {
            border: 2px solid red;
            color: red;
        }

        section.show a.back:hover,
        section.show a.delete:hover {
            color: #fff;
            background-color: #2878EB;
        }

        section.show a.delete:hover {
            background-color: red;
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

        div.info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 25px;
            padding-bottom: 20px;
        }

        .action {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 95%;
            margin: 15px auto;
        }
    </style>
    <section class="show">
        <div class="action">
            <a href="{{ route('dashboard.testimonials.index') }}" class="back">back</a>
            <a style="font-size:30px; color:#E91E63; margin-bottom:20px;">
                <i class="far fa-heart {{ $testimonial->favourite ? 'fas' : '' }}" onclick="this.classList.toggle('fas')"
                    id="status" data-id="{{ $testimonial->id }}"></i></a>
            <form action="{{ route('dashboard.testimonials.delete', $testimonial->id) }}" method="post">
                @csrf
                @method('delete')
                <a onclick="this.parentNode.submit()" style="cursor: pointer;" class="delete">delete</a>
            </form>
        </div>
        <div class="content">
            <div class="info"><span style="color:#E91E63;font-style:italic;">Created By </span> <span
                    style="color:#009688; border-bottom:#009688 2px solid;">{{ $testimonial->student->name }}</span>
            </div>
            <div class="span">
                <span>{{ $testimonial->title }}</span><span>{{ (new \Carbon\Carbon($testimonial->created_at))->diffForHumans(['part' => 4, 'join' => ',']) }}</span>
            </div>
            <p>
                {{ $testimonial->content }}
            </p>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        const _token = "{{ csrf_token() }}";
        (function($) {
            $('#status').on('click', function(e) {
                $.ajax({
                    url: `/admin/dashboard/feedbacks/${$(this).data('id')}/update`,
                    method: 'put',
                    data: {
                        '_token': _token,
                    },
                    success: function(response) {
                        // this.toggle('fas'),
                        console.log(response);
                    }
                })
            })
        })(jQuery)
    </script>
</x-dashboard.layout>
