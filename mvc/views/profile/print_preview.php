<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
</head>
<body>
  <div class="profileArea">
    <?=featureheader($siteinfos)?>
    <div class="mainArea">
      <div class="areaTop">
        <div class="studentImage">
          <img class="studentImg" src="<?=pdfimagelink($user->photo)?>" alt="">
        </div>
        <div class="studentProfile">
          <div class="singleItem">
            <div class="single_label"><?=$this->lang->line('profile_name')?></div>
            <div class="single_value">: <?=$user->name?></div>
          </div>
          <?php if($usertypeID == 2) { ?>
          <div class="singleItem">
            <div class="single_label"><?=$this->lang->line('profile_designation')?></div>
            <div class="single_value">: <?=$user->designation?></div>
          </div>
          <?php } else { ?>
          <div class="singleItem">
            <div class="single_label"><?=$this->lang->line('profile_role')?></div>
            <div class="single_value">: <?=inicompute($usertype) ? $usertype->usertype : ''?></div>
          </div>
          <?php } ?>
          <?php if ($usertypeID == 3) { ?>
            <div class="singleItem">
              <div class="single_label"><?=$this->lang->line('profile_registerNO')?></div>
              <div class="single_value">: <?=$user->registerNO?></div>
            </div>
            <div class="singleItem">
              <div class="single_label"><?=$this->lang->line('profile_roll')?></div>
              <div class="single_value">: <?=$user->roll?></div>
            </div>
            <div class="singleItem">
              <div class="single_label"><?=$this->lang->line('profile_classes')?></div>
              <div class="single_value">: <?=inicompute($classes) ? $classes->classes : ''?></div>
            </div>
            <div class="singleItem">
              <div class="single_label"><?=$this->lang->line('profile_section')?></div>
              <div class="single_value">: <?=inicompute($section) ? $section->section : ''?></div>
            </div>
          <?php } elseif($usertypeID == 4) { ?>
          <div class="singleItem">
            <div class="single_label"><?=$this->lang->line('profile_phone')?></div>
            <div class="single_value">: <?=$user->phone?></div>
          </div>
          <?php } else { ?>
            <div class="singleItem">
              <div class="single_label"><?=$this->lang->line('profile_sex')?></div>
              <div class="single_value">: <?=$user->sex?></div>
            </div>
            <div class="singleItem">
              <div class="single_label"><?=$this->lang->line('profile_dob')?></div>
              <div class="single_value">: <?php if($user->dob) { echo date("d M Y", strtotime($user->dob)); } ?></div>
            </div>
            <div class="singleItem">
              <div class="single_label"><?=$this->lang->line('profile_phone')?></div>
              <div class="single_value">: <?=$user->phone?></div>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="areaBottom">
      <?php if($usertypeID == 3) { ?>
        <table class="table table-bordered">
          <tr>
            <td width="30%"><?=$this->lang->line('profile_studentgroup')?></td>
            <td width="70%"><?=inicompute($studentgroup) ? $studentgroup->group : '' ?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_optionalsubject')?></td>
            <td width="70%"><?=inicompute($optionalsubjects) ? $optionalsubjects->subject : '' ?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_dob')?></td>
            <td width="70%"><?=isset($user->dob) ? date("d M Y", strtotime($user->dob)) : '' ?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_sex')?></td>
            <td width="70%"><?=$user->sex?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_bloodgroup')?></td>
            <td width="70%"><?=$user->bloodgroup?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_religion')?></td>
            <td width="70%"><?=$user->religion?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_email')?></td>
            <td width="70%"><?=$user->email?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_phone')?></td>
            <td width="70%"><?=$user->phone?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_state')?></td>
            <td width="70%"><?=$user->state?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_country')?></td>
            <td width="70%"><?php if(isset($allcountry[$user->country])) { echo $allcountry[$user->country]; } ?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_remarks')?></td>
            <td width="70%"><?=$user->remarks?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_username')?></td>
            <td width="70%"><?=$user->username?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_extracurricularactivities')?></td>
            <td width="70%"><?=$user->extracurricularactivities?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_address')?></td>
            <td width="70%"><?=$user->address?></td>
          </tr>
        </table>
      <?php } elseif($usertypeID == 4) { ?>
        <table class="table table-bordered">
          <tr>
            <td width="30%"><?=$this->lang->line('profile_father_name')?></td>
            <td width="70%"><?=$user->father_name?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_father_profession')?></td>
            <td width="70%"><?=$user->father_profession?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_mother_name')?></td>
            <td width="70%"><?=$user->mother_name?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_mother_profession')?></td>
            <td width="70%"><?=$user->mother_profession?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_email')?></td>
            <td width="70%"><?=$user->email?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_address')?></td>
            <td width="70%"><?=$user->address?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_username')?></td>
            <td width="70%"><?=$user->username?></td>
          </tr>
        </table>
      <?php } else { ?>
        <table class="table table-bordered">
          <tr>
            <td width="30%"><?=$this->lang->line('profile_jod')?></td>
            <td width="70%"><?php if($user->jod) { echo date("d M Y", strtotime($user->jod)); } ?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_religion')?></td>
            <td width="70%"><?=$user->religion?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_email')?></td>
            <td width="70%"><?=$user->email?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_address')?></td>
            <td width="70%"><?=$user->address?></td>
          </tr>
          <tr>
            <td width="30%"><?=$this->lang->line('profile_username')?></td>
            <td width="70%"><?=$user->username?></td>
          </tr>
        </table>
      <?php } ?>
      </div>
    </div>
  </div>
  <?php featurefooter($siteinfos)?>
</body>
</html>