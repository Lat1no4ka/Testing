<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{asset('js/query.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />

</head>


<body>
    <div class="main">
    <input id="text" type="text" class="text">
    <input class="btn" id="update" type="button" value="Обновить" onclick="getdata()">
    <input class="btn" id="add" type="button" value="Добавить " onclick="getbase()">
    <div id="info" class="block"></div>
    </div>
   
</body>

</html>