{use class='yii\helpers\Html'}
{use class='yii\widgets\ActiveForm' type='block'}
{use class='yii\helpers\ArrayHelper'}
<div class="page-title">
  <div class="title_left">
    <h3>Create New Post</h3>
  </div>
</div>

<div class="clearfix"></div>

{ActiveForm assign='form'}
{$form->field($model, 'id', [
  'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
  'template' => '<div class="col-md-12 col-sm-12 col-xs-12">{input}{error}{hint}</div>'
])->hiddenInput()}
<div class="row">
	<div class="col-md-9 col-sm-12 col-xs-12">
	  <div class="x_panel">
	    <div class="x_title">
	      <h2>Title</h2>
	      <div class="clearfix"></div>
	    </div>

	    <div class="x_content">
        {$form->field($model, 'title', [
          'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
          'template' => '<div class="col-md-12 col-sm-12 col-xs-12">{input}{error}{hint}</div>'
        ])->textInput()}
	    </div>
	  </div>
    

	  <div class="x_panel">
      <div class="x_title">
        <h2>Content</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        {$form->field($model, 'content', [
          'inputOptions' => ['id' => 'content'],
          'template' => '{error}{hint}{input}'
        ])->textarea()}
      </div>
    </div>

    <div class="x_panel">
    	<div class="x_title">
        <h2>Gallery</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="row" id="feature-images-container">
          {foreach $model->image as $image}
          <div class="col-md-3 col-sm-12 col-xs-12" style="margin-bottom: 10px">
            <a href="javasciprt:void(0)" style="position: absolute;" role="button" action="delete-image"><i class="fa fa-times"></i></a>
            <img role="button" class="img-responsive img-thumbnail" src="{$image->getUrl('150x150')}" alt="image" width="300px" height="300px"/>
            <input type="hidden" name="UpdatePostForm[image][]" style="display: none" value="{$image->id}">
          </div>
          {/foreach}
          <div class="col-md-3 col-sm-12 col-xs-12">
            <img role="button" class="img-responsive img-thumbnail" src="../../images/image-placeholder.png" alt="image" width="300px" height="300px" id="add-feature-images"/>
            <input type="file" name="feature-images[]" id="feature-images" multiple style="display: none">
          </div>
        </div>
      </div>
    </div>

    <div class="x_panel">
    	<div class="x_title">
        <h2>Contact</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li style="float: right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        {$form->field($model, 'contact_name', [
          'options' => ['class' => 'col-md-6 col-sm-6 col-xs-12 form-group has-feedback'],
          'inputOptions' => ['class' => 'form-control has-feedback-left', 'placeholder' => 'Name'],
          'template' => '{input}<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>'
        ])->textInput()}

        {$form->field($model, 'contact_phone', [
          'options' => ['class' => 'col-md-6 col-sm-6 col-xs-12 form-group has-feedback'],
          'inputOptions' => ['class' => 'form-control has-feedback-left', 'placeholder' => 'Phone'],
          'template' => '{input}<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>'
        ])->textInput()}

        {$form->field($model, 'contact_email', [
          'options' => ['class' => 'col-md-6 col-sm-6 col-xs-12 form-group has-feedback'],
          'inputOptions' => ['class' => 'form-control has-feedback-left', 'placeholder' => 'Email'],
          'template' => '{input}<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>'
        ])->textInput()}

        {$form->field($model, 'contact_facebook', [
          'options' => ['class' => 'col-md-6 col-sm-6 col-xs-12 form-group has-feedback'],
          'inputOptions' => ['class' => 'form-control has-feedback-left', 'placeholder' => 'Facebook'],
          'template' => '{input}<span class="fa fa-facebook form-control-feedback left" aria-hidden="true"></span>'
        ])->textInput()}
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
            <a href="javasciprt:void(0)" style="position: absolute;" role="button" action="delete-image"><i class="fa fa-times"></i></a>
            <img role="button" class="img-responsive img-thumbnail" src="{$model->getPost()->getAvatarUrl('150x150')}" alt="image" width="300px" height="300px" id="image-avatar" />
            <input type="file" name="imageFiles" id="image-file" style="display: none">
            {$form->field($model, 'avatar', ['inputOptions' => ['id' => 'avatar']])->hiddenInput()->label(false)}
	        </div>
				</div>
			</div>
		</div>

    <div class="x_panel">
      <div class="x_title">
        <h2>Organization</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        {$form->field($model, 'organization')->radioList(['Individual', 'Company'], [
          'class' => 'radio', 
          'itemOptions' => ['class' => 'flat'],
          'separator' => '<br/>',
          'unselect' => null
        ])->label(false)}
      </div>
    </div>

		<div class="x_panel">
			<div class="x_title">
        <h2>Categories</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        {$form->field($model, 'category_id')->radioList(ArrayHelper::map($categories, 'id', 'name'), [
          'class' => 'radio', 
          'itemOptions' => ['class' => 'flat'],
          'separator' => '<br/>',
          'unselect' => null
        ])->label(false)}
      </div>
		</div>

    <div class="x_panel">
      <div class="x_title">
        <h2>Locations</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        {$form->field($model, 'location_id')->radioList(ArrayHelper::map($locations, 'id', 'name'), [
          'class' => 'radio', 
          'itemOptions' => ['class' => 'flat'],
          'separator' => '<br/>',
          'unselect' => null
        ])->label(false)}
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
$('.aaa').click(function() {
	var image_tag="<img src='https://www.w3schools.com/css/img_fjords.jpg' width='300px' height='250px'>";
	editor.insertHtml(image_tag);
});

var images = new UploadImage({
  trigger_element: '#add-feature-images',
  file_element: '#feature-images',
  review_width: 300,
  review_height: 300
});   
images.callback = function(result) {
  var html = '';
  $.each(result.images, function( index, img ) {
    // pre-append image
    html += '<div class="col-md-3 col-sm-12 col-xs-12">';
    html += '<a href="#" style="position: absolute;"><i class="fa fa-times"></i></a>';
    html += '<img role="button" class="img-responsive img-thumbnail" src="'+img.thumb+'" alt="image" width="300px" height="300px"/>';
    html += '<input type="hidden" name="UpdatePostForm[image][]" style="display: none" value="'+img.id+'">';
    html += '</div>';
  });
  $('#feature-images-container').prepend(html);
}

var upload = new UploadImage({
  trigger_element: '#image-avatar',
  file_element: '#image-file',
  review_width: 300,
  review_height: 300
});   
upload.callback = function(result) {
  $.each(result.images, function( index, img ) {
    $('#image-avatar').attr('src', img.thumb);
    $('#avatar').val(img.id);
  });
}

$("a[action='delete-image']").on('click', function() {
  $(this).closest('div').remove();
})
{/literal}
{/registerJs}