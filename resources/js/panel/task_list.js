(function ($) {
    "use strict";

    $('body').on('change', '#activeTasksSwitch', function (e) {
        e.preventDefault();

        $(this).closest('form').trigger('submit');
    });

    $('body').on('change', '#onlyOpenTasksSwitch', function () {
        $(this).closest('form').trigger('submit');
    })

})(jQuery);
