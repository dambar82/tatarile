$(document).ready(function(){
    function focusInput() {
        // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
        if (!String.prototype.trim) {
            (function() {
                // Make sure we trim BOM and NBSP
                var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                String.prototype.trim = function() {
                    return this.replace(rtrim, '');
                };
            })();
        }

        [].slice.call( document.querySelectorAll( 'input.input_field' ) ).forEach( function( inputEl ) {
            // in case the input is already filled..
            if( inputEl.value.trim() !== '' ) {
                classie.add( inputEl.parentNode, 'input--filled' );
            }

            // events:
            inputEl.addEventListener( 'focus', onInputFocus );
            inputEl.addEventListener( 'blur', onInputBlur );
        } );

        function onInputFocus( ev ) {
            classie.add( ev.target.parentNode, 'input--filled' );
        }

        function onInputBlur( ev ) {
            if( ev.target.value.trim() === '' ) {
                classie.remove( ev.target.parentNode, 'input--filled' );
            }
        }
    };
    function magicLine() {

        var $el, leftPos, newWidth,
            $mainNav = $("#modal-form .nav");


        var $magicLine = $("#line");

        $magicLine
            .width($("#modal-form .nav li.active").width())
            .css("left", $("#modal-form .nav li.active").position().left)
            .data("origLeft", $magicLine.position().left)
            .data("origWidth", $magicLine.width());

        $("#modal-form .nav li").click(function() {
            $el = $(this);
            leftPos = $el.position().left;
            newWidth = $el.width();
            $magicLine.stop().animate({
                left: leftPos,
                width: newWidth
            });
        });
    };




    $("#modal-form").iziModal({
        overlayClose: true,
        width: 400,
        autoOpen: false,
        overlayColor: 'rgba(0, 0, 0, 0.6)',
        attached: 'center'
    });
    magicLine();
    var modalForm = $('#modal-form');
    $('.authoriz_lnk').click(function(){
        /*$.ajax({
            'dataType' : 'html',
            'success' : function(data) {
                $("#modal-form").find('.iziModal-content').html(data);
                $('#modal-form').iziModal('open');
                $('#modal-form #auth').addClass('in active');
                focusInput();
                magicLine();
                $(document).on('opening', '#modal', function (e) {
                    $('#modal-form').iziModal('recalculateLayout');
                });
            },
            'type' : 'post',
            'url' : 'site/auth'
        });
        $(document).on('opened', modalForm, function (e) {

            magicLine();
        });

        modalForm.iziModal('open');
        modalForm.find('a[href="#auth"]').tab('show');
        focusInput();
        magicLine();*/
    });
    $('.register_lnk').click(function(){
        /*$.ajax({
            'dataType' : 'html',
            'success' : function(data) {
                $("#modal-form").find('.iziModal-content').html(data);
                $('#modal-form').iziModal('open');
                $('#modal-form #auth').addClass('in active');
                focusInput();
                magicLine();
                $(document).on('opening', '#modal', function (e) {
                    $('#modal-form').iziModal('recalculateLayout');
                });
            },
            'type' : 'post',
            'url' : 'site/auth'
        });
        $(document).on('opened', modalForm, function (e) {
            magicLine();
        });

        modalForm.iziModal('open');
        modalForm.find('a[href="#regist"]').tab('show');
        focusInput();
        magicLine();*/
    });



    /* Filter animate */
    $body = $('body');
    var $filterBtn, $filterBlock;
    $('.filter_container').on('click', '.filter-config-btn', function() {
        $filterBtn = $('.filter-config-btn');
        $filterBlock = $('.left-sidebar');
        if ( !$filterBtn.hasClass('active') ) {
            $filterBtn.toggleClass('active');
            $body.css({'overflow': 'hidden'});
            $filterBlock.toggleClass('visible').stop().animate({'left': '0'}, {duration: 200});
        } else {
            $filterBtn.toggleClass('active');
            $body.css({'overflow': 'visible'});
            $filterBlock.toggleClass('visible').stop().animate({'left': '-100%'}, {duration: 200});
        }
    });
    if (window.innerWidth < 992) {
        $('.filter_container').on('change', '.left-sidebar .filter_field input, .left-sidebar .filter_field select', function() {
            $body.css({'overflow': 'visible'});
        });
    }
    $(window).resize(function() {
        if (window.innerWidth < 992) {
            $('.filter_container').on('change', '.left-sidebar .filter_field input, .left-sidebar .filter_field select', function() {
                $body.css({'overflow': 'visible'});
            });
        } else {
            $body.css({'overflow': 'visible'});
            if ($filterBtn && $filterBlock) {
                $filterBtn.removeClass('active');
                $filterBlock.removeClass('visible').css({'left': '-100%'});
            }
        }
    });
    /* Alphabet animate */
    var $alphabetBtn, $alphabetBlock;
    $('.filter_container').on('click', '.alphabet-config-btn', function() {
        $alphabetBtn = $('.alphabet-config-btn');
        $alphabetBlock = $('.alphabet-filter-block');
        if ( !$alphabetBtn.hasClass('active') ) {
            $alphabetBtn.toggleClass('active');
            $body.css({'overflow': 'hidden'});
            $alphabetBlock.toggleClass('visible').stop().animate({'top': '0'}, {duration: 200});
        } else {
            $alphabetBtn.toggleClass('active');
            $body.css({'overflow': 'visible'});
            $alphabetBlock.toggleClass('visible').stop().animate({'top': '-100%'}, {duration: 200});
        }
    });
    if (window.innerWidth < 992) {
        $('.filter_container').on('change', '.alphabet-filter-block input[type="checkbox"]', function() {
            $body.css({'overflow': 'visible'});
        });
    }
    $(window).resize(function() {
        if (window.innerWidth < 992) {
            $('.filter_container').on('change', '.alphabet-filter-block input[type="checkbox"]', function() {
                $body.css({'overflow': 'visible'});
            });
        } else {
            $body.css({'overflow': 'visible'});
            if ($alphabetBtn && $alphabetBlock) {
                $alphabetBtn.removeClass('active');
                $alphabetBlock.removeClass('visible').css({'top': '-100%'});
            }
        }
    });



});
