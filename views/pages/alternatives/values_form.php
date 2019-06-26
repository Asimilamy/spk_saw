<?php
$view = isset($view) ? $view : 'form' ;
$values = isset($values) ? $values : [] ;
$criterias = isset($criterias) ? $criterias : [] ;
$options = isset($options) ? $options : [] ;

if (!empty($values)) {
    foreach ($values as $value) {
        $alternative_criterias[$value->criteria_id] = $value->criteria_option_id;
        $alternative_options[$value->criteria_option_id] = $value->criteria_option_id;
        $alternative_weights[$value->criteria_id] = $value->weight;
        $alternative_values[$value->criteria_id] = $value->value;
    }
}

if ($view == 'form') {
    foreach ($criterias as $criteria) {
        ?>
        <hr>
        <div class="form-group">
            <input type="hidden" name="criteria_ids[]" value="<?php echo $criteria->id; ?>">
            <label><?php echo 'Nama Kriteria : ' . $criteria->name; ?></label>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-md-6">
                <?php
                if ($criteria->type == 'option') {
                    ?>
                    <input type="hidden" name="option_ids[]" class="criteria-ids" value="<?php echo isset($alternative_criterias[$criteria->id]) ? $alternative_criterias[$criteria->id] : '' ; ?>">
                    <select name="criteria_weights[]" class="form-control criteria-select">
                        <option value="">-- Pilih Option --</option>
                        <?php
                        foreach ($options as $option) {
                            if ($option->criteria_id == $criteria->id) {
                                $selected = in_array($option->id, $alternative_options) ? 'selected' : '' ;
                                echo '<option value=\''.$option->value.'\' data-id=\''.$option->id.'\' '.$selected.'>'.$option->name.'</option>';
                            }
                        }
                        ?>
                    </select>
                    <?php
                } else {
                    ?>
                    <input type="text" name="criteria_weights[]" class="form-control" placeholder="Bobot Kriteria" value="<?php echo isset($alternative_weights[$criteria->id]) ? $alternative_weights[$criteria->id] : '' ; ?>">
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-md-6">
                <input type="text" name="criteria_values[]" class="form-control" placeholder="Nilai" value="<?php echo isset($alternative_values[$criteria->id]) ? $alternative_values[$criteria->id] : '' ; ?>">
            </div>
        </div>
        <?php
    }
} elseif ($view == 'view') {
    ?>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kriteria</th>
                <th>Pilihan</th>
                <th>Bobot</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;
            foreach ($criterias as $criteria) {
                foreach ($options as $option) {
                    if ($option->criteria_id == $criteria->id && in_array($option->id, $alternative_options)) {
                        $no++;
                        echo '<tr>';
                            echo '<td>' . $no . '</td>';
                            echo '<td>' . $criteria->name . '</td>';
                            echo '<td>' . $option->name . '</td>';
                            echo '<td>' . $alternative_weights[$criteria->id] . '</td>';
                            echo '<td>' . $alternative_values[$criteria->id] . '</td>';
                        echo '</tr>';
                    }
                }
            }
            ?>
        </tbody>
    </table>
    <?php
}
