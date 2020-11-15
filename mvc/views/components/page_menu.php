   <div class="wrapper row-offcanvas row-offcanvas-left">
    <aside class="left-side sidebar-offcanvas">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img style="display:block" src="<?=imagelink($this->session->userdata('photo'))?>" class="img-circle" alt="" />
                </div>

                <div class="pull-left info">
                    <?php
                    $name = $this->session->userdata("name");
                    if(strlen($name) > 11) {
                       $name = substr($name, 0,11). "..";
                   }
                   echo "<p>".$name."</p>";
                   ?>
                   <a href="<?=base_url("profile/index")?>">
                    <i class="fa fa-hand-o-right color-green"></i>
                    <?=$this->session->userdata("usertype")?>
                </a>
            </div>
        </div>

        <?php $usertype = $this->session->userdata("usertype"); ?>
        <ul class="sidebar-menu">
            <?php
            if(inicompute($dbMenus)) {
                $menuDesign = '';
                display_menu($dbMenus, $menuDesign);
                echo $menuDesign;
            }
            ?>
        </ul>
    </section>
</aside>