<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edukate</title>
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
</head>
<style>
    * {
        padding: 0;
        box-sizing: border-box;
        margin: 0;
        text-decoration: none;
    }

    section {
        position: relative;
        background: #eee;
        height: fit-content;
    }

    section .blue {
        background-color: #03A9F4;
        height: 150px;
    }

    .content {
        background: #fff;
        height: fit-content;
        width: 50%;
        margin-left: auto;
        margin-right: auto;
        padding: 60px 50px;
        position: relative;
        top: -114px;
        border-radius: 6px;
        box-shadow: -5px 9px 16px 1px #6666;
    }

    .content h1 {
        text-align: center;
        padding-bottom: 35px;
        font-size: 47px;
        margin-left: 20px;
    }

    .from {
        font-size: 25px;
        color: #333;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .from .email {
        color: red;
        float: right;
        font-style: italic;
    }

    div.subject {
        padding: 20px 0px;
        font-size: 25px;
    }

    span.subject {
        float: right;
        color: red;
    }

    div.message {
        font-size: 25px;
    }

    p.message {
        font-size: 18px;
        color: #666;
        padding-top: 20px;
        line-height: 1.8;
    }

    footer {
        padding: 40px 20px;
        background-color: #ddd;
        color: #fff;
        text-align: center;
        font-size: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    svg {
        color: blue;
    }

    svg.logo {
        text-align: center;
        display: block;
        font-size: 90px;
        width: fit-content;
        margin-left: auto;
        margin-bottom: 15px;
        margin-right: auto;
    }

    footer svg {
        font-size: 27px;
        margin-bottom: 2px;
        margin-right: 15px;
        /* position: fixed; */
        bottom: 0;
        left: 0;
    }

    footer a {

        display: inline-block;
        margin-left: 10px;
        font-style: italic;
    }

    footer .title {
        color: #333;
    }

    .content>svg {
        /* margin-left: 35%; */
    }
</style>

<body>
    <section>
        <div class="blue"></div>
        <div class="content">
            <svg class="logo" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <style>
                    svg {
                        fill: #0000ff
                    }
                </style>
                <path
                    d="M352 96c0-53.02-42.98-96-96-96s-96 42.98-96 96 42.98 96 96 96 96-42.98 96-96zM233.59 241.1c-59.33-36.32-155.43-46.3-203.79-49.05C13.55 191.13 0 203.51 0 219.14v222.8c0 14.33 11.59 26.28 26.49 27.05 43.66 2.29 131.99 10.68 193.04 41.43 9.37 4.72 20.48-1.71 20.48-11.87V252.56c-.01-4.67-2.32-8.95-6.42-11.46zm248.61-49.05c-48.35 2.74-144.46 12.73-203.78 49.05-4.1 2.51-6.41 6.96-6.41 11.63v245.79c0 10.19 11.14 16.63 20.54 11.9 61.04-30.72 149.32-39.11 192.97-41.4 14.9-.78 26.49-12.73 26.49-27.06V219.14c-.01-15.63-13.56-28.01-29.81-27.09z" />
            </svg>
            <h1>Edukate Message!</h1>
            <span class="from">From: <span class="email"><a
                        href="mailto:{{ $email['from'] }}">{{ $email['from'] }}</a></span></span>
            <span class="from" style="display: block;font-style:normal;margin-bottom:0px;">Name: <span class="email"
                    style="font-style: normal;">{{ $email['name'] }}</span></span>
            <div class="subject">Subject: <span class="subject">{{ $email['subject'] }}</span></div>
            <div class="message">Message:
                <p class="message">{{ $email['message'] }}</p>
            </div>
        </div>
        <footer>
            <svg xmlns="http://www.w3.org/2000/svg" style="color:blue;" height="1em" viewBox="0 0 512 512">
                <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path style="color:blue;"
                    d="M352 96c0-53.02-42.98-96-96-96s-96 42.98-96 96 42.98 96 96 96 96-42.98 96-96zM233.59 241.1c-59.33-36.32-155.43-46.3-203.79-49.05C13.55 191.13 0 203.51 0 219.14v222.8c0 14.33 11.59 26.28 26.49 27.05 43.66 2.29 131.99 10.68 193.04 41.43 9.37 4.72 20.48-1.71 20.48-11.87V252.56c-.01-4.67-2.32-8.95-6.42-11.46zm248.61-49.05c-48.35 2.74-144.46 12.73-203.78 49.05-4.1 2.51-6.41 6.96-6.41 11.63v245.79c0 10.19 11.14 16.63 20.54 11.9 61.04-30.72 149.32-39.11 192.97-41.4 14.9-.78 26.49-12.73 26.49-27.06V219.14c-.01-15.63-13.56-28.01-29.81-27.09z" />
            </svg>
            {{-- <i class="fas fa-book-reader"></i> --}}
            <span class="title">Edukate &copy;</span> <a href="{{ route('home') }}">visit site</a>
        </footer>
    </section>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
