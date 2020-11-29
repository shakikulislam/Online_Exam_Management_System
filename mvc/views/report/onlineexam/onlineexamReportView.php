
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa iniicon-onlineexamreport"></i> <?=$this->lang->line('panel_title')?></h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_onlineexamreport')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="form-group">
                <div class="col-sm-4">
                    <label>Class <span class="text-red">*</span> </label>
                    <select name="classes" id="classes" class="form-control">
                        <option value="0">Please Select</option>
                        <?php
                            foreach($classes as $row){
                                echo '<option value="'.$row->classesID.'">'.$row->classes.'</option>';
                            }
                        ?>
                    </select>
                </div> <!-- col-sm-4 -->
                <div class="col-sm-4">
                    <label>Exam <span class="text-red">*</span> </label>
                    <select name="online_exam" id="online_exam" class="form-control">
                        <option value="0">Please Select</option>
                    </select>
                </div> <!-- col-sm-4 -->
                <div class="col-sm-4">
                    <label></label>
                    <input type="submit" value="Search" id="searchResult" class="form-control btn btn-success">
                </div> <!-- col-sm-4 -->
            </div> <!-- form-group -->
            
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">
                <i class="fa fa-info-circle"></i> Exam Summary
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <table>
                            <tr>
                                <td><h4>Total Students </h4></td>
                                <td><h4 style="color:green"> = <b id="totalStudents"></b></h4></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4">
                        <table>
                            <tr>
                                <td><h4>Attend Students </h4></td>
                                <td><h4 style="color:green"> = <b id="totalAttend"></b></h4></td>
                            </tr>
                            <tr>
                                <td><h4>Absent Students </h4></td>
                                <td><h4 style="color:red"> = <b id="totalAbsent"></b></h4></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4">
                    <table>
                            <tr>
                                <td><h4>Pass Students </h4></td>
                                <td><h4 style="color:green"> = <b id="passStudents"></b></h4></td>
                            </tr>
                            <tr>
                                <td><h4>Fail Students</h4></td>
                                <td><h4 style="color:red"> = <b id="failStudents"></b></h4></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- col-sm-12 -->
</div><!-- row -->

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="panel-title">
                <i class="fa icon-student"></i> Passed Students
                
                </div>
            </div><!-- panel-heading -->
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Roll/ID</th>
                            <th>Name</th>
                            <th>Total Mark</th>
                            <th>Obtained Mark</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody id="passStudentList">
                        
                    </tbody>
                </table>
            </div><!-- panel-body -->
        </div> <!-- panel -->
    </div><!-- col-sm-6 -->

    <div class="col-sm-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="panel-title">
                <i class="fa icon-student"></i> Fail Students
                
                </div>
            </div><!-- panel-heading -->
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Roll/ID</th>
                            <th>Name</th>
                            <th>Total Mark</th>
                            <th>Obtained Mark</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody id="failStudentList">
                        
                    </tbody>
                </table>
            </div><!-- panel-body -->
        </div> <!-- panel -->
    </div><!-- col-sm-6 -->

</div><!-- row -->
 
<!-- <div class="box" id="load_onlineexamreport"></div> -->

<script type="text/javascript">
    
    $(document).on('change','#classes',function(){
        // alert('Work...');
        var classesID=$(this).val();
        // alert(classesID);
        
        $.ajax({
            url:"<?php echo base_url('onlineexamreport/get_all_exam_by_classes') ?>",
            type:"POST",
            data:{'classesID':classesID},
            dataType: 'json',
            success: function(data){
                $('#online_exam').html(data);
            }
        });
        
    });

    $(document).on('click','#searchResult',function(){
        var classesID=$('#classes').val();
        var onlineExamID=$('#online_exam').val();
        $.ajax({
            url:"<?php echo base_url('onlineexamreport/get_pass_fail_student_list') ?>",
            type:"POST",
            data:{'classesID':classesID, 'onlineExamID':onlineExamID},
            dataType:'json',
            success:function(data){
                var passStudentList =data['passTableRow'];
                var failStudentList =data['failTableRow'];

                // var passStudent=data.length;
                $('#passStudentList').html(passStudentList);
                $('#failStudentList').html(failStudentList);
                // $('#passStudent').html(passStudent);

            }

        });
        $.ajax({
            url:"<?php echo base_url('onlineexamreport/get_summary') ?>",
            type:"POST",
            data:{'classesID':classesID, 'onlineExamID':onlineExamID},
            dataType:'json',
            success:function(data){
                var totalStudents=data['totalStudents'];
                var totalAttend=data['totalAttend'];
                var totalAbsent=(totalStudents-totalAttend);
                var totalPass =data['totalPass'];
                var totalFail =data['totalFail'];

                $('#totalStudents').html(totalStudents);
                $('#totalAttend').html(totalAttend);
                $('#totalAbsent').html(totalAbsent);
                $('#passStudents').html(totalPass);
                $('#failStudents').html(totalFail);
                // $('#totalStudents').html(data);
                // $('#totalAttend').html(data);

            }
        });
        
        // alert(classesID);
    });
    // $(document).ready(function(){
    //     $('#classes').change(function(){
    //         var classesID= $('#classes').val();
    //         if(classesID != ''){
    //             $.ajax({
    //                 type:"POST",
    //                 url:"<?php echo base_url('Onlineexamreport/get_all_exam_by_classes');?>",
    //                 data:{classesID:classesID},
    //                 dataType: "html",
    //                 success:function(data){
    //                     $('#online_exam').html(data);
    //                 }
    //             })
    //         }
    //     });
    // });
