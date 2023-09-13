<x-dashboard.layout title='Edit Section' :items="['courses', 'section', 'edit section']">
    <style>
        section .back a {
            text-transform: capitalize;
            border: 2px solid #2878EB;
            padding: 8px 15px;
            border-radius: 7px;
            transition: 0.5s;
            font-weight: 500px;
        }

        section form {
            margin-top: 20px;
        }

        section form label {
            display: block;
            font-size: 20px;
            font-weight: 500;
        }

        section form input,
        section form select,
        section form textarea {
            margin-top: 5px;
            height: 40px;
            padding: 5px;
            outline: none;
            color: #2878EB;
            border: 2px solid #2878EB;
            border-radius: 5px;
            width: 300px;
        }

        section form textarea {
            height: 120px;
            resize: none;
        }

        section form button {
            border: 2px solid #2878EB;
            padding: 0px 20px;
            margin-top: 15px;
            width: 300px;
            height: 50px;
            color: #fff;
            background: #2878EB;
            text-transform: capitalize;
            font-size: 20px;
            margin-bottom: 15px;
        }

        video {
            width: 300px;
            /* height: 500px; */
        }
    </style>
    <section>
        <div class="back" style="width: 300px; display:flex; justify-content:space-between; align-items:center;">
            @if (Config::get('fortify.guard') == 'admin')
                <a href="{{ route('dashboard.course.edit', $slug) }}">back</a>
                <a href="{{ route('dashboard.course.section.create', $slug) }}"
                    style="color:#4CAF50;border-color:#4CAF50;">add
                    lessons</a>
            @else
                <a href="{{ route('dashboard.course.edit', $slug) }}">back</a>
            @endif
        </div>
        <form action="{{ route('dashboard.course.section.update', $slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="content-lesson" id="content-lesson">
                @php
                    $number = 0;
                @endphp
                @foreach ($sections as $section)
                    <x-dashboard.partials.input name='lesson_title[]' label='Lesson Title' id='lesson_title'
                        placeholder='ex: Lesson One' value="{{ old('lesson_title[]', $section->lesson_title) }}" />
                    <div class="content-lectures" id="content-lectures">
                        @foreach ($section->lectures as $key => $value)
                            <x-dashboard.partials.input name='lectures[{{ $number }}][title][]'
                                label='Lectures Title' id='lectures' :required="true"
                                placeholder='ex: Lesson one : Defining leadership'
                                value="{{ old('lectures[]', $key) }}" />
                            {{-- <x-dashboard.partials.input name='lectures[0][file][]' type='file' label='Lectures Content'
                            id='lesson_title' title="chooice video" value="{{ old('lectures', $value) }}"
                            accept='video/*' /> --}}

                            <div class="mt-3">
                                <label for="{{ $value . '2' }}" style="display: flex; align-items:center;">Lectures
                                    Content
                                    <i class="far fa-edit"
                                        style=";font-size: 20px;color: #2878EB; margin-top:7px;cursor: pointer;margin-left:20px;"></i>
                                </label>
                                <input type="file" name="lectures[{{ $number }}][file][]"
                                    id="{{ $value . '2' }}" value="{{ old('lectures[0][file][]', $value) }}"
                                    accept="video/*" class="video_file" hidden>
                                <br>
                                <video id="{{ $value }}" src="{{ asset('storage/' . $value) }}"
                                    controls></video>
                                <small style="color: red">{{ $errors->first('course_image') }}</small>
                            </div>
                        @endforeach
                    </div>
                    <div class="attachments">
                        <div style="color:#444;font-weight:bold;font-size:22px; margin-top:20px;">Attachments</div>
                        @foreach ($section->attachments ?? [] as $key => $value)
                            <div class="mt-3">
                                <label for="{{ $value . '2' }}"
                                    style="display: flex; align-items:center;font-size:16px; font-weight: normal;">
                                    {{ $key }}
                                    <i class="far fa-edit"
                                        style=";font-size: 20px;color: #2878EB; margin-top:3px;cursor: pointer;margin-left:20px;"></i>
                                </label>
                                <input type="file" name="attachments[{{ $number }}][]"
                                    id="{{ $value . '2' }}" value="{{ old('attachments[0][]', $value) }}"
                                    accept=".pdf,.doc" class="video_file" hidden>
                                <br>
                        @endforeach
                    </div>
                    @php
                        ++$number;
                    @endphp
                @endforeach

            </div>
            <button type="submit">Update</button>
        </form>
    </section>
    <script>
        $video_file = document.getElementsByClassName('video_file');
        for (let i = 0; i < $video_file.length; i++) {
            $video_file[i].onchange = function(e) {
                if (this.files && this.files[0]) {
                    $id = this.id;
                    $video_tag = document.getElementById($id.slice(0, -1));
                    // console.log($id, $id.slice(0, -1))
                    // console.log($video_file);
                    // $video_tag.onload = () => {
                    //     URL.revokeObjectURL($video_tag.src); // no longer needed, free memory
                    // }
                    // console.log($video_file);
                    $video_tag.src = window.URL.createObjectURL(e.target.files[0]);

                    // $video_tag.src = this.value;
                }
            }
        }
    </script>
</x-dashboard.layout>
