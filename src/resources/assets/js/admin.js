$(function()
{
    if ($.support.pjax) {
        $.pjax.defaults.timeout = 1000; // time in milliseconds
        $.pjax.defaults.maxCacheLength = 0;
    }

    $(document).on('click', 'a', function(event) {

        var href = $(this).attr('href');

        console.log(href);

        if(href == '#' || href == undefined)
            return false;

        Loader.send($(this));
        $.pjax.click(event, '#pjax-content');
    });

    $(document).on('submit', 'form[data-pjax]', function(event) {
        console.log('Form submitted');
        Loader.send($(this));
        $.pjax.submit(event, '#pjax-content');
    });

    $(document).on('pjax:popstate', function(event)
    {
        Loader.href = event.state.url;
        Loader.send();
    });

    $(document).on('pjax:end', function() {
        Loader.complete();
    });

    $(document).on('pjax:error', function(event, xhr, textStatus, errorThrown, options) {
        Loader.complete();
        options.success(xhr.responseText, textStatus, xhr);
        event.preventDefault();
        event.stopImmediatePropagation();
        return false;
    });

    // Hover bootstrap dropdowns, leave on click to work as mobile and tablet devices
    $("ul li.dropdown").hover(function()
        {
            $(this).addClass('open');
        }, function()
        {
            $(this).removeClass('open');
        }
    )
});

var Loader = {
    loading: false,
    lastPage: '',
    currentPage: '',
    target: null,
    href: '',

    send: function(_this)
    {
        this.lastPage = window.location.href;
        this.target = $(_this) || null;
        $("body").addClass('loading');
    },

    complete: function()
    {
        this.currentPage = window.location.href;

        $(".nav li").removeClass('active');

        console.log('link');

        $(".nav li a[href='" + this.currentPage + "']").parent().addClass('active');

        $("body").removeClass('loading');
    }
};

var Form = {
    submit: function(formName)
    {
        $(formName).submit();
    }
}