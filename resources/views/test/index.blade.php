<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('vendor/uikit/css/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/uikit/css/uikit.almost-flat.css') }}">
    <title>Document</title>

</head>
<body>
    <div id="app">
        <span v-text="age"></span>
    </div>

    <script src="{{ asset('js/require.js') }}" data-main="{{ asset('ctrl/test/index.js') }}"></script>
</body>
</html>