<x-dashboard.layout title='Courses' :items="['My Courses']">
    <style>
        section.show .header {
            background-color: #2878EB;
            color: #fff;
            padding: 25px 40px;
            padding-right: 0;
            border-top-right-radius: 12px;
            border-top-left-radius: 12px;
            font-size: 18px;
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
            width: calc((100% - 40px) / 7);
            text-wrap: nowrap;
            /* background: red; */
        }

        section.show .search {
            display: inline-flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            float: right;
        }

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

        section.show .search form input,
        section.show .search form select {
            height: 40px;
            padding: 5px;
            outline: none;
            color: #7e7582;
            border: 2px solid #2878EB;
            border-radius: 5px;
            width: 200px;
        }

        section.show .search form select {
            margin-right: 15px;
        }

        section.show .search form button {
            border: 2px solid #2878EB;
            padding: 0px 20px;
            height: 40px;
            color: #fff;
            background: #2878EB;
            border-radius: 20px;
            margin-left: 10px;
        }

        .span-form {
            display: flex;
        }

        .span-form form {
            display: inline;
            align-items: center;
            /* margin-left: 10px; */
        }

        .span-form form button {
            border: none;
            background: transparent;
            border-radius: 6px;
            padding: 5px 12px;
            transition: 0.3s;
        }

        .span-form form button.show {
            color: #3ca540;
        }

        .span-form form button.show:hover {
            background: #4caf5066;
        }

        .span-form form button.edit {
            color: #fd7e14;
        }

        .span-form form button.edit:hover {
            background: #ff980070;
        }

        .span-form form button.delete {
            color: #d31a1a;
        }

        .span-form form button.delete:hover {
            background: #ff000054;
        }

        .status.draft,
        .status.active {
            color: #fff;
            font-size: 14px;
            background: red;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
            padding: 5px;
            border-radius: 5px;
            /* box-shadow: #222 -1px 2px 12px -4px; */
            cursor: pointer;
            user-select: none;
        }

        .status.active {
            background: #4CAF50;
            /* box-shadow: #222 -9px 5px 18px -9px; */
        }

        .message {
            color: #2878EB;
            font-size: 40px;
            margin-top: 150px;
            text-align: center;
        }
    </style>

    <section class="show pb-4">
        <a href="{{ route('dashboard.course.create') }}">add courses</a>
        @if (count($courses))
            <div class="search">
                <form action=""method='get'>
                    <select name="course" id="">
                        <option value="kakd">Ranking Of Students</option>
                        <option value="kakd">ascending</option>
                        <option value="kakd">Desending</option>
                    </select>
                    <input type="text" placeholder="search for courses">
                    <button type="submit">search</button>
                </form>
            </div>
            <div class="header">
                <span>course number</span>
                <span>course name</span>
                <span>category name</span>
                <span>created by</span>
                <span>number of student</span>
                <span style="text-align: center">status</span>
                <span>Action</span>
            </div>
            @php
                $num = 0;
            @endphp
            @foreach ($courses as $course)
                <div class="body @if (++$num % 2 == 0) body-bg-two @else body-bg-one @endif">
                    <span style="">{{ $num }}</span>
                    <span>{{ $course->name }}</span>
                    <span>{{ $course->category->name }}</span>
                    <span
                        style="{{ $course->user instanceof \App\Models\Admin ? 'color:green;' : '' }}">{{ $course->user->name }}</span>
                    <span style="text-align:center">{{ count($course->students) }}</span>
                    <span style="text-align: center;">
                        <form
                            action="{{ route('dashboard.course.update', $course->id) }}?status={{ $course->status == 'acceptable' ? 'not acceptable' : 'acceptable' }}"
                            method="post">
                            @csrf
                            @method('put')
                            {{-- <button type="submit" class="edit"><i class="fas fa-pen"></i></button> --}}
                            <div onclick="this.parentNode.submit()"
                                class="status {{ $course->status == 'not acceptable' ? 'draft' : 'active' }}">
                                {{ $course->status }}</div>
                        </form>
                    </span>
                    <span class="span-form">
                        <form action="{{ route('dashboard.course.show', $course->slug) }}" method="get">
                            @csrf
                            <button type="submit" class="show"><i class="fas fa-eye"></i></button>
                        </form>
                        <form action="{{ route('dashboard.course.edit', $course->slug) }}" method="get">
                            {{-- @csrf --}}
                            {{-- @method('put') --}}
                            <button type="submit" class="edit"><i class="fas fa-pen"></i></button>
                        </form>
                        <form action="{{ route('dashboard.course.destroy', $course->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </span>
                </div>
            @endforeach
        @else
            <div class="message ">No Courses Found</div>

        @endif
    </section>
</x-dashboard.layout>
