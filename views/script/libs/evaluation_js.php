<?php
$page = filter_input(INPUT_GET, 'hal', FILTER_DEFAULT);
$view = empty($page)? 'home' : $page ;
?>

<script>
    $(document).off('submit', '#formEvaluation').on('submit', '#formEvaluation', function(e) {
        e.preventDefault();
        start_evaluating();
    });

    function start_evaluating() {
        $('.evaluation-result').slideUp(function() {
            $(this).html('').promise().done(function() {
                $.ajax({
                    url: 'controllers/evaluation.php',
                    type: 'POST',
                    data: {'act': 'start_evaluating'},
                    success: function(html) {
                        $('.evaluation-result').html(html).promise().done(function() {
                            $('.evaluation-result').slideDown();
                        });
                    }
                });
            });
        });
    }
</script>
