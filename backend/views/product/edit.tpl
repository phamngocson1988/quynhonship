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
      <div class="x_title">
        <h2>Gallery</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="row" id="gallery">
          {foreach $model->getGalleryImages() as $imageObject}
          <div class="col-md-55 image-item">
            <div class="view view-first">
              <img style="width: 100%; display: block;" src="{$imageObject->getUrl('150x150')}" alt="image" />
              <div class="mask">
                <div class="tools tools-bottom">
                  <a href="javascript:void(0)" class="delete-image"><i class="fa fa-times"></i></a>
                </div>
              </div>
              {$form->field($model, 'gallery[]')->hiddenInput(['value' => $imageObject->id])->label(false)}
            </div>
          </div>
          {/foreach}
          <div class="col-md-55 image-item" id="gallery-template">
            <div class="view view-first">
              <img style="width: 100%; display: block;" src="../../images/image-placeholder.png" alt="image" />
              <div class="mask">
                <div class="tools tools-bottom">
                  <a href="javascript:void(0)" class="delete"><i class="fa fa-times"></i></a>
                </div>
              </div>
              {$form->field($model, 'gallery[]')->hiddenInput()->label(false)}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="x_panel">
      <div class="x_title">
        <h2>Delivery</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="form-group">
          {$form->field($model, 'delivery_time', [
            'labelOptions' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
            'inputOptions' => ['class' => 'form-control'],
            'template' => '{label}<div class="col-md-9 col-sm-9 col-xs-12">{input}</div>'
          ])->textInput()}
        </div>
        <div class="form-group">
          {$form->field($model, 'delivery_condition', [
            'labelOptions' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
            'inputOptions' => ['class' => 'form-control'],
            'template' => '{label}<div class="col-md-9 col-sm-9 col-xs-12">{input}</div>'
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

    <div class="x_panel">
      <div class="x_title">
        <h2>Price</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="form-group">
          {$form->field($model, 'price', [
            'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
            'template' => '<div class="col-md-12 col-sm-12 col-xs-12">{input}{error}{hint}</div>'
          ])->textInput()}
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

$("#gallery-template").selectImage(manager, {
  type: 'multiple',
  callback: function(imgs) {
    $.each( imgs, function( key, img ) {
      var obj = $("#gallery-template").clone().removeAttr('id');
      $(obj).find('img').attr('src', img.src);
      $(obj).find('input[type="hidden"]').val(img.id);
      $("#gallery").prepend($(obj));
    });
  }
});

$(".delete-image").on('click', function(){
  $(this).closest('.image-item').remove();
});
{/literal}
{/registerJs}