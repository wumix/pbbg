$(function()
{

    if ($.support.pjax) {
        $.pjax.defaults.timeout = 1000; // time in milliseconds
    }

    $(document).on('click', 'a', function(event) {
        var container = $('#pjax-content');
        $.pjax.click(event, container);
        $("#left-nav li").removeClass('active');

        $(this).parent().addClass('active');
    });

    $(document).on('submit', 'form[data-pjax]', function(event) {
        $.pjax.submit(event, '#pjax-container');
    });

    $(document).on('pjax:send', function() {
        $('#loader').addClass('active');
    });

    $(document).on('pjax:complete', function() {
        $('#loader').removeClass('active');
    });
});