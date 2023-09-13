<x-dashboard.layout title='Add Categories' :items="['Categories', 'Add Categories']">
    <style>
        section.add .back a {
            text-transform: capitalize;
            border: 2px solid #2878EB;
            padding: 8px 15px;
            border-radius: 7px;
            transition: 0.5s;
            font-weight: 500px;
        }

        section.add .back a:hover {
            color: #fff;
            background-color: #2878EB;
        }

        section.add form.add-category {
            margin-top: 20px;
        }

        section.add form.add-category label {
            display: block;
            font-size: 20px;
            font-weight: 500;
        }

        section.add form.add-category input,
        section.add form.add-category textarea {
            margin-top: 5px;
            height: 40px;
            padding: 5px;
            outline: none;
            color: #2878EB;
            border: 2px solid #2878EB;
            border-radius: 5px;
            width: 300px;
        }

        section.add form.add-category textarea {
            height: 120px;
            resize: none;
        }

        section.add form.add-category button {
            border: 2px solid #2878EB;
            padding: 0px 20px;
            margin-top: 15px;
            width: 300px;
            height: 50px;
            color: #fff;
            background: #2878EB;
            text-transform: capitalize;
            font-size: 20px;
        }
    </style>
    <section class="add">
        @php
            if (
                auth()
                    ->guard('admin')
                    ->user()
            ) {
                $back = 'dashboard.category.index';
                $route = 'dashboard.category.store';
            } else {
                $back = 'dashboard.instructor.category.index';
                $route = 'dashboard.instructor.category.store';
            }
        @endphp
        <div class="back">
            <a href="{{ route($back) }}">back</a>
        </div>
        <form action="{{ route($route) }}"method='post' class="add-category">
            @csrf
            <x-dashboard.partials.input name='en[name]' label='Category Name' id='en[name]' :required="true"
                value="{{ old('name') }}" />
            <x-dashboard.partials.textarea id='en[description]' name='en[description]' label='Description' />
            <x-dashboard.partials.input name='ar[name]' label='Category Name' id='ar[name]' :required="true"
                value="{{ old('name') }}" />
            <x-dashboard.partials.textarea id='ar[description]' name='ar[description]' label='Description' />
            <button type="submit">create category</button>
        </form>
    </section>
</x-dashboard.layout>
