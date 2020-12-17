
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
                    <input type="submit" value="Add Result" id="addResult" class="form-control btn btn-info">
                    <br><br>
                    <input type="submit" value="Search Result" id="searchResult" class="form-control btn btn-success">
                </div> <!-- col-sm-4 -->
            </div> <!-- form-group -->
            
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

<div class="row" id="summaryRow">
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
                                <td><h4 style="color:green"> = <b id="totalStudents">0</b></h4></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4">
                        <table>
                            <tr>
                                <td><h4>Attend Students </h4></td>
                                <td><h4 style="color:green"> = <b id="totalAttend">0</b></h4></td>
                            </tr>
                            <tr>
                                <td><h4>Absent Students </h4></td>
                                <td><h4 style="color:red"> = <b id="totalAbsent">0</b></h4></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4">
                    <table>
                            <tr>
                                <td><h4>Pass Students </h4></td>
                                <td><h4 style="color:green"> = <b id="passStudents">0</b></h4></td>
                            </tr>
                            <tr>
                                <td><h4>Fail Students</h4></td>
                                <td><h4 style="color:red"> = <b id="failStudents">0</b></h4></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- col-sm-12 -->
</div><!-- summary row -->

<div class="row" id="resultRow">
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

</div><!-- search result row -->
 
<div class="row" id="addResultRow">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">Add Result</div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Roll/ID</th>
                            <th style="width: 40%;">Name</th>
                            <th>Total Mark</th>
                            <th>Download</th>
                            <th>Add</th>
                            <th style="visibility:hidden; width:10px">ID</th>
                        </tr>
                    </thead>
                    <tbody id="pdfStudentList"></tbody>
                </table>
            </div>
        </div>
    </div>
</div><!-- add result row -->

<!-- Modal -->

<div class="modal fade " id="downloadAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Update Result</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    
                    <input type="hidden" name="onlineExamUserStatus" id="onlineExamUserStatus">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="preview" id="answerFileDiv"> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Total Question <span class="text-red">*</span> </label>
                                <input type="number" class="form-control" id="totalQuestion" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Total Answer <span class="text-red">*</span></label>
                                <input type="number" class="form-control" id="totalAnswer" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Total Correct Answer <span class="text-red">*</span></label>
                                <input type="number" class="form-control" id="totalCorrectAnswer" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Total Mark <span class="text-red">*</span></label>
                                <input type="number" class="form-control" id="totalMark" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Total Obtained Mark <span class="text-red">*</span></label>
                                <input type="number" class="form-control" id="totalObtainedMark" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Details</label>
                                <textarea class="form-control" id="details"></textarea>
                            </div>

                        </div>
                    </div>
                    
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <div class="btn btn-sm btn-danger" id="downloadAnswerFile"></div>
                <button type="submit" class="btn btn-primary" id="updateResult" data-dismiss="modal">Update Result</button>
            </div>
        </div>
    </div>
</div>

<!-- <div class="box" id="load_onlineexamreport"></div> -->

<script type="text/javascript">

    $(function(){
        $('#summaryRow').hide();
        $('#resultRow').hide();
        $('#addResultRow').hide();
    });
    
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

        $('#summaryRow').show();
        $('#resultRow').show();
        $('#addResultRow').hide();

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
    });

    $(document).on('click','#addResult', function(){
        $('#summaryRow').hide();
        $('#resultRow').hide();
        $('#addResultRow').show();

        var classesID=$('#classes').val();
        var onlineExamID=$('#online_exam').val();

        $.ajax({
            url:"<?php echo base_url('onlineexamreport/get_pdf_ans_student_list') ?>",
            type:"POST",
            data:{'classesID':classesID, 'onlineExamID':onlineExamID},
            dataType:"json",
            success:function(data){
                // var pdfStudentList=data['studentList'];
                
                // var index=1;
		        var tableRow = '';
                var index=1;

                for (var row in data) {
                    if(data[row]['totalObtainedMark'] == "0" || data[row]['answerFile'] != NULL || data[row]['answerFile'] != ""){
                        tableRow += '<tr>';
                        tableRow += '<td>'+(index++)+'</td>';
                        tableRow += '<td>'+data[row]['roll']+'</td>';
                        tableRow += '<td>'+data[row]['name']+'</td>';
                        tableRow += '<td>'+data[row]['totalMark']+'</td>';
                        // tableRow += '<td> <a href="'+ <?php echo base_url('') ?> +'">Download & Update Result</a> </td>';
                        tableRow += '<td> <button type="button" class="btn btn-xs btn-primary updateButton" id="'+ data[row]['onlineExamUserStatus'] +'" >Download & Update Result</button> </td>';
                        // tableRow += '<td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#downloadAddModal">Download & Update Result</button></td>';
                        // tableRow += '<td> <a href="onlineexamreport/download_answer_file/'+ data[row]['onlineExamUserStatus'] +'" class="btn btn-sm btn-info">Download File</a></td>';
                        tableRow += '<td>Add Answer</td>';
                        tableRow += '<td style="visibility:hidden" >'+data[row]['onlineExamUserStatus']+'</td>';
                        tableRow += '<tr>';
                    }
                    
                }

                $('#pdfStudentList').html(tableRow);
                
            }
        });
    });

    $(document).on('click','.updateButton', function(){

        var onlineExamUserStatus=$(this).attr('id');

        $.ajax({
            url:"<?php echo base_url('onlineexamreport/get_single_examAttend') ?>",
            type:"POST",
            data:{'onlineExamUserStatus':onlineExamUserStatus},
            dataType:'json',
            success:function(data){

                $('#downloadAddModal').modal('show');

                var totalMark =data['totalMark'];
                var answerFile =data['answerFile'];
                var downloadAnswer =data['downloadAnswer'];

                $('#onlineExamUserStatus').val(onlineExamUserStatus);
                $('#totalMark').val(totalMark);;
                $('#answerFileDiv').html(answerFile);
                $('#downloadAnswerFile').html(downloadAnswer);

            }

        });
    });

    $(document).on('click','#updateResult', function(){

        var onlineExamUserStatus =$('#onlineExamUserStatus').val();
        var totalQuestion =$('#totalQuestion').val();
        var totalAnswer =$('#totalAnswer').val();
        var totalCorrectAnswer =$('#totalCorrectAnswer').val();
        var totalMark =$('#totalMark').val();
        var totalObtainedMark =$('#totalObtainedMark').val();
        var details =$('#details').val();

        $.ajax({
            url:"<?php echo base_url('onlineexamreport/update_result') ?>",
            type:"POST",
            data:{'onlineExamUserStatus':onlineExamUserStatus, 'totalQuestion': totalQuestion, 'totalAnswer': totalAnswer
                    , 'totalCorrectAnswer':totalCorrectAnswer , 'totalMark':totalMark , 'totalObtainedMark':totalObtainedMark 
                    , 'details':details},
            dataType:'json',
            success:function(data){

                alart(data);
                // $('#downloadAddModal').modal('close');
                
                // var totalMark =data['totalMark'];
                // var answerFile =data['answerFile'];
                // var downloadAnswer =data['downloadAnswer'];

                // $('#onlineExamUserStatus').val(onlineExamUserStatus);
                // $('#totalMark').val(totalMark);;
                // $('#answerFileDiv').html(answerFile);
                // $('#downloadAnswerFile').html(downloadAnswer);

            }

        });
        
        // alert(onlineExamUserStatus);
        
    });
    
</script>
