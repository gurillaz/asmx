<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ASMX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">



    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>


    {{-- //Delete this style.. Container fluid not working on hot reload --}}
    <style>
        .container--fluid{
        min-width:100%!important;
                }
    </style>
  </head>
  <body>
    @inertia
  </body>


</html>
