<!-- Scripts -->
<!-- jQuery -->
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/js/boostrap.bundle.min.js') }}"></script>
<!-- Slick -->
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<!-- AOS -->
<script src="{{ asset('assets/js/aos.js') }}"></script>
<!-- Counter -->
<script src="{{ asset('assets/js/counter.min.js') }}"></script>
<!-- Countdown -->
<script src="{{ asset('assets/js/count-down.js') }}"></script>
<!-- Marquee -->
<script src="{{ asset('assets/js/marque.min.js') }}"></script>
<!-- Vanilla Tilt -->
<script src="{{ asset('assets/js/vanilla-tilt.min.js') }}"></script>
<!-- WOW -->
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<!-- Phosphor Icons -->
<script src="{{ asset('assets/js/phosphor-icon.js') }}"></script>
<!-- Mobile Menu Submenu Toggle - Must run before main.js -->
<script>
    $(document).ready(function() {
        // Handle mobile menu submenu toggle - this runs before main.js
        $('.mobile-menu .mobile-submenu-toggle').on('click', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var $parent = $(this).closest('.has-submenu');
            var $submenu = $parent.find('.nav-submenu');
            var $arrow = $(this).find('.submenu-arrow');

            // Close other submenus
            $('.mobile-menu .has-submenu').not($parent).removeClass('active').find('.nav-submenu').slideUp(300);
            $('.mobile-menu .has-submenu').not($parent).find('.submenu-arrow').css('transform', 'rotate(0deg)');

            // Toggle current submenu
            if ($parent.hasClass('active')) {
                $parent.removeClass('active');
                $submenu.slideUp(300);
                $arrow.css('transform', 'rotate(0deg)');
            } else {
                $parent.addClass('active');
                $submenu.slideDown(300);
                $arrow.css('transform', 'rotate(180deg)');
            }

            return false;
        });
    });
</script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Override main.js handler for mobile menu after it loads -->
<script>
    $(document).ready(function() {
        // After main.js loads, remove its handler from mobile menu items
        setTimeout(function() {
            $('.mobile-menu .has-submenu').off('click');

            // Re-attach our handler with higher priority
            $('.mobile-menu .mobile-submenu-toggle').off('click').on('click', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var $parent = $(this).closest('.has-submenu');
                var $submenu = $parent.find('.nav-submenu');
                var $arrow = $(this).find('.submenu-arrow');

                // Close other submenus
                $('.mobile-menu .has-submenu').not($parent).removeClass('active').find('.nav-submenu').slideUp(300);
                $('.mobile-menu .has-submenu').not($parent).find('.submenu-arrow').css('transform', 'rotate(0deg)');

                // Toggle current submenu
                if ($parent.hasClass('active')) {
                    $parent.removeClass('active');
                    $submenu.slideUp(300);
                    $arrow.css('transform', 'rotate(0deg)');
                } else {
                    $parent.addClass('active');
                    $submenu.slideDown(300);
                    $arrow.css('transform', 'rotate(180deg)');
                }

                return false;
            });
        }, 100);
    });
</script>

