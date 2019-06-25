<?php
$page = filter_input(INPUT_GET, 'hal', FILTER_DEFAULT);
$view = empty($page)? 'home' : $page ;
?>

<script>
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
