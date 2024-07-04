<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boatman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header class="desktop-header">
        <h1>Boatman</h1>
        <nav class="desktop-nav">
            <ul class="nav nav-pills">
                <li><a href="/home" class="ajax-link nav-link">Home</a></li>
                <li><a href="/services" class="ajax-link nav-link">Services</a></li>
                <li><a href="/about" class="ajax-link nav-link">About</a></li>
                <li><a href="/contact" class="ajax-link nav-link">Contact</a></li>
            </ul>
        </nav>
    </header>

    <header class="mobile-header">
        <h1>Boatman</h1>
        <nav class="mobile-nav nav nav-pills" id="mobileMenu">
            <ul class="d-flex justify-content-around">
                <li><a href="/home" class="btn ajax-link nav-link"><i class="fas fa-home fa-3x"></i></a></li>
                <li><a href="/services" class="btn ajax-link nav-link"><i class="fas fa-user fa-3x"></i></a></li>
                <li><a href="/about" class="btn ajax-link nav-link"><i class="fas fa-bath fa-3x"></i></a></li>
                <li><a href="/contact" class="btn ajax-link nav-link"><i class="fas fa-book fa-3x"></i></a></li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2024 Boatman. All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle link clicks
            $('a.ajax-link').on('click', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');

                // Fetch the content with AJAX
                $.ajax({
                    url: url,
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        $('#content').html(response);
                        $('a.ajax-link').removeClass('active');
                        $(this).addClass('active');
                        window.history.pushState({path: url}, '', url);
                    }.bind(this),
                    error: function() {
                        alert('An error occurred.');
                    }
                });
            });

            // Handle back/forward buttons
            window.onpopstate = function(event) {
                if (event.state) {
                    var url = event.state.path;

                    $.ajax({
                        url: url,
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(response) {
                            $('#content').html(response);
                            $('a.ajax-link').removeClass('active');
                            $('a.nav-link[href="' + url + '"]').addClass('active');
                        },
                        error: function() {
                            alert('An error occurred.');
                        }
                    });
                }
            };
        });
    </script>
</body>
</html>
