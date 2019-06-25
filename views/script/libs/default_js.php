<?php
$page = filter_input(INPUT_GET, 'hal', FILTER_DEFAULT);
$view = empty($page)? 'home' : $page ;
?>

<script src="views/script/libs/js_function.js"></script>
<script>
    load_table();

    $(document).off('click', '.btn-add').on('click', '.btn-add', function() {
        $(this).slideUp();
        get_form('');
    });

    $(document).off('click', '.remove-form').on('click', '.remove-form', function() {
        $('.btn-add').slideDown();
    });

    $(document).off('submit', '#formAjax').on('submit', '#formAjax', function(e) {
        e.preventDefault();
        let url = 'controllers/<?php echo $view; ?>.php';
        $('.form-alert').slideUp();
        submit_form(url, this)
            .done(function(data) {
                if (data.status == 'success') {
                    $('.form-row').slideUp(function() {
                        $(this).remove();
                    });
                    $('#box-alert').html(data.alert);
                    $('#box-alert').slideDown();
                    load_table();
                    $('.btn-add').slideDown();
                } else if (data.status == 'error') {
                    $('.form-alert').html(data.alert);
                    $('.form-alert').slideDown();
                }
            })
            .fail(function () {
                alert('Sorry system encountered error!');
            });
    });

    function moveTo(element) {
        $('html, body').animate({ scrollTop: $(element).offset().top - $('header').height() }, 1000);
    }

    function load_table() {
        $('#img-loader').fadeIn(function() {
            $('#box-body').slideUp(function() {
                $.ajax({
                    url: 'controllers/<?php echo $view; ?>.php',
                    type: 'GET',
                    data: {'act': 'load_table'},
                    success: function(html) {
                        $('#img-loader').fadeOut(function() {
                            $('#box-body').html(html);
                            $('#box-body').slideDown();
                            moveTo('.content');
                        });
                    }
                });
            });
        });
    }

    function get_form(id) {
        if (id != '') {
            $('.btn-add').slideDown();
        }
        $('.form-row').slideUp(function() {
            $(this).remove();
        });
        $.ajax({
            url: 'controllers/<?php echo $view; ?>.php',
            type: 'GET',
            data: {'act': 'get_form', 'id': id},
            success: function(html) {
                $('.main-frame').prepend(html);
                moveTo('.content');
            }
        });
    }

    function delete_data(id) {
        $('.form-row').slideUp(function() {
            $(this).remove();
        });
        $('.btn-add').slideDown();
        $.ajax({
            url: 'controllers/<?php echo $view; ?>.php',
            type: 'POST',
            data: {'act': 'delete_data', 'id': id},
            success: function(data) {
                $('#box-alert').html(data.alert);
                $('#box-alert').slideDown();
                load_table();
            }
        });
    }

    function view_detail(id) {
        $('.form-row').slideUp(function() {
            $(this).remove();
        });
        $('.btn-add').slideDown();
        $.ajax({
            url: 'controllers/<?php echo $view; ?>.php',
            type: 'GET',
            data: {'act': 'view_detail', 'id': id},
            success: function(html) {
                $('.main-frame').prepend(html);
                moveTo('.content');
            }
        });
    }
</script>