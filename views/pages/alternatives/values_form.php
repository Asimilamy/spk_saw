<?php
$data = isset($data) ? $data : [] ;
$criterias = isset($criterias) ? $criterias : [] ;
$options = isset($options) ? $options : [] ;
foreach ($criterias as $criteria) {
    echo $criteria->name.' '.$criteria->attribute.' '.$criteria->type.'<br>';
    foreach ($options as $option) {
        if ($option->criteria_id == $criteria->id) {
            echo $option->name.' '.$option->value.'<br>';
        }
    }
    echo '<hr>';
}
