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
              <img class="img-responsive avatar-view" id="avatar" global="avatar_{$user->getId()}" src="{$user->getAvatarUrl('150x150')}" alt="Avatar" title="Change the avatar">
            </div>
          </div>
          <h3>{$user->getName()}</h3>
          <a class="btn btn-success" action="change-avatar"><i class="fa fa-edit m-right-xs"></i>Change Avatar</a>
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
                  <div class="col-md-9 col-sm-6 col-xs-12">{$user->username}</div>
                </div>

                <div class="row">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</span></label>
                  <div class="col-md-9 col-sm-6 col-xs-12">{$user->email}</div>
                </div>

                <div class="row">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</span></label>
                  <div class="col-md-9 col-sm-6 col-xs-12">{$user->name}</div>
                </div>

                <div class="row">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone</span></label>
                  <div class="col-md-9 col-sm-6 col-xs-12">{$user->phone}</div>
                </div>

                <div class="row">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">{$user->address}</div>
                </div>

                <div class="row">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Year Of Birth</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">{$user->year_of_birth}</div>
                </div>

                <div class="row">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">{$user->getGenderName()}</div>
                </div>

                <div class="ln_solid"></div>
			          <div class="form-group">
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              <a href='{$links.edit}' role="button">Edit</a> | 
                    <a href='{$links.password}' role="button">Change Password</a>
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

{registerJs}
<!-- inline scripts related to this page -->
{literal}
var manager = new ImageManager();
$("a[action='change-avatar']").selectImage(manager, {
  callback: function(img) {
    var thumb = img.src;
    var id = img.id;
    $.ajax({
      url: '{/literal}{$links.change_avatar}{literal}',
      type: 'POST',
      dataType : 'json',
      data: {image_id: id},
      success: function (result, textStatus, jqXHR) {
        if (result.status == false) {
          console.log(result.error);
          return false;
        } else {
          $('[global="avatar_{/literal}{$user->getId()}{literal}"]').attr('src', thumb);
        }
      },
    });
  }
});
{/literal}
{/registerJs}