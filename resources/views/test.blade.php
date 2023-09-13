<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <form action="/test" method="post">
    @csrf
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link bg-aqua-active" href="#" id="english-link">EN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="spanish-link">ES</a>
            </li>
        </ul>
        <div class="card-body" id="english-form">
            <div class="form-group">
                <label class="required" for="en_title">{{ trans('cruds.article.fields.title') }} (EN)</label>
                <input class="form-control {{ $errors->has('en_title') ? 'is-invalid' : '' }}" type="text"
                    name="en_title" id="en_title" value="{{ old('en_title', '') }}" required>
                @if ($errors->has('en_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('en_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.article.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="en_full_text">{{ trans('cruds.article.fields.full_text') }} (EN)</label>
                <textarea class="form-control {{ $errors->has('en_full_text') ? 'is-invalid' : '' }}" name="en_full_text"
                    id="en_full_text">{{ old('en_full_text') }}</textarea>
                @if ($errors->has('en_full_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('en_full_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.article.fields.full_text_helper') }}</span>
            </div>
        </div>

        <div class="card-body d-none" id="spanish-form">
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.article.fields.title') }} (ES)</label>
                <input class="form-control {{ $errors->has('es_title') ? 'is-invalid' : '' }}" type="text"
                    name="es_title" id="es_title" value="{{ old('es_title', '') }}" required>
                @if ($errors->has('es_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('es_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.article.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="es_full_text">{{ trans('cruds.article.fields.full_text') }} (ES)</label>
                <textarea class="form-control {{ $errors->has('es_full_text') ? 'is-invalid' : '' }}" name="es_full_text"
                    id="es_full_text">{{ old('es_full_text') }}</textarea>
                @if ($errors->has('es_full_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('es_full_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.article.fields.full_text_helper') }}</span>
            </div>
        </div>
        <button type="submit">send</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
        var $englishForm = $('#english-form');
        var $spanishForm = $('#spanish-form');
        var $englishLink = $('#english-link');
        var $spanishLink = $('#spanish-link');

        $englishLink.click(function() {
            $englishLink.toggleClass('bg-aqua-active');
            $englishForm.toggleClass('d-none');
            $spanishLink.toggleClass('bg-aqua-active');
            $spanishForm.toggleClass('d-none');
        });

        $spanishLink.click(function() {
            $englishLink.toggleClass('bg-aqua-active');
            $englishForm.toggleClass('d-none');
            $spanishLink.toggleClass('bg-aqua-active');
            $spanishForm.toggleClass('d-none');
        });
    </script>
</body>

</html>
