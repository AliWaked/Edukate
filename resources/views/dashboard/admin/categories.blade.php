<x-dashboard.layout title='Categories' :items="['Categories']">

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
            display: inline-flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        section.show .search a {
            text-transform: capitalize;
            border: 2px solid #2878EB;
            padding: 8px 15px;
            border-radius: 7px;
            transition: 0.5s;
            font-weight: 500px;
        }

        section.show .search a:hover {
            color: #fff;
            background-color: #2878EB;
        }

        section.show .search form input {
            height: 40px;
            padding: 5px;
            outline: none;
            color: #2878EB;
            border: 2px solid #2878EB;
            border-radius: 5px;
        }

        section.show .search form button {
            border: 2px solid #2878EB;
            padding: 0px 20px;
            height: 40px;
            color: #fff;
            background: #2878EB;
            border-radius: 20px;
            margin-left: 10px;
            text-transform: uppercase;
        }

        section.show .message {
            color: #2878EB;
            font-size: 40px;
            margin-top: 150px;
            text-align: center;
        }

        .status.draft {
            color: #fff;
            /* background: rgb(56, 54, 54); */
            background: red;
            padding: 0px 15px;
            border-radius: 5px;
            box-shadow: #222 -1px 2px 12px -4px;
            cursor: default;
            user-select: none;
        }

        .status.active {
            color: #fff;
            /* background: #4CAF50; */
            background: #4CAF50;
            padding: 0px 15px;
            border-radius: 5px;
            box-shadow: #222 -9px 5px 18px -9px;
            cursor: default;
            user-select: none;
        }
    </style>



    <section class="show">
        <div class="search"><a href="{{ route('dashboard.category.create') }}">add category</a></div>
        @if (count($categories))
            <div class="search" style="float: right">
                <form action="{{ URL::current() }}"method='get'>
                    <input type="text" name="filter" value="{{ $filter }}" placeholder="Search For Category">
                    <button type="submit">search</button>
                </form>
            </div>
            <div class="header">
                <span>category ID</span>
                <span>category name</span>
                <span>category description</span>
                <span class="status">status</span>
                {{-- <span>number of </span> --}}
            </div>
            @php
                $number = 1;
            @endphp
            @foreach ($categories as $category)
                <div class="body {{ $number++ % 2 == 0 ? 'body-bg-two' : 'body-bg-one' }}">
                    <span>{{ $category->id }}</span>
                    <span>{{ $category->name }}</span>
                    <span>{{ $category->description }}</span>
                    <span class="status {{ $category->status }}">
                        <a href="{{ route('dashboard.category.edit', $category->id) }}"
                            style="color:#fff;">{{ $category->status }}</a>
                    </span>
                </div>
            @endforeach
        @else
            <div class="message ">No Categories Found</div>
        @endif
    </section>
    {{-- <div style="color:red; font-size:50px;" id="click-hear"> click</div> --}}
    <div class="mt-4">
        {{ $categories->withQueryString()->links() }}
    </div>


</x-dashboard.layout>
