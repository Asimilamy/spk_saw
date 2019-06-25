<?php
$page = filter_input(INPUT_GET, 'hal', FILTER_DEFAULT);
$view = empty($page)? 'home' : $page ;
?>

<script>
    get_form('<?php echo $_SESSION['auth']['id']; ?>');
</script>
