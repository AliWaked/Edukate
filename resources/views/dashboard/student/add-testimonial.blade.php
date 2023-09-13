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

        form .form-input {
            display: flex;
            justify-content: space-between;
            margin-left: 120px;
            margin-bottom: 25px;
            align-items: center;
        }

        section.show form .form-input label {
            margin-top: -5px;
            font-size: 30px;
            text-transform: capitalize;
            float: left;
            width: 150px;
        }

        section.show form .form-input input,
        section.show form .form-input textarea {
            width: 450px;
            /* background-color: #2878EB; */
            border: solid 3px #2878EB;
            outline: none;
            border-radius: 5px;
            height: 50px;
            font-size: 18px;
            color: #808080d6;
            padding: 5px;
        }

        section.show form .form-input textarea {
            height: 250px;
            resize: none;
        }

        section.show form {
            position: relative;
        }

        section.show button[type='submit'] {
            position: absolute;
            background-color: transparent;
            border: none;
            color: #2878EB;
            top: 270px;
            left: 800px;
            font-size: 40px;

        }
    </style>
    <section class="show">
        <a href="{{ route('student.testimonials.index') }}">back</a>
        <form action="{{ route('student.testimonials.store') }}" method="post">
            @csrf
            <div class="form-input">
                <x-dashboard.partials.input name='title' label='title' id='title' :required='true' />
            </div>
            <div class="form-input">
                <x-dashboard.partials.textarea name='content' label='content' id='content' :required='true' />
            </div>
            <button type='submit'><i class='fas fa-paper-plane'></i></button>
        </form>
    </section>
</x-dashboard.layout>
