<?php
$page = filter_input(INPUT_GET, 'hal', FILTER_DEFAULT);
$view = empty($page)? 'home' : $page ;
?>

<script>
    get_count();

    function get_count() {
        $.ajax({
            url: 'controllers/home.php',
            type: 'GET',
            data: {'act': 'get_count'},
            success: function(data) {
                $('#userCount').html(data.user);
                $('#criteriaCount').html(data.criteria);
                $('#alternativeCount').html(data.alternative);
                $('#evaluationCount').html(data.evaluation);
            }
        });
    }
</script>