//-----------------------------------------------------------

    // $(document).on('change', "#onlineexamID, #classesID", function() {
    //     var id = $(this).val();
    //     if(id != '0') {
    //         divShow()
    //     }
    // })

    // $(document).on('change', "#classesID", function() {
    //     var classesID = $(this).val();
    //     if(classesID == '0') {
    //         $('#sectionID').html('<option value="">'+"<?=$this->lang->line("onlineexamreport_please_select")?>"+'</option>');
    //         $('#sectionID').val('');

    //         $('#studentID').html('<option value="0">'+"<?=$this->lang->line("onlineexamreport_please_select")?>"+'</option>');
    //         $('#studentID').val(0);
    
    //     } else {
    //         $.ajax({
    //             type: 'POST',
    //             url: "<?=base_url('onlineexamreport/getSection')?>",
    //             data: {"classesID" : classesID},
    //             dataType: "html",
    //             success: function(data) {
    //                $('#sectionID').html(data);
    //             }
    //         });

    //         $.ajax({
    //             type: 'POST',
    //             url: "<?=base_url('onlineexamreport/getStudent')?>",
    //             data: {'classesID' : classesID, 'sectionID' : 0},
    //             dataType: "html",
    //             success: function(data) {
    //                $('#studentID').html(data);
    //             }
    //         });
    //     }
    // });

    // $(document).on('change', "#sectionID", function() {
    //     var classesID = $('#classesID').val();
    //     var sectionID = $('#sectionID').val();

    //     $.ajax({
    //         type: 'POST',
    //         url: "<?=base_url('onlineexamreport/getStudent')?>",
    //         data: {'classesID' : classesID, 'sectionID' : sectionID},
    //         dataType: "html",
    //         success: function(data) {
    //            $('#studentID').html(data);
    //         }
    //     });
    // });

    // $(document).on('click', "#get_onlineexam", function() {
    //     var error = 0 ;
    //     var field = {
    //         'onlineexamID'  : $('#onlineexamID').val(), 
    //         'classesID'     : $('#classesID').val(), 
    //         'sectionID'     : $('#sectionID').val(), 
    //         'studentID'     : $('#studentID').val(), 
    //         'statusID'      : $('#statusID').val(),  
    //     }

    //     error = validation_checker(field, error);

    //     if(error === 0) {
    //         makingPostDataPreviousofAjaxCall(field);
    //     }
    // });

    // function validation_checker(field, error) {
    //     if(field['onlineexamID'] == 0 && field['classesID'] == 0) {
    //         $('#onlineexamDiv').addClass('has-error');
    //         $('#classesDiv').addClass('has-error');
    //         error++;
    //     } else {
    //         $('#onlineexamDiv').removeClass('has-error');
    //         $('#classesDiv').removeClass('has-error');
    //     }

    //     if (field['statusID'] == 0) {
    //         $('#statusDiv').addClass('has-error');
    //         error++;
    //     } else {
    //         $('#statusDiv').removeClass('has-error');
    //     }

    //     return error;
    // }

    // function makingPostDataPreviousofAjaxCall(field) {
    //     passData = field;
    //     ajaxCall(passData);
    // }

    // function ajaxCall(passData) {
    //     $.ajax({
    //         type: 'POST',
    //         url: "<?=base_url('onlineexamreport/getUserList')?>",
    //         data: passData,
    //         dataType: "html",
    //         success: function(data) {
    //             var response = JSON.parse(data);
    //             renderLoder(response, passData);
    //         }
    //     });
    // }

    // function renderLoder(response, passData) {
    //     if(response.status) {
    //         $('#load_onlineexamreport').html(response.render);
    //         for (var key in passData) {
    //             if (passData.hasOwnProperty(key)) {
    //                 $('#'+key).parent().removeClass('has-error');
    //             }
    //         }
    //     } else {
    //         for (var key in passData) {
    //             if (passData.hasOwnProperty(key)) {
    //                 $('#'+key).parent().removeClass('has-error');
    //             }
    //         }

    //         for (var key in response) {
    //             if (response.hasOwnProperty(key)) {
    //                 $('#'+key).parent().addClass('has-error');
    //             }
    //         }
    //     }
    // }
</script>
