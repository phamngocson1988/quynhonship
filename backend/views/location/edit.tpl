{use class='yii\widgets\ActiveForm' type='block'}
<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Edit Location</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      {ActiveForm assign='form' options=['class' => 'form-horizontal form-label-left']}
        {$form->field($model, 'id')->hiddenInput()->label(false)}
        <div class="form-group">
          {$form->field($model, 'name', [
            'labelOptions' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
            'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
            'template' => '{label}<div class="col-md-6 col-sm-6 col-xs-12">{input}</div>{error}'
          ])->textInput()}
        </div>

        <div class="form-group">
          {$form->field($model, 'slug', [
            'labelOptions' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
            'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
            'template' => '{label}<div class="col-md-6 col-sm-6 col-xs-12">{input}</div>{error}'
          ])->textInput()}
        </div>

        <div class="form-group">
          {$form->field($model, 'parent_id', [
            'labelOptions' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
            'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
            'template' => '{label}<div class="col-md-6 col-sm-6 col-xs-12">{input}</div>'
          ])->dropDownList($model->getAvailableParent(), ['prompt' => 'Choose parent'])}
        </div>

        <div class="form-group">
          {$form->field($model, 'visible', [
            'template' => '<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">{input}</div>'
          ])->checkbox(['class' => 'flat'])}
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>

      {/ActiveForm}
      </div>
    </div>
  </div>
</div>

{registerJs}
{literal}
$("#createlocationform-name").on('blur', function() {
  $("#createlocationform-slug").val(create_slug($(this).val()));
});
{/literal}
{/registerJs}