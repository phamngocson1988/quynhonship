<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->head() ?>
  </head>

  <body class="nav-md">
    <?php $this->beginBody() ?>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/" class="site_title"><i class="fa fa-paw"></i> <span>VNOpening Admin!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img global="avatar_<?= Yii::$app->user->id;?>" src="<?= Yii::$app->user->getIdentity()->getAvatarUrl('150x150');?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?= Yii::$app->user->getIdentity()->name;?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-newspaper-o"></i> Posts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= Url::to(['post/index']) ?>">Posts</a></li>
                      <li><a href="<?= Url::to(['post/create']) ?>">Create</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= Url::to(['user/index']) ?>">Users</a></li>
                      <li><a href="<?= Url::to(['user/create']) ?>">Create</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-picture-o"></i> Images <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= Url::to(['image/index']) ?>">All</a></li>
                      <li><a href="<?= Url::to(['image/upload']) ?>">Upload</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-list-ul"></i> Categories <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= Url::to(['category/index']) ?>">All</a></li>
                      <li><a href="<?= Url::to(['category/create']) ?>">Create</a></li>
                    </ul>
                  </li>
<!-- 
                  <li><a><i class="fa fa-map-marker"></i> Locations<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= Url::to(['location/index']) ?>">All</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-cog"></i> Settings<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="javascript:void(0)">Gateways</a></li>
                    </ul>
                  </li> -->

                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?= Url::to(['site/logout']) ?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img global="avatar_<?= Yii::$app->user->id;?>" src="<?= Yii::$app->user->getIdentity()->getAvatarUrl('150x150')?>" alt=""><?= Yii::$app->user->getIdentity()->name?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?= Url::to(['profile/index']) ?>"> Profile</a></li>
                    <li><a href="<?= Url::to(['profile/edit']) ?>"> Update Account</a></li>
                    <li><a href="<?= Url::to(['profile/password']) ?>"> Change Password</a></li>
                    <li><a href="<?= Url::to(['site/logout']) ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?= $content ?>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            VietnamOpening - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>