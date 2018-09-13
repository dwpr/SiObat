<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title;?> - SIObat</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="SIOBat adalah sebuah sistem informasi yang menginformasikan obat-obatan, dibuat secara sederhana untuk masyarakat.">
        <meta name="author" content="SIObat team">
        <meta name="keywords" content="SIObat, Sistem Informasi Obat, Sistem Apoteker" />
        <meta name="title" content="SIObat" />
    <!-- Le styles -->
    <style type="text/css">
      body {
        padding-top: 50px;
      }
    </style>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url();?>assets/anoth_css/ok.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/anoth_css/style_2.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/anoth_css/jquery.fancybox.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/anoth_css/metisMenu.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/anoth_css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/anoth_css/jquery-ui.min.css') ?>" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand judul" href="#"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav sembunyi">
      <?php
        $l_val  = array("", "sintesis","herbal");
        $l_view = array("<span class='fa fa-home'> Beranda</span>", "<span class='fa fa-stop-circle'> Obat Sintesis</span>","<span class='fa fa-envira'> Obat Herbal</span>");

        for ($i = 0; $i < sizeof($l_val); $i++) {
          if ($this->uri->segment(2) == $l_val[$i]) {
            echo "<li class='active menu_side aktif'><a href='".base_URL()."obat/".$l_val[$i]."'>".$l_view[$i]."</a></li>";
          } else {
            echo "<li class='menu_side'><a href='".base_URL()."obat/".$l_val[$i]."'>".$l_view[$i]."</a></li>";
          }
        }
      ?>
                </ul>
            <?php 
            if($this->session->userdata('validated') == true){
            ?> 
            <div class="btn-group navbar-form pull-right" >
                  <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                  <b><?=$this->session->userdata('nama')?></b>
                  <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <!--<li><a href="<?=base_URL()?>atur/profil">Edit Profil</a></li>-->
                    <li><a href="<?=base_URL()?>dashboard/logout">Logout</a></li>
                  </ul>
            </div>
            <?php
            }
            ?>
            </div>
        </div>
    </nav>
  </div>
    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-3 col-md-2 hidden-xs">
            <div class="sidebar bg_side" style="padding-top: 10px;">
                <ul class="nav nav-sidebar metismenu" id="mmenu">
                    <li class="nav-header menu_side">Menu</li>
                    <?php
                    if ($this->uri->segment(1) == NULL){
                    ?>
                    <li class="active menu_side aktif"><a href="<?=base_url()?>"><span class='fa fa-home'> Beranda</span></a></li>
                    <?php
                    }else{
                    ?>
                    <li class='menu_side'><a href="<?=base_url()?>"><span class='fa fa-home'> Beranda</span></a></li>
                    <?php
                    }
                    ?>
                    <li <?php if ($this->uri->segment(1) == "obat"){echo "class='active'";}?>>
                      <a href="#" class="has-arrow" aria-expanded="<?php if ($this->uri->segment(1) == "obat"){echo "true";}else{echo "false";}?>"><span class='fa fa-stop-circle'> Obat</a>
                      <ul aria-expanded="<?php if ($this->uri->segment(1) == "obat"){echo "true";}else{echo "false";}?>" class="nav">
                        <?php
                          $l_val  = array("sintesis","herbal");
                          $l_view = array("<span class='fa fa-plus'> Obat Sintesis</span>","<span class='fa fa-envira'> Obat Herbal</span>");

                          for ($i = 0; $i < sizeof($l_val); $i++) {
                            if ($this->uri->segment(2) == $l_val[$i]) {
                              echo "<li class='active menu_side aktif subb'><a href='".base_URL()."obat/".$l_val[$i]."'>".$l_view[$i]."</a></li>";
                            } else {
                              echo "<li class='menu_side subb'><a href='".base_URL()."obat/".$l_val[$i]."'>".$l_view[$i]."</a></li>";
                            }
                          }
                        ?>
                      </ul>
                    </li>
                </ul>
            </div>
          </div>
      <div class="col-sm-9 col-md-10 main">
<!-- section content -->
      <div id="content">
      <?php 
        $this->load->view($content);
      ?>
      </div>
<!-- end of section content -->
      </div>

            </div>
      <footer>
      <hr>
        &copy; SIObat
        <br>
        Build and Design by <a href="mailto:#">SIObat team</a>
      </footer>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
        <!-- <script src="<?php echo base_url(); ?>assets/js/editor.js"></script> -->
        <!-- MetisMenu -->
        <script src="<?php echo base_url(); ?>assets/js/metisMenu.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.tabletojson.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.fancybox.pack.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="<?php echo base_url(); ?>assets/js/ie10-viewport-bug-workaround.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            var lebar = $(window).width();
            if (lebar>768){
              $('.judul').text("Sistem Informasi Obat");
            }else{
              $('.judul').text("SIObat");
            }   
          });

          $(function () {
            $('.fmanager').fancybox({ 
                "height"   : "80%",
                'type'      : 'iframe',
                'autoScale'     : false,
                'autoSize' : false
            });
          });

          $(function () {
            $('[data-toggle="tooltip"]').tooltip();
          });

          $(function () {
            $("#mmenu").metisMenu({ toggle: false });
          });
        </script>
</body>
</html>
