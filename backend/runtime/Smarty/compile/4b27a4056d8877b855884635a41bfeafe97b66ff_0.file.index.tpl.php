<?php
/* Smarty version 3.1.31, created on 2017-08-10 04:40:45
  from "C:\xampp\htdocs\quynhonship\backend\views\profile\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_598bc7adbb4be5_98133149',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b27a4056d8877b855884635a41bfeafe97b66ff' => 
    array (
      0 => 'C:\\xampp\\htdocs\\quynhonship\\backend\\views\\profile\\index.tpl',
      1 => 1502332295,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_598bc7adbb4be5_98133149 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="page-title">
  <div class="title_left">
    <h3>Profile</h3>
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
              <img class="img-responsive avatar-view" id="avatar" global="avatar_<?php echo $_smarty_tpl->tpl_vars['user']->value->getId();?>
" src="<?php echo $_smarty_tpl->tpl_vars['user']->value->getAvatarUrl('150x150');?>
" alt="Avatar" title="Change the avatar">
            </div>
          </div>
          <h3><?php echo $_smarty_tpl->tpl_vars['user']->value->getName();?>
</h3>

          <a class="btn btn-success" action="change-avatar"><i class="fa fa-edit m-right-xs"></i>Change Avatar</a>
          <input type="file" name="change-avatar" id="change-avatar" style="display: none">

          <br />

        </div>

        <div class="col-md-9 col-sm-9 col-xs-12">
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
              <li role="presentation" class="active"><a href="#information" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Information</a>
              </li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="information" aria-labelledby="home-tab">
               	<div class="row">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">User Name</span></label>
                  <div class="col-md-9 col-sm-6 col-xs-12"><?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>
</div>
                </div>

                <div class="row">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</span></label>
                  <div class="col-md-9 col-sm-6 col-xs-12"><?php echo $_smarty_tpl->tpl_vars['user']->value->email;?>
</div>
                </div>

                <div class="row">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</span></label>
                  <div class="col-md-9 col-sm-6 col-xs-12"><?php echo $_smarty_tpl->tpl_vars['user']->value->name;?>
</div>
                </div>

                <div class="row">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone</span></label>
                  <div class="col-md-9 col-sm-6 col-xs-12"><?php echo $_smarty_tpl->tpl_vars['user']->value->phone;?>
</div>
                </div>

                <div class="row">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12"><?php echo $_smarty_tpl->tpl_vars['user']->value->address;?>
</div>
                </div>

                <div class="row">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Year Of Birth</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12"><?php echo $_smarty_tpl->tpl_vars['user']->value->year_of_birth;?>
</div>
                </div>

                <div class="row">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12"><?php echo $_smarty_tpl->tpl_vars['user']->value->gender;?>
</div>
                </div>

                <div class="ln_solid"></div>
			          <div class="form-group">
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              <a href='<?php echo $_smarty_tpl->tpl_vars['links']->value['edit'];?>
' role="button">Edit</a> | 
                    <a href='<?php echo $_smarty_tpl->tpl_vars['links']->value['password'];?>
' role="button">Change Password</a>
			            </div>
			          </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['registerJs'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['registerJs'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'blockJavaScript'))) {
throw new SmartyException('block tag \'registerJs\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('registerJs', array());
$_block_repeat=true;
echo $_block_plugin1->blockJavaScript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
?>

<!-- inline scripts related to this page -->


// Change Avatar
var upload = new AjaxUploadImage({
  request_url: '<?php echo $_smarty_tpl->tpl_vars['links']->value['upload_image'];?>
',
  file_element: '#change-avatar',
  trigger_element: "a[action='change-avatar']"
});   
upload.callback = function(images) {
  $.each(images, function( index, img ) {
    $.ajax({
      url: '<?php echo $_smarty_tpl->tpl_vars['links']->value['change_avatar'];?>
',
      type: 'POST',
      dataType : 'json',
      data: {image_id: index},
      success: function (result, textStatus, jqXHR) {
        if (result.status == false) {
          console.log(result.error);
          return false;
        } else {
          $('[global="avatar_<?php echo $_smarty_tpl->tpl_vars['user']->value->getId();?>
"]').attr('src', img.thumb);
        }
      },
    });
  });
}




<?php $_block_repeat=false;
echo $_block_plugin1->blockJavaScript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
