$(document).ready(function() {
    // Restore active link on page load
    var activeLink = localStorage.getItem('activeLink');
    if (activeLink) {
        $('a.nav-link[href="' + activeLink + '"]').addClass('active');
        // Load initial content
        loadContent(activeLink);
    } else {
        // Load default content (for example, Home)
        loadContent('/home');
    }

    // Handle link clicks
    $('a.nav-link').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        // Update active link in localStorage
        localStorage.setItem('activeLink', url);

        // Remove 'active' class from all links
        $('a.nav-link').removeClass('active');

        // Add 'active' class to the clicked link
        $(this).addClass('active');

        // Load content
        loadContent(url);

        // Update browser history
        window.history.pushState({ path: url }, '', url);
    });

    // Handle back/forward buttons
    window.onpopstate = function(event) {
        if (event.state) {
            var url = event.state.path;

            // Remove 'active' class from all links
            $('a.nav-link').removeClass('active');

            // Find and add 'active' class to the corresponding link
            $('a.nav-link[href="' + url + '"]').addClass('active');

            // Load content
            loadContent(url);
        }
    };

    // Function to load content via AJAX
    function loadContent(url) {
        $.ajax({
            url: url,
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                $('#content').html(response);
            },
            error: function() {
                alert('An error occurred.');
            }
        });
    }
});
