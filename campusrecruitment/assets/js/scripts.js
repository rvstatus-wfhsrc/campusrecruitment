/*!
    * Start Bootstrap - SB Admin v6.0.1 (https://startbootstrap.com/templates/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
    "use strict";

    // Add active state to sidbar nav links
    // var path = window.location.href.replace(/\?.+/,''); // because the 'href' property of the DOM element is the absolute path
    //     $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
    //         if (this.href.replace(/\?.+/,'') === path) {
    //             $(this).addClass("active");
    //              if($(this).parent().parent().prev("a").hasClass("collapsed")) {
    //                 $(this).parent().parent().prev("a").addClass("active");
    //                 $(this).parent().parent().prev("a").removeClass("collapsed");
    //                 $(this).parent().parent().addClass("show");
    //             }
    //         }
    //     });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);
$(document).ready(function() {
    $('.siteLang').click(function() {
        var base_url = $('#base').val();
        var siteLang = $(this).attr('data-key');
        $.ajax({
            url:base_url+'HomeController/siteLangUpdate',
            method: 'POST',
            data: {siteLang: siteLang},
            dataType: 'json',
            success: function(response) {
                // alert(JSON.stringify(response));
                return false;
            }
        });
    });
});
