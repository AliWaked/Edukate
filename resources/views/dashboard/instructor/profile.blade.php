<x-dashboard.layout title='Profile' :items="['Courses', 'Add Courses']">
    <style>
        section.add .back a {
            text-transform: capitalize;
            border: 2px solid #2878EB;
            padding: 8px 15px;
            border-radius: 7px;
            transition: 0.5s;
            font-weight: 500px;
        }

        section.profile form label {
            display: block;
            font-size: 20px;
            font-weight: 500;
            text-transform: capitalize;
        }

        section.profile form input,
        section.profile form select,
        section.profile form textarea {
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

        section.profile form textarea {
            height: 120px;
            resize: none;
        }

        section.profile form button {
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
        }
    </style>
    <section class="profile" style="width:fit-content; margin:0 auto;">
        <form action="{{ route('dashboard.instructor.profile.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: -10px;">
                <span style="display: block;font-weight:bold;font-size:20px;margin-bottom:20px;">{{ __('Your Profile') }}
                    picture</span>
                <label for="file" style="width: 500px; text-align: center;cursor: pointer;" id="file_label">
                    <img src="{{ $profile->avatar_image }}" alt="" width="120" height="120"
                        style="border-radius: 50%;" id="logo_image">
                </label>
                <input type="file" id="file" name="avatar" hidden>
            </div>
            <x-dashboard.partials.input label="{{ __('your name') }}" id='name' :required="true" disabled
                value="{{ old('name', $name) }}" />
            <x-dashboard.partials.input label="{{ __('your email') }}" id='name' :required="true" disabled
                value="{{ old('email', $email) }}" />
            <x-dashboard.partials.section-title title='Information' />

            <x-dashboard.partials.input name='job_title' label='job title' id='name' :required="true"
                value="{{ old('job_title', $profile->job_title) }}" />
            <x-dashboard.partials.select :items="['male', 'female']" name='gender' label="{{ __('gender') }}" id='name'
                :required="true" value="{{ old('gender', $profile->gender) }}" />
            <x-dashboard.partials.input name='birthday' label="{{ __('birthday') }}" type='date' id='name'
                :required="true" value="{{ old('birthday', $profile->birthday) }}" />


            <x-dashboard.partials.section-title title='Socail Media' />
            <x-dashboard.partials.input name='socail_media[twitter]' label="{{ __('twitter') }}" id='twitter'
                type='url'
                value="{{ old('socail_media[\'twitter\'] ??\'\' ', $profile->socail_media['twitter'] ?? '') }}" />

            <x-dashboard.partials.input name='socail_media[facebook]' label="{{__('facebook')}}" id='facebook' type='url'
                value="{{ old('socail_media[\'facebook\'] ??\'\' ', $profile->socail_media['facebook'] ?? '') }}" />
            <x-dashboard.partials.input name='socail_media[linkedin]' label='linkedin' id='linkedin' type='url'
                value="{{ old('socail_media[\'linkedin\'] ??\'\' ', $profile->socail_media['linkedin'] ?? '') }}" />
            <x-dashboard.partials.input name='socail_media[instagram]' label='instagram' id='instagram' type='url'
                value="{{ old('socail_media[\'instagram\'] ??\'\' ', $profile->socail_media['instagram'] ?? '') }}" />
            <x-dashboard.partials.input name='socail_media[youtube]' label='youtube' id='youtube' type='url'
                value="{{ old('socail_media[\'youtube\'] ??\'\' ', $profile->socail_media['youtube'] ?? '') }}" />


            <x-dashboard.partials.section-title title='Your Address' />
            <x-dashboard.partials.input name='country' label='country' id='name' :required="true"
                value="{{ old('country', $profile->country) }}" />
            <x-dashboard.partials.input name='city' label='city' id='name' :required="true"
                value="{{ old('city', $profile->city) }}" />
            <x-dashboard.partials.input name='street' label='street' id='name' :required="true"
                value="{{ old('street', $profile->street) }}" />
            <button type="submit">Save</button>
        </form>
    </section>
    <script>
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
    </script>
</x-dashboard.layout>
