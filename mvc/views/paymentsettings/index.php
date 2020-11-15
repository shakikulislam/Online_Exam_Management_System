<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-paymentsettings"></i> <?$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_paymentsettings')?></li>
        </ol>

        
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="panel">
                    <form action=" <?php echo base_url('paymentsettings') ?>" method="post">
                    <table class="center">
                        <!-- <h2>Search Student ID/Roll</h2> -->
                        <tr>
                            <td style="width: 100%;">
                                <input type="number" name="studentRoll" class="form-control" placeholder="Search Student ID/Roll">
                            </td>
                            <td>
                                <input type="submit" name="submit " value="Search" class="form-control btn btn-success">   
                            </td>
                        </tr>

                    </table>
                </form>
                </div> <!-- panel -->
                
            </div>
            <div class="col-sm-3"></div>
        </div> <!-- Row -->
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">
                            Student Information
                        </div>
                    </div>
                    <div class="panel-body">
                    
                        <?php if($stInfo){?>

                            <table class="table table-striped table-bordered table-hover dataTable no-footer">
                                <tr>
                                    <td>Name</td>
                                    <td><?php echo $stInfo->name; ?></td>
                                </tr>
                                <tr>
                                    <td>Roll No</td>
                                    <td><?php echo $stInfo->roll; ?></td>
                                </tr>
                                <tr>
                                    <td>Phone No</td>
                                    <td><?php echo $stInfo->phone; ?></td>
                                </tr>
                                <tr>
                                    <td>Sex</td>
                                    <td><?php echo $stInfo->sex; ?></td>
                                </tr>
                            </table>

                        <?php } else {?>
                            <h3>No Data Available</h3>
                       <?php } ?>
                    
                    </div>
                </div>
                
            </div> <!-- col-sm-6 -->
            <div class="col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">
                            Payment
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if($stInfo){?>
                            <form action="<?php echo base_url('paymentsettings/add_payment') ?>" method="post">

                                <input type="hidden" name="studentID" value="<?php echo $stInfo->studentID ?>">
                                <input type="hidden" name="classesID" value="<?php echo $stInfo->classesID ?>">





                                <label class="label form-control">Running Class</label>
                                <input type="text" name="classes" class="form-control" value="<?php echo $stInfo->classes ?>">
                                <br>
                                
                                <input onclick="return confirm('Are you')" type="submit" value="Confirm" class="btn btn-success">
                            </form>
                        <?php } else {?>
                            <h3>No Data Available</h3>
                       <?php } ?>
                    </div>
                </div> <!-- panel -->
            </div> <!-- col-sm-6 -->
        </div> <!-- row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">
                            Payment Summary
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Class</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=1; foreach ($stRoll as $d) { ?>

                                    <tr>
                                        <td><?php echo $sl++ ?></td>
                                        <td><?php echo $d['classes']; ?></td>
                                        <td>Paid</td>
                                    </tr>
                                            
                                <?php } ?>
                                
                            </tbody>
                        </table>
                    
                </div>
            </div> <!-- col-sm-12 -->
        </div> <!-- row -->
    </div>




</div>