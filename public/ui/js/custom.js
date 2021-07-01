var collectionOverLay = {
    init: function () {
        this.initCustomOutdoor();
        this.initNiceScroll();
        if (trueMobile) this.initSlideToggleEvent();
        var a = $(window).height(), c = $("header").outerHeight(), d = $("footer").outerHeight(), e = $("#gallery_horizontal");
        $('.post-fixed-info-container').css("height", a - c - d - 60);
        $('.custom-post-content .collection-ctn').css("height", a - c - d - 60);
    },
    initCustomOutdoor: function () {
        var self = this;
        $('.filter-button').on('click', function () {
            $(this).parent().toggleClass('filter-holder-custom');
            collectionOverLay.initCustomGalleryFilterDisplay();
            $('#ascrail2000-hr').toggleClass('hide-ascrail2000');
            $(this).toggleClass('filter-button-custom');
            $('#ascrail2001-hr').addClass('hidden');
            $('#ascrail2001').addClass('hidden');
            $('#ascrail2001-hr .nicescroll-cursors').hide();
            setTimeout(function () {
                $('.filter-holder').promise().done(function () {
                    $('.content-container').getNiceScroll().resize();
                });
                $('#ascrail2001-hr').removeClass('hidden');
                $('#ascrail2001').removeClass('hidden');
                $('#ascrail2001-hr .nicescroll-cursors').show();
            }, 600);
        });
    },
    initCustomGalleryFilterDisplay: function () {
        var $galleryCustomFilters = $('.gallery-filters');
        $galleryCustomFilters.toggleClass('gallery-filters-custom');
    },
    initNiceScroll: function () {
        var b = {
            touchbehavior: true,
            cursoropacitymax: 1,
            cursorborderradius: "0",
            background: "#a4a4a3",
            cursorwidth: "5px",
            cursorborder: "0px",
            cursorcolor: "#3f3f3f",
            autohidemode: false,
            bouncescroll: false,
            scrollspeed: 120,
            mousescrollstep: 90,
            grabcursorenabled: true,
            horizrailenabled: true,
            preservenativescrolling: true,
            cursordragontouch: true,
            railpadding: {
                top: -3,
                right: 0,
                left: 0,
                bottom: 0
            },
        };
        $('.content-container').niceScroll(b);
        $('.nice-scroll-container').niceScroll(b);

        if(trueMobile) {
            return ;
        } else  {
            $('.contact-column-text').niceScroll(b);
            setTimeout(function () {
                            $('.post-fixed-info-container').niceScroll();

            }, 500)
        }
    },
    initZoom: function () {
        $('[data-magnify=gallery]').magnify({
            footerToolbar: [
                'zoomIn',
                'zoomOut',
                'prev',
                'fullscreen',
                'next',
                'actualSize',
                'rotateRight'
            ],
            i18n: {
                minimize: 'minimize',
                maximize: 'maximize',
                close: 'close',
                zoomIn: 'zoom-in(+)',
                zoomOut: 'zoom-out(-)',
                prev: 'prev(←)',
                next: 'next(→)',
                fullscreen: 'fullscreen',
                actualSize: 'actual-size(Ctrl+Alt+0)',
                rotateLeft: 'rotate-left(Ctrl+,)',
                rotateRight: 'rotate-right(Ctrl+.)'
              },
              initEvent: 'click',
              initMaximized: true,
              draggable: true

        });
    },
    initSlideToggleEvent: function () {
        var $postsPage = $('.post-content-holder');
        var $toggleBtn = $postsPage.find('.collection-ctn .toggle-button');
        if ($toggleBtn.length) {
            $toggleBtn.on('click', function () {
                $postsPage.find('.collection-ctn .toggle-menu').slideToggle(500);
                $(this).find("i").toggleClass("roticon");
            });
        }
    }
};

$(document).ready(function() {
    collectionOverLay.init();
    console.log(trueMobile)
});

