<x-dashboard.layout title='Student Profile' :items="['Profile', 'Show student Profile']">
    <style>
        section .back a {
            text-transform: capitalize;
            border: 2px solid #2878EB;
            padding: 8px 15px;
            border-radius: 7px;
            transition: 0.5s;
            font-weight: 500px;
        }

        section.profile label {
            display: block;
            font-size: 20px;
            font-weight: 500;
            text-transform: capitalize;
        }

        section.profile input,
        section.profile select,
        section.profile textarea {
            margin-top: 5px;
            height: 50px;
            padding: 5px;
            font-size: 18px;
            font-weight: 500;
            outline: none;
            color: #2878EB;
            border: 2px solid #2878EB;
            border-radius: 5px;
            width: 500px;
        }

        section.profile textarea {
            height: 120px;
            resize: none;
        }

        /* section.profile form button {
            border: 2px solid #2878EB;
            padding: 0px 20px;
            margin-top: 15px;
            width: 500px;
            height: 55px;
            color: #fff;
            background: #2878EB;
            text-transform: capitalize;
            font-size: 20px;
            margin-bottom: 10px;
        } */
    </style>
    <div class="back">
        <a href="{{route('dashboard.student.index')}}">back</a>
    </div>
    <section class="profile" style="width:fit-content; margin:0 auto;">
        {{-- <form action="{{ route('student.profile.store') }}" method="post" enctype="multipart/form-data"> --}}
        {{-- @csrf --}}
        <div style="margin-bottom: -10px;">
            <span style="display: block;font-weight:bold;font-size:20px;margin-bottom:20px;">Student
                picture</span>
            <label for="file" style="width: 500px; text-align: center;" id="file_label">
                <img src="{{ $information->avatar_image }}" alt="" width="120" height="120"
                    style="border-radius: 50%;" id="logo_image" accept="image/*">
            </label>
            {{-- <input type="file" id="file" name="avatar" disabled hidden> --}}
        </div>
        <x-dashboard.partials.input label='student name' id='name' disabled
            value="{{ old('name', $student->name) }}" />
        <x-dashboard.partials.input label='studnet email' id='name' disabled
            value="{{ old('email', $student->email) }}" />
        <x-dashboard.partials.section-title title='Information' />

        <x-dashboard.partials.input name='field_title' label='job title' id='name'
            value="{{ old('field_title', $information->field_title) }}" disabled />
        <x-dashboard.partials.select :items="['male', 'female']" name='gender' label='gender' id='name'
            value="{{ old('gender', $information->gender) }}" disabled />
        <x-dashboard.partials.input name='birthday' label='birthday' type='date' id='name'
            value="{{ old('birthday', $information->birthday) }}" style="margin-bottom: 40px;" disabled />
        {{-- <button type="submit">Save</button> --}}
        {{-- </form> --}}
    </section>
    {{-- <script>
        // window.addEventListener('load', function() {
        document.querySelector('input[type="file"]').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                console.log(this.files[0]);
                var img = document.getElementById('logo_image');
                img.onload = () => {
                    URL.revokeObjectURL(img.src); // no longer needed, free memory
                }

                img.src = URL.createObjectURL(this.files[0]); // set src to blob url
                console.log(URL.createObjectURL(this.files[0]))
            }
        });
        // });
    </script> --}}
</x-dashboard.layout>
