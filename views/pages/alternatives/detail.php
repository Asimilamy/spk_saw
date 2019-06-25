<?php
$view = isset($view)? $view : 'home' ;
?>

<div class="row form-row">
    <div class="col-xs-12">
        <div class="box box-info box-form">
            <div class="box-header with-border">
                <h3 class="box-title">Alternatives Detail</h3>

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
                    <div class="row">
                        <label for="name" class="col-xs-2">Name : </label>
                        <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                        <div class="col-xs-10"><?php echo $data->name; ?></div>
                    </div>
                    <div class="row">
                        <label for="created_at" class="col-xs-2">Created At</label>
                        <div class="col-xs-10">
                            <?php echo format_date($data->created_at, 'd M Y, H:i:s'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="updated_at" class="col-xs-2">Updated At</label>
                        <div class="col-xs-10">
                            <?php echo format_date($data->updated_at, 'd M Y, H:i:s'); ?>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </form>
        </div>
    </div>
</div>
