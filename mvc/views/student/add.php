<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-student"></i> <?=$this->lang->line('panel_title')?></h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("student/index")?>"><?=$this->lang->line('menu_student')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('panel_title')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-10">
                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group <?=form_error('name') ? 'has-error' : ''?>">
                        <label for="name_id" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_name")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name_id" name="name" value="<?=set_value('name')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('name'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('guargianID') ? 'has-error' : ''?>">
                        <label for="guargianID" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_guargian")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $array = array('0' => $this->lang->line('student_select_guargian'));
                                foreach ($parents as $parent) {
                                    $parentsemail = '';
                                    if($parent->email) {
                                        $parentsemail = " (" . $parent->email ." )";
                                    }
                                    $array[$parent->parentsID] = $parent->name.$parentsemail;
                                }
                                echo form_dropdown("guargianID", $array, set_value("guargianID"), "id='guargianID' class='form-control guargianID select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('guargianID'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('dob') ? 'has-error' : ''?>">
                        <label for="dob" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_dob")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="dob" name="dob" value="<?=set_value('dob')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('dob'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('sex') ? 'has-error' : ''?>">
                        <label for="sex" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_sex")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                echo form_dropdown("sex", array($this->lang->line('student_sex_male') => $this->lang->line('student_sex_male'), $this->lang->line('student_sex_female') => $this->lang->line('student_sex_female')), set_value("sex"), "id='sex' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('sex'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('bloodgroup') ? 'has-error' : ''?>">
                        <label for="bloodgroup" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_bloodgroup")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $bloodArray = array(
                                    '0' => $this->lang->line('student_select_bloodgroup'),
                                    'A+' => 'A+',
                                    'A-' => 'A-',
                                    'B+' => 'B+',
                                    'B-' => 'B-',
                                    'O+' => 'O+',
                                    'O-' => 'O-',
                                    'AB+' => 'AB+',
                                    'AB-' => 'AB-'
                                );
                                echo form_dropdown("bloodgroup", $bloodArray, set_value("bloodgroup"), "id='bloodgroup' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('bloodgroup'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('religion') ? 'has-error' : ''?>">
                        <label for="religion" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_religion")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="religion" name="religion" value="<?=set_value('religion')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('religion'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('email') ? 'has-error' : ''?>">
                        <label for="email" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_email")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('email'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('phone') ? 'has-error' : ''?>">
                        <label for="phone" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_phone")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?=set_value('phone')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('phone'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('address') ? 'has-error' : ''?>">
                        <label for="address" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_address")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('address'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('state') ? 'has-error' : ''?>">
                        <label for="state" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_state")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="state" name="state" value="<?=set_value('state')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('state'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('country') ? 'has-error' : ''?>">
                        <label for="country" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_country")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $country['0'] = $this->lang->line('student_select_country');
                                foreach ($allcountry as $allcountryKey => $allcountryit) {
                                    $country[$allcountryKey] = $allcountryit;
                                }
                            ?>
                            <?php
                                echo form_dropdown("country", $country, set_value("country"), "id='country' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('country'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('classesID') ? 'has-error' : ''?>">
                        <label for="classesID" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_classes")?> <span class="text-red"> *</span>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $array = array(0 => $this->lang->line("student_select_class"));
                                foreach ($classes as $classa) {
                                    $array[$classa->classesID] = $classa->classes;
                                }
                                echo form_dropdown("classesID", $array, set_value("classesID"), "id='classesID' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('classesID'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('sectionID') ? 'has-error' : ''?>">
                        <label for="sectionID" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_section")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $array = array(0 => $this->lang->line("student_select_section"));
                                if($sections != "empty") {
                                    foreach ($sections as $section) {
                                        $array[$section->sectionID] = $section->section;
                                    }
                                }

                                $sID = 0;
                                if($sectionID == 0) {
                                    $sID = 0;
                                } else {
                                    $sID = $sectionID;
                                }

                                echo form_dropdown("sectionID", $array, set_value("sectionID", $sID), "id='sectionID' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('sectionID'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('studentGroupID') ? ' has-error' : ''  ?>">
                        <label for="studentGroupID" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_studentgroup")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $groupArray = array(0 => $this->lang->line("student_select_studentgroup"));
                                if(inicompute($studentgroups)) {
                                    foreach ($studentgroups as $studentgroup) {
                                        $groupArray[$studentgroup->studentgroupID] = $studentgroup->group;
                                    }
                                }
                                echo form_dropdown("studentGroupID", $groupArray, set_value("studentGroupID"), "id='studentGroupID' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('studentGroupID'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('optionalSubjectID') ? ' has-error' : ''  ?>">
                        <label for="optionalSubjectID" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_optionalsubject")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                            $optionalSubjectArray = array(0 => $this->lang->line("student_select_optionalsubject"));
                            if($optionalSubjects != "empty") {
                                foreach ($optionalSubjects as $optionalSubject) {
                                    $optionalSubjectArray[$optionalSubject->subjectID] = $optionalSubject->subject;
                                }
                            }

                            echo form_dropdown("optionalSubjectID", $optionalSubjectArray, set_value("optionalSubjectID", $optionalSubjectID), "id='optionalSubjectID' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('optionalSubjectID'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('registerNO') ? 'has-error' : ''?>">
                        <label for="registerNO" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_registerNO")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="registerNO" name="registerNO" value="<?=set_value('registerNO')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('registerNO'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('roll') ? 'has-error' : ''?>">
                        <label for="roll" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_roll")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="roll" name="roll" value="<?=set_value('roll')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('roll'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('photo') ? 'has-error' : ''?>">
                        <label for="photo" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_photo")?>
                        </label>
                        <div class="col-sm-6">
                            <div class="input-group image-preview">
                                <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                        <span class="fa fa-remove"></span>
                                        <?=$this->lang->line('student_clear')?>
                                    </button>
                                    <div class="btn btn-success image-preview-input">
                                        <span class="fa fa-repeat"></span>
                                        <span class="image-preview-input-title">
                                        <?=$this->lang->line('student_file_browse')?></span>
                                        <input type="file" accept="image/png, image/jpeg, image/gif" name="photo"/>
                                    </div>
                                </span>
                            </div>
                        </div>

                        <span class="col-sm-4">
                            <?php echo form_error('photo'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('extraCurricularActivities') ? ' has-error' : ''  ?>">
                        <label for="extraCurricularActivities" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_extracurricularactivities")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="extraCurricularActivities" name="extraCurricularActivities" value="<?=set_value('extraCurricularActivities')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('extraCurricularActivities'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('remarks') ? ' has-error' : ''  ?>">
                        <label for="remarks" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_remarks")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="remarks" name="remarks" value="<?=set_value('remarks')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('remarks'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('username') ? 'has-error' : ''?>">
                        <label for="username" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_username")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="username" name="username" value="<?=set_value('username')?>" >
                        </div>
                         <span class="col-sm-4 control-label">
                            <?php echo form_error('username'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('password') ? 'has-error' : ''?>">
                        <label for="password" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_password")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password" name="password" value="<?=set_value('password')?>" >
                        </div>
                         <span class="col-sm-4 control-label">
                            <?php echo form_error('password'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_student")?>" >
                        </div>
                    </div>
                </form>

                <?php if ($siteinfos->note==1) { ?>
                    <div class="callout callout-danger">
                        <p><b>Note:</b> Create teacher, class, section before create a new student.</p>
                    </div>
                <?php } ?>
            </div> <!-- col-sm-8 -->

        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

<script type="text/javascript">
$( ".select2" ).select2();
$('#dob').datepicker({ startView: 2 });

$('#classesID').change(function(event) {
    var classesID = $(this).val();
    if(classesID === '0') {
        $('#sectionID').val(0);
    } else {
        $.ajax({
            async: false,
            type: 'POST',
            url: "<?=base_url('student/sectioncall')?>",
            data: "id=" + classesID,
            dataType: "html",
            success: function(data) {
               $('#sectionID').html(data);
            }
        });

        $.ajax({
            async: false,
            type: 'POST',
            url: "<?=base_url('student/optionalsubjectcall')?>",
            data: "id=" + classesID,
            dataType: "html",
            success: function(data2) {
                $('#optionalSubjectID').html(data2);
            }
        });
    }
});

$(document).on('click', '#close-preview', function(){
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
           $('.content').css('padding-bottom', '100px');
        },
         function () {
           $('.image-preview').popover('hide');
           $('.content').css('padding-bottom', '20px');
        }
    );
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("<?=$this->lang->line('student_file_browse')?>");
    });
    // Create the preview image
    $(".image-preview-input input:file").change(function (){
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200,
            overflow:'hidden'
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("<?=$this->lang->line('student_file_browse')?>");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
            $('.content').css('padding-bottom', '100px');
        }
        reader.readAsDataURL(file);
    });
});


</script>
