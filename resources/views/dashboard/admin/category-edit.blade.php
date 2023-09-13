<x-dashboard.layout title='Edit Category' :items="['Categories', 'Edit']">
    <style>
        section.add .back {
            display: flex;
            align-items: center;
        }

        section.add .back a.return {
            text-transform: capitalize;
            border: 2px solid #2878EB;
            padding: 8px 15px;
            border-radius: 7px;
            transition: 0.5s;
            font-weight: 500px;
        }

        section.add .back a.return:hover {
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
        section.add form.add-category select,
        section.add form.add-category textarea {
            margin-top: 5px;
            height: 50px;
            padding: 5px;
            outline: none;
            color: #2878EB;
            border: 2px solid #2878EB;
            border-radius: 5px;
            width: 524px;
            font-size: 18px;
        }

        section.add form.add-category textarea {
            height: 150px;
            resize: none;
        }

        section.add form.add-category button {
            border: 2px solid #2878EB;
            padding: 0px 20px;
            margin-top: 15px;
            width: 524px;
            height: 55px;
            margin-bottom: 15px;
            color: #fff;
            background: #2878EB;
            text-transform: capitalize;
            font-size: 20px;
        }

        a.delete {
            text-transform: capitalize;
            border: 2px solid red;
            color: red;
            margin-left: 150px;
            padding: 8px 15px;
            border-radius: 7px;
            transition: 0.5s;
            font-weight: 500px;
            margin-top: 5px;
        }

        a.delete:hover {
            color: #fff;
            background-color: red;
        }

        a.accept {
            text-transform: capitalize;
            border: 2px solid #4CAF50;
            color: #4CAF50;
            margin-left: 150px;
            padding: 8px 15px;
            border-radius: 7px;
            transition: 0.5s;
            font-weight: 500px;
            margin-top: 5px;
        }

        a.accept.draft {
            border: 2px solid #777;
            color: #777;
        }

        a.accept:hover {
            color: #fff;
            background-color: #4CAF50;
        }

        a.accept.draft:hover {
            color: #fff;
            background-color: #777;
        }
    </style>
    <section class="add">
        <div class="back">
            <a href="{{ route('dashboard.category.index') }}" class="return">back</a>
            <form action="{{ route('dashboard.category.update', $category->id) }}" method="POST">
                @csrf
                @method('put')
                <a href="#" onclick="this.parentNode.submit()"
                    class="accept {{ $category->status == 'draft' ?: 'draft' }}">{{ $category->status == 'draft' ? 'Accept' : 'make draft' }}</a>
            </form>
            <form action="{{ route('dashboard.category.destroy', $category->id) }}" method="POST">
                @csrf
                @method('delete')
                <a href="#" onclick="this.parentNode.submit()" class="delete">delete</a>
            </form>
        </div>
        <form action="{{ route('dashboard.category.update', $category->id) }}"method='post' class="add-category">
            @csrf
            @method('put')
            <x-dashboard.partials.input name='en[name]' label='Category Name' id='name'
                value="{{ old('name', $category->name) }}"  />
            <x-dashboard.partials.input  disabled label='Created By' id='name'
                value="{{ old('name',$creating_by) }}" />
            <x-dashboard.partials.textarea id='en[description]'  name='en[description]' label='Description'
                :value="old('description', $category->description)" />
            <x-dashboard.partials.input name='ar[name]' label='Category Name' id='name'
                value="{{ old('name', $category->translate('ar')->description) }}"  />
            <x-dashboard.partials.textarea id='ar[description]'  name='ar[description]' label='Description'
                :value="old('description', $category->translate('ar')->description)" />
            <button type="submit">Update The Category</button>
        </form>
    </section>
</x-dashboard.layout>
