<?php
/* Smarty version 3.1.31, created on 2017-08-09 06:56:30
  from "C:\xampp\htdocs\quynhonship\backend\views\user\view.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_598a95fe24e429_18677875',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '49fe267c74795f17028b39124698cdf9fe33857f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\quynhonship\\backend\\views\\user\\view.tpl',
      1 => 1501301943,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_598a95fe24e429_18677875 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="page-title">
  <div class="title_left">
    <h3>User Profile</h3>
  </div>
</div>

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>User Name</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
          <div class="profile_img">
            <div id="crop-avatar">
              <!-- Current avatar -->
              <img class="img-responsive avatar-view" src="../../images/avatar.png" alt="Avatar" title="Change the avatar">
            </div>
          </div>
          <h3>Samuel Doe</h3>

          <ul class="list-unstyled user_data">
            <li><i class="fa fa-map-marker user-profile-icon"></i> San Francisco, California, USA
            </li>

            <li>
              <i class="fa fa-briefcase user-profile-icon"></i> Software Engineer
            </li>

            <li class="m-top-xs">
              <i class="fa fa-external-link user-profile-icon"></i>
              <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
            </li>
          </ul>

          <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
          <br />

        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a>
              </li>
              <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a>
              </li>
              <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
              </li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                <!-- start recent activity -->
                <ul class="messages">
                  <li>
                    <img src="../../images/avatar.png" class="avatar" alt="Avatar">
                    <div class="message_date">
                      <h3 class="date text-info">24</h3>
                      <p class="month">May</p>
                    </div>
                    <div class="message_wrapper">
                      <h4 class="heading">Desmond Davison</h4>
                      <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                      <br />
                      <p class="url">
                        <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                        <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                      </p>
                    </div>
                  </li>
                  <li>
                    <img src="../../images/avatar.png" class="avatar" alt="Avatar">
                    <div class="message_date">
                      <h3 class="date text-error">21</h3>
                      <p class="month">May</p>
                    </div>
                    <div class="message_wrapper">
                      <h4 class="heading">Brian Michaels</h4>
                      <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                      <br />
                      <p class="url">
                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                        <a href="#" data-original-title="">Download</a>
                      </p>
                    </div>
                  </li>
                  <li>
                    <img src="../../images/avatar.png" class="avatar" alt="Avatar">
                    <div class="message_date">
                      <h3 class="date text-info">24</h3>
                      <p class="month">May</p>
                    </div>
                    <div class="message_wrapper">
                      <h4 class="heading">Desmond Davison</h4>
                      <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                      <br />
                      <p class="url">
                        <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                        <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                      </p>
                    </div>
                  </li>
                  <li>
                    <img src="../../images/avatar.png" class="avatar" alt="Avatar">
                    <div class="message_date">
                      <h3 class="date text-error">21</h3>
                      <p class="month">May</p>
                    </div>
                    <div class="message_wrapper">
                      <h4 class="heading">Brian Michaels</h4>
                      <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                      <br />
                      <p class="url">
                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                        <a href="#" data-original-title="">Download</a>
                      </p>
                    </div>
                  </li>

                </ul>
                <!-- end recent activity -->

              </div>
              <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                <!-- start user projects -->
                <table class="data table table-striped no-margin">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Project Name</th>
                      <th>Client Company</th>
                      <th class="hidden-phone">Hours Spent</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>New Company Takeover Review</td>
                      <td>Deveint Inc</td>
                      <td class="hidden-phone">18</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>New Partner Contracts Consultanci</td>
                      <td>Deveint Inc</td>
                      <td class="hidden-phone">13</td>
                    </tr>
                  </tbody>
                </table>
                <!-- end user projects -->

              </div>
              <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                  photo booth letterpress, commodo enim craft beer mlkshk </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><?php }
}
