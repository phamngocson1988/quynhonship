{use class='yii\helpers\Html'}
{use class='yii\widgets\ActiveForm' type='block'}
{use class='yii\helpers\ArrayHelper'}
<div class="page-title">
  <div class="title_left">
    <h3>Edit Post</h3>
  </div>
</div>
<div class="clearfix"></div>

{ActiveForm assign='form'}
{$form->field($model, 'id')->hiddenInput()->label(false)}
<div class="row">
	<div class="col-md-9 col-sm-12 col-xs-12">
	  <div class="x_panel">
	    <div class="x_title">
	      <h2>Title</h2>
	      <div class="clearfix"></div>
	    </div>

	    <div class="x_content">
        <div class="form-group">
          {$form->field($model, 'title', [
            'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
            'template' => '<div class="col-md-12 col-sm-12 col-xs-12">{input}{error}{hint}</div>'
          ])->textInput()}
        </div>
	    </div>
	  </div>
    

	  <div class="x_panel">
      <div class="x_title">
        <h2>Content</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="form-group">
          {$form->field($model, 'content', [
            'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'content'],
            'template' => '<div class="col-md-12 col-sm-12 col-xs-12">{input}{error}{hint}</div>'
          ])->textarea()}
        </div>
      </div>
    </div>

    <div class="x_panel">
      <div class="x_content">
        <div class="row">
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
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

    <div class="x_panel">
      <div class="x_title">
        <h2>Categories</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="form-group">
          {$form->field($model, 'category_id')->radioList($model->getCategories(), [
            'class' => 'radio', 
            'itemOptions' => ['class' => 'flat'],
            'separator' => '<br/>',
            'unselect' => null
          ])->label(false)}
        </div>
      </div>
    </div>
	</div>
</div>
{/ActiveForm}
{registerJs}
<!-- inline scripts related to this page -->
{literal}
editor = CKEDITOR.replace('content');
editor.on('change', function() {editor.updateElement()});

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