<?php
function render_options(array $options, string $view) {
    $form = '';
    $no = 0;
    if (empty($options)) {
        $form .= options_form(FALSE, '', '', 'add', $view);
    } else {
        foreach ($options as $option) {
            $no++;
            $is_mt = $no > 1 ? TRUE : FALSE ;
            $btn = $no == 1 ? 'add' : 'remove' ;
            $form .= options_form($is_mt, $option->name, $option->value, $btn, $view);
        }
    }

    return $form;
}

function options_form($is_mt = TRUE, $name = '', $value = '', $btn = 'add', string $view) {
    $form = '';
    $mt = $is_mt ? 'margin-top: 15px;' : '' ;
    $is_hidden = $btn == 'remove' ? 'display: none;' : '' ;
    if ($btn == 'add' && $view == 'view') {
        $form .= '<div class=\'row option-form\' style=\''.$mt.'\'>';
            $form .= '<label class=\'col-xs-3\'>';
                $form .= 'Name';
            $form .= '</label>';
            $form .= '<label class=\'col-xs-3\'>';
                $form .= 'Weight';
            $form .= '</label>';
        $form .= '</div>';
    }
    $form .= '<div class=\'row option-form\' style=\''.$mt.' '.$is_hidden.'\'>';
        $form .= '<div class=\'col-xs-3\'>';
            if ($view == 'form') {
                $form .= '<input type=\'text\' name=\'option_name[]\' class=\'form-control\' placeholder=\'Option Name\' value=\''.$name.'\'>';
            } elseif ($view == 'view') {
                $form .= $name;
            }
        $form .= '</div>';
        $form .= '<div class=\'col-xs-3\'>';
            if ($view == 'form') {
                $form .= '<input type=\'number\' name=\'option_value[]\' class=\'form-control\' placeholder=\'Option Value\' value=\''.$value.'\'>';
            } elseif ($view == 'view') {
                $form .= $value;
            }
        $form .= '</div>';
        if ($view == 'form') {
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
        }
    $form .= '</div>';

    return $form;
}
