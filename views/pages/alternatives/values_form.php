<?php
$data = isset($data) ? $data : [] ;
$criterias = isset($criterias) ? $criterias : [] ;
$options = isset($options) ? $options : [] ;
foreach ($criterias as $criteria) {
    ?>
    <hr>
    <div class="form-group">
        <input type="hidden" name="criteria_ids[]" value="<?php echo $criteria->id; ?>">
        <label><?php echo 'Nama Kriteria : ' . $criteria->name; ?></label>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-md-6">
            <input type="hidden" name="option_ids[]" class="criteria-ids">
            <select name="criteria_weights[]" class="form-control criteria-select">
                <option value="">-- Pilih Option --</option>
                <?php
                foreach ($options as $option) {
                    if ($option->criteria_id == $criteria->id) {
                        echo '<option value=\''.$option->value.'\' data-id=\''.$option->id.'\'>'.$option->name.'</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-md-6">
            <input type="text" name="criteria_values[]" class="form-control" placeholder="Nilai">
        </div>
    </div>
    <?php
}
