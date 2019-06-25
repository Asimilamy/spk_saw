<?php
$page = filter_input(INPUT_GET, 'hal', FILTER_DEFAULT);
$view = empty($page)? 'home' : $page ;
?>

<script>
    $(document).off('change', '#type').on('change', '#type', function() {
        let criteria_id = $('input[name=id]').val();
        let type = $(this).val();
        get_options_form(criteria_id, type);
    });

    $(document).off('click', '.btn-add-options').on('click', '.btn-add-options', function() {
        add_options();
    });

    $(document).off('click', '.btn-remove-options').on('click', '.btn-remove-options', function() {
        $(this).parents('.option-form').slideUp(function() {
            $(this).remove();
        });
    });

    function get_options_form(criteria_id, type) {
        $('#attribute-options').slideUp(function() {
            $.ajax({
                url: 'controllers/<?php echo $view; ?>.php',
                type: 'GET',
                data: {'act': 'get_options_form', 'criteria_id': criteria_id, 'type': type},
                success: function(html) {
                    $('#attribute-options').html(html).promise().done(function() {
                        $('#attribute-options').slideDown().promise().done(function() {
                            $('.option-form').slideDown();
                        });
                    });
                }
            });
        });
    }

    function add_options() {
        $.ajax({
            url: 'controllers/<?php echo $view; ?>.php',
            type: 'GET',
            data: {'act': 'add_options'},
            success: function(html) {
                $('#attribute-options').append(html);
                $('.option-form').slideDown();
            }
        });
    }
</script>