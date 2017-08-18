{use class='yii\helpers\Html'}
{use class='yii\widgets\ActiveForm' type='block'}
{use class='yii\helpers\ArrayHelper'}
<div class="page-title">
  <div class="title_left">
    <h3>Edit Post</h3>
  </div>
</div>
<div class="clearfix"></div>

{ActiveForm assign='form' options=['class' => 'form-horizontal form-label-left']}
{$form->field($model, 'id')->hiddenInput()->label(false)}
<div class="row">
	<div class="col-md-9 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Create Client</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        
          <div class="form-group">
            {$form->field($model, 'title', [
              'labelOptions' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
              'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
              'template' => '{label}<div class="col-md-6 col-sm-6 col-xs-12">{input}</div>'
            ])->textInput()}
          </div>

          <div class="form-group">
            {$form->field($model, 'content', [
              'labelOptions' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
              'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
              'template' => '{label}<div class="col-md-6 col-sm-6 col-xs-12">{input}</div>'
            ])->textarea()}
          </div>

          

          <div class="form-group">
            {$form->field($model, 'address', [
              'labelOptions' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
              'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
              'template' => '{label}<div class="col-md-6 col-sm-6 col-xs-12">{input}</div>'
            ])->textInput()}
          </div>

          <div class="form-group">
            {$form->field($model, 'phone', [
              'labelOptions' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
              'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
              'template' => '{label}<div class="col-md-6 col-sm-6 col-xs-12">{input}</div>'
            ])->textInput()}
          </div>

          <div class="form-group">
            {$form->field($model, 'facebook', [
              'labelOptions' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
              'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
              'template' => '{label}<div class="col-md-6 col-sm-6 col-xs-12">{input}</div>'
            ])->textInput()}
          </div>

          <div class="form-group">
            {$form->field($model, 'open_time', [
              'labelOptions' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
              'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
              'template' => '{label}<div class="col-md-6 col-sm-6 col-xs-12">{input}</div>'
            ])->textInput()}
          </div>

          <div class="form-group">
            {$form->field($model, 'close_time', [
              'labelOptions' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
              'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
              'template' => '{label}<div class="col-md-6 col-sm-6 col-xs-12">{input}</div>'
            ])->textInput()}
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" class="btn btn-success">Create</button>
            </div>
          </div>
      </div>
    </div>
  </div>

	<div class="col-md-3 col-sm-12 col-xs-12">
		<div class="x_panel">
      <div class="x_title">
        <h2>Image</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <img role="button" class="img-responsive img-thumbnail {if !$model->hasImage()}hide{/if}" src="{$model->getImageUrl('150x150')}" alt="image" width="300px" height="300px" id="image" />
            {$form->field($model, 'image_id', ['inputOptions' => ['id' => 'image_id'], 'template' => '{input}', 'options' => ['tag' => null]])->hiddenInput()->label(false)}
            <button type="button" class="btn btn-link" id="upload-image">Feature Image</button>
          </div>
        </div>
      </div>
    </div>

	</div>
</div>
{/ActiveForm}
{registerJs}
<!-- inline scripts related to this page -->
{literal}
//editor = CKEDITOR.replace('content');
//editor.on('change', function() {editor.updateElement()});

var manager = new ImageManager();
$("#upload-image").selectImage(manager, {
  callback: function(img) {
    var thumb = img.src;
    var id = img.id;
    $("#image").attr('src', thumb).removeClass('hide');
    $("#image_id").val(id);
  }
});
{/literal}
{/registerJs}