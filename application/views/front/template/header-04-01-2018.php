<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title;?></title>
    <meta http-equiv="Content-Language" content="en" />
    <meta name="description" content="<?php echo $meta_desc;?>" />
    <meta name="author" content="jobmoqa.pk">
    <?php 
	/*if(isset($index_follow) && $index_follow == 'true')
		echo '<META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">';
	else*/
		echo '<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
		
	if(isset($canonical) && $canonical !='')
		echo '<link rel="canonical" href="'.$canonical.'" />';
	?>
  <link href="<?=FRONT_STATIC_URL?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=FRONT_STATIC_URL?>css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=FRONT_STATIC_URL?>css/owl.carousel.css" />
  <link href='https://fonts.googleapis.com/css?family=Raleway:400,800' rel='stylesheet' type='text/css'>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  
  <script src="<?=FRONT_STATIC_URL?>js/jquery.js"></script>
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<? if(isset($fb_info) && !empty($fb_info)) : ?>
  <meta property="og:url"           content="<?=$fb_info['url']?>" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="<?=$fb_info['title']?>" />
  <meta property="og:description"   content="<?=$fb_info['description']?>" />
  <meta property="og:image"         content="<?=$fb_info['image']?>" />
<? endif; ?>
</head>

<body>


<?php /*?><div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=738885179639791";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script><?php */?>

