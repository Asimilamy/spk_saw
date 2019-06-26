<?php
$alternatives = isset($alternatives) ? $alternatives : [] ;
$alternative_values = isset($alternative_values) ? $alternative_values : [] ;
$criterias = isset($criterias) ? $criterias : [] ;
$criteria_options = isset($criteria_options) ? $criteria_options : [] ;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Evaluation Result</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="box-body">
                <h3>Choices of Alternative Table</h3>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th colspan="<?php echo count($criterias); ?>" style="text-align: center;">Criterias</th>
                        </tr>
                        <tr>
                            <th>Alternatives</th>
                            <?php
                            foreach ($criterias as $criteria) {
                                ?>
                                <th><?php echo $criteria->name; ?></th>
                                <?php
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($alternatives as $alternative) {
                            ?>
                            <tr>
                                <td><?php echo $alternative->name; ?></td>
                                <?php
                                foreach ($criterias as $criteria) {
                                    foreach ($alternative_values as $alternative_value) {
                                        if ($alternative_value->alternative_id == $alternative->id && 
                                            $alternative_value->criteria_id == $criteria->id
                                        )
                                            echo '<td>' . $alternative_value->value . '</td>';
                                    }
                                } 
                                ?>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                
                <h3>Weight Values of Criterias in Alternative</h3>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Alternatives</th>
                            <?php
                            $no = 0;
                            foreach ($criterias as $criteria) {
                                $no++;
                                echo '<th>C' . $no . '</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($alternatives as $alternative) {
                            $no++;
                            ?>
                            <tr>
                                <td><?php echo 'A' . $no; ?></td>
                                <?php
                                foreach ($criterias as $criteria) {
                                    foreach ($alternative_values as $alternative_value) {
                                        if ($alternative_value->alternative_id == $alternative->id && 
                                            $alternative_value->criteria_id == $criteria->id
                                        )
                                            echo '<td>' . $alternative_value->weight . '</td>';
                                    }
                                } 
                                ?>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
