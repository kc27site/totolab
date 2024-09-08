@php
$is_admin = strpos(url()->current(), '/admin') !== false;
@endphp
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>totolab{{$is_admin ? ' Admin' : ''}}</title>
    @if($is_admin)
    <meta name="robots" content="noindex">
    @vite(['resources/js/admin.js', 'resources/css/admin.css'])
    @else
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #333333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
        }
    </style>
    @endif
</head>
<body class="font-sans antialiased">
    @inertia
</body>
</html>
