<?php
   $navbar = array(
      array(
         'icon' => 'fa fa-home fa-fw',
         'href' => base_url(),
         'text' => 'Beranda'
      ),
      array(
         'icon' => 'fa fa-pencil-square-o fa-fw',
         'href' => base_url() . 'pendaftaran',
         'text' => 'Pendaftaran Poliklinik'
      ),
      array(
         'icon' => 'fa fa-sign-out fa-fw',
         'href' => base_url() . 'auth/logout',
         'text' => 'Keluar'
      )
   );
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title><?php echo $page_title; ?></title>
   <link href="<?php echo assets_url(); ?>/css/bootstrap.min.css" rel="stylesheet">
   <link href="<?php echo assets_url(); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
   <link href="<?php echo assets_url(); ?>/css/main_template.css" rel="stylesheet">
   <?php echo $extra_stylesheets; ?>
</head>

<body>
   <div id="wrapper">

      <nav class="navbar navbar-default sidebar" role="navigation" style="margin-top: 0">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <i class="fa fa-navicon"></i>
          </button>
          <a class="navbar-brand" href="index.html">SI-RS</a>
        </div>
        <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav in" id="side-menu">
               <?php $i=0; foreach($navbar as $nav) { ?>
               <li>
                  <a href=<?php echo '"' . $nav['href'] . '"'; if ($navbar_index == $i) echo 'class="active"'; ?> ><i class="<?php echo $nav['icon']; ?>"></i> <?php echo $nav['text']; ?></a>
               </li>
               <?php $i++; } ?>
            </ul>
          </div>
        </div>
      </nav>

      <div id="page-wrapper" style="min-height: 354px;">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header"><?php echo $page_header; ?></h1>
            </div>
         </div>
         <?php if (isset($alert_msg)) { ?>
         <div class="row alert <?php echo $alert_class; ?> alert-dismissible" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <?php echo $alert_msg; ?>
         </div>
         <?php } ?>

         <?php echo $content; ?>

      </div>

   </div>

   <script src="<?php echo assets_url(); ?>/js/jquery.js"></script>
   <script src="<?php echo assets_url(); ?>/js/bootstrap.min.js"></script>
   <?php echo $extra_scripts; ?>

</body>
</html>