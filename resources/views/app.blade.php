<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" sizes="76x76" href="/argon/img/ppo/favicon.png">
        <link rel="icon" type="image/png" href="/argon/img/favicon.png">
        <title> HomeBed Spain</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link href="/argon/css/nucleo-icons.css" rel="stylesheet" />
        <link href="/argon/css/nucleo-svg.css" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <!-- CSS Files -->
        <link id="pagestyle" href="/argon/css/argon-dashboard.css?v=2.0.2" rel="stylesheet" />
        <!-- font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                @csrf
            </form>
        @endauth
        @inertia

        {{-- JQuery --}}
        <script src="/js/jquery.js"></script>
        <!--   Core JS Files   -->
        <script src="/argon/js/core/popper.min.js"></script>
        <script src="/argon/js/core/bootstrap.min.js"></script>
        <script src="/argon/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="/argon/js/plugins/datatables.js"></script>
        <script src="/argon/js/plugins/smooth-scrollbar.min.js"></script>
        <!-- Kanban scripts -->
        <script src="/argon/js/plugins/dragula/dragula.min.js"></script>
        <script src="/argon/js/plugins/jkanban/jkanban.js"></script>
        <script src="/argon/js/plugins/chartjs.min.js"></script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>

        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
    </body>
</html>
