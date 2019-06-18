<div class="row form-row">
    <div class="col-xs-12">
        <div class="box box-primary box-form">
            <div class="box-header with-border">
                <h3 class="box-title">User Form</h3>

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
                        <label for="username">Username</label>
                        <input type="hidden" name="act" value="submit_form">
                        <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?php echo $data->username; ?>" autofocus>
                    </div>
                    <?php
                    if (!empty($data->password)) {
                        ?>
                        <div class="callout callout-warning">
                            <h4>Warning!</h4>
                            <p>Leave password field blank, unless you gonna change the password!</p>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="passwordConf">Confirm Password</label>
                        <input type="password" name="password_confirm" class="form-control" id="passwordConf" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?php echo $data->name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $data->email; ?>">
                    </div>
                    <?php
                    if (!empty($data->user_img)) {
                        ?>
                        <div class="callout callout-warning">
                            <h4>Warning!</h4>
                            <p>Leave user image field blank, unless you gonna change the user image!</p>
                        </div>
                        <img src="assets/img/<?php echo $data->user_img; ?>" alt="..." class="margin">
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="user_image">User Image</label>
                        <input type="file" name="user_image" id="user_image">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
