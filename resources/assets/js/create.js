$(function () {
    $('[data-load-form]').on('click', function(e) {
        e.preventDefault();
        $('#options-form').load($(this).attr('href'));
    });
});