<?php
function render_options(array $options) {
    $form = '';
    $no = 0;
    if (empty($options)) {
        $form .= options_form(FALSE, '', '', 'add');
    } else {
        foreach ($options as $option) {
            $no++;
            $is_mt = $no > 1 ? TRUE : FALSE ;
            $btn = $no == 1 ? 'add' : 'remove' ;
            $form .= options_form($is_mt, $option->name, $option->value, $btn);
        }
    }

    return $form;
}

function options_form($is_mt = TRUE, $name = '', $value = '', $btn = 'add') {
    $form = '';
    $mt = $is_mt ? 'margin-top: 15px;' : '' ;
    $is_hidden = $btn == 'remove' ? 'display: none;' : '' ;
    $form .= '<div class=\'row option-form\' style=\''.$mt.' '.$is_hidden.'\'>';
        $form .= '<div class=\'col-xs-3\'>';
            $form .= '<input type=\'text\' name=\'option_name[]\' class=\'form-control\' placeholder=\'Option Name\' value=\''.$name.'\'>';
        $form .= '</div>';
        $form .= '<div class=\'col-xs-3\'>';
            $form .= '<input type=\'number\' name=\'option_value[]\' class=\'form-control\' placeholder=\'Option Value\' value=\''.$value.'\'>';
        $form .= '</div>';
        if ($btn == 'add') {
            $form .= '<div class=\'col-xs-1\'>';
                $form .= '<button type=\'button\' class=\'btn btn-success btn-add-options\' data-toggle=\'tooltip\' title=\'Add Options\'>';
                    $form .= '<i class=\'fa fa-plus\'></i>';
                $form .= '</button>';
            $form .= '</div>';
        } elseif ($btn == 'remove') {
            $form .= '<div class=\'col-xs-1\'>';
                $form .= '<button type=\'button\' class=\'btn btn-danger btn-remove-options\' data-toggle=\'tooltip\' title=\'Remove Options\'>';
                    $form .= '<i class=\'fa fa-trash\'></i>';
                $form .= '</button>';
            $form .= '</div>';
        }
    $form .= '</div>';

    return $form;
}
