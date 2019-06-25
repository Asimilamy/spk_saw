<?php
$page = filter_input(INPUT_GET, 'hal', FILTER_DEFAULT);
$view = empty($page)? 'home' : $page ;
?>

<script>
    $(document).off('change', '.criteria-select').on('change', '.criteria-select', function() {
        console.log($(this).find(':selected').data('id'));
        $(this).prev().val($(this).find(':selected').data('id'));
    });

    function load_criterias(id) {
        $('#criteriasForm').slideUp(function() {
            $.ajax({
                url: 'controllers/<?php echo $view; ?>.php',
                type: 'GET',
                data: {'act': 'load_criterias', 'id': id},
                success: function(html) {
                    $('#criteriasForm').html(html).promise().done(function() {
                        $(this).slideDown();
                    });
                }
            });
        });
    }
</script>
