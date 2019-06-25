<?php
$view = isset($view)? $view : 'home' ;
?>

<div class="row form-row">
    <div class="col-xs-12">
        <div class="box box-primary box-form">
            <div class="box-header with-border">
                <h3 class="box-title">Criteria Form</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool remove-form" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="formAjax" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-alert"></div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="hidden" name="act" value="submit_form">
                        <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?php echo $data->name; ?>" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="attribute">Attribute</label>
                        <select name="attribute" id="attribute" class="form-control" required>
                            <option value="">-- Select Attribute --</option>
                            <?php
                            $attributes = ['cost', 'benefit'];
                            foreach ($attributes as $attribute) {
                                $selected = $data->attribute == $attribute ? 'selected' : '' ;
                                echo '<option value=\''.$attribute.'\' '.$selected.'>'.ucwords($attribute).'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">-- Select Type --</option>
                            <?php
                            $types = ['value', 'option'];
                            foreach ($types as $type) {
                                $selected = $data->type == $type ? 'selected' : '' ;
                                echo '<option value=\''.$type.'\' '.$selected.'>'.ucwords($type).'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight (%)</label>
                        <input type="text" name="weight" id="weight" class="form-control" placeholder="Weight" value="<?php echo $data->weight; ?>">
                    </div>
                    <div id="attribute-options"></div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    get_options_form($('input[name=id]').val(), $('#type').val(), 'form');
</script>
