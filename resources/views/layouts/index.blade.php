<!DOCTYPE html>

<html lang="en">
<head>
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>{{config('env.APP_NAME', "Advanced Stream Stats")}}</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="{{asset("assets")}}/plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="{{asset("assets")}}/plugins/simplebar/simplebar.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="{{asset("assets")}}/plugins/nprogress/nprogress.css" rel="stylesheet" />

  <!-- CSS -->
  <link id="main-css-href" rel="stylesheet" href="{{asset("assets")}}/css/style.css" />

  <!-- FAVICON -->
  <link href="{{asset("assets")}}/images/favicon.png" rel="shortcut icon" />


  <script src="{{asset("assets")}}/plugins/nprogress/nprogress.js"></script>
</head>
    @toaster
</head>


<body class="bg-light-gray" id="body">
    @yield('content')

</body>
</html>
