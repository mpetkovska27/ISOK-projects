<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Library</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .container{
            margin-top: 30px;
        }

    </style>
</head>
<body>
<nav>
    <a href="{{ route('organizers.index') }}">Organizers</a> |
    <a href="{{ route('events.index') }}">Events</a>
</nav>

<hr>
<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