<? if(isset($fb_info) && !empty($fb_info)) : ?>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=738885179639791';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<? endif; ?>

  <!-- -------------------- Header Strats ------------------------ -->


  <div class="hearder-top">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-xs-7 subscribe">
          <p><a href="javascript:;" id="sub_link" class="subs-news">Subscribe to Newsletter</a> </p>
        </div>
        <div class="col-md-6 col-sm-6 social_icone col-xs-5">
          <ul class="top-social pull-right">
            <li>
               <button class="sarch-btn  visible-xs btn-info" type="button"  data-toggle="modal" data-target="#myModal"><div class="glyphicon glyphicon-search"></div></button>
            </li>
            <li>
              <a href="https://www.facebook.com/job.moqa" target="_blank"> <img src="<?=FRONT_STATIC_URL?>images/facebook.png" alt="facebook"> </a>
            </li>
            <li>
              <a href="#"><img src="<?=FRONT_STATIC_URL?>images/google+.png" alt="google+"> </a>
            </li>
            <li>
              <a href="#"><img src="<?=FRONT_STATIC_URL?>images/linked-in.png" alt="linked-in"> </a>
            </li>
          </ul>
        </div> 
      </div>
    </div>
  </div>
  <div id="myModal" class="modal fade " role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
          <form class="form-inline search-div" role="form" action="<?=BASE_URL?>search" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="key_word" placeholder="Job KeyWord">
            </div>
            <div class="form-group">dd
              <select class="form-control" name="region" id="region">
              	<option>Region</option>
              	<? 
					foreach($regions as $region )
						echo '<option value="'.$region['id'].'">'.$region['name'].'</option>';
				?>
              </select>
            </div>
            <div class="form-group">
              <select class="form-control">
                <option>Web Developer</option>
                <option>Graphic Design</option>
                <option>Web Designer</option>
                <option>Programmer</option>
              </select>
            </div>
            <button type="submit" class="btn btn-default text-center"><span class="glyphicon glyphicon-search"></span></button>
          </form>
        </div>
      </div> 

    </div>
  </div>
  <header>
     <div class="container">
      <div class="row">
        <div class="col-md-2 col-xs-12">
          <div class="col-sm-4 col-xs-4">
            <a href="#" onclick="openNav()" class="hidden-sm hidden-md hidden-lg pull-left"><img src="<?=FRONT_STATIC_URL?>images/menu_icon.jpg" alt=""></a>
          </div>
          <div class="logo col-sm-6 col-xs-4">
            <a href="<?=BASE_URL?>"><img src="<?=FRONT_STATIC_URL?>images/logo_022.jpg" class="img-responsive" alt="Logo"></a>
          </div>
        </div>

        <div class="col-md-10">
          <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn hidden-lg hidden-md hidden-sm " onclick="closeNav()">&times;</a>
            <ul class="menu hidden-xs">
              <li><a href="<?=BASE_URL?>">Home</a></li>
              <li><a href="<?=BASE_URL?>all-news-papers">Newspaper Jobs</a></li>
              <li><a href="<?=BASE_URL?>categories">Categories Wise Jobs</a></li>
              <li><a href="<?=BASE_URL?>regions">Region Wise Job</a></li>
              <li><a href="<?=BASE_URL?>about-us">About Us</a></li>
              <li><a href="<?=BASE_URL?>interview-tips" class="cv-button"> Interview Tips</a></li>
              <li><a href="<?=BASE_URL?>cv-formats" class="cv-button"> CV/ sample format</a></li>
            </ul>

            <!-- menu start-->
            <div class="nav-side-menu visible-xs left_menu">
              <div class="menu-list">
                <ul id="menu-content" class="menu-content">
                  <li>
                    <a href="<?=BASE_URL?>">
                      <i class="fa fa-dashboard fa-lg"></i> Home
                    </a>
                  </li>

                  <li data-toggle="collapse" data-target="#products" class="collapsed active">
                    <a href="#"><i class="fa fa-gift fa-lg"></i> Newspaper Jobs <span class="arrow"></span></a>
                  </li>
                  <ul class="sub-menu collapse" id="products">
                  	<!--<li class="active"><a href="#">Mashriq</a></li>-->
                  <?
				  	$arr_papers = $menu['news_paper']; 
				  	foreach($arr_papers as $paper) : ?>
                  	<li><a href="<?=BASE_URL.'epaper/'.$paper['url']?>"><?=$paper['name']?></a>ss</li>
                  <? endforeach; ?>
                  </ul>


                  <li data-toggle="collapse" data-target="#service" class="collapsed">
                    <a href="#"><i class="fa fa-globe fa-lg"></i> Categories Wise Jobs <span class="arrow"></span></a>
                  </li>
                  <ul class="sub-menu collapse" id="service">
                    <? $cats = $menu['cats'];
						foreach($cats as $cat) : ?>
                  	<li><a href="<?=BASE_URL.'industry/'.$cat['url']?>"><?=$cat['name']?></a></li>
                  <? endforeach; ?>
                  </ul>


                  <li data-toggle="collapse" data-target="#new" class="collapsed">
                    <a href="#"><i class="fa fa-car fa-lg"></i> Region Wise Job <span class="arrow"></span></a>
                  </li>
                  <ul class="sub-menu collapse" id="new">
                     <?
						$regions = $this->menu['regions'];
						   foreach($regions as $region)
								echo '<li><a href="'.BASE_URL.'region/'.$region['url'].'" title="'.$region['name'].'">'.$region['name'].'</a></li>';
						?>
                  </ul>


                  <li>
                    <a href="<?=BASE_URL?>about-us">
                      <i class="fa fa-user fa-lg"></i> About Us
                    </a>
                  </li>

                  <li>
                    <a href="#">
                      <i class="fa fa-users fa-lg"></i> contact us
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- menu end-->
          </div>
        </div>
      </div>
    </div>
    
    <div class="container">
        <div class="container-fluid">
          <div class="row">
          <div class="col-md-5 breadcrumbs-div">
            <ul class="breadcrumbs">
              <li><a href="<?=BASE_URL?>"> HOME </a>/</li>
              <li><?=$page_heading?></li>
            </ul>
          </div>
          <div class="col-md-7 top-add">
            <img src="<?=FRONT_STATIC_URL?>images/top-add.png" alt="Image" class="img-responsive">
          </div>
          </div>
        </div>
</div>
    
  </header>