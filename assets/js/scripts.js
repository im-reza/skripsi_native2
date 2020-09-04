/*!
    * Start Bootstrap - SB Admin v6.0.0 (https://startbootstrap.com/templates/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
        "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    var menu =  $(".sidebar #nav li.has-treeview");
    $(".sidebar #nav a.nav-link").each(function() {
        if (this.href === path) {
            var side = $(this).addClass("active");

        }
    });

    // Toggle the side navigation
})(jQuery);
