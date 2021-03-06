<div class="clearfix"></div>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	  <div class="x_panel">
	    <div class="x_title">
	      <h2>Categories</h2>
	      <div class="clearfix"></div>
	    </div>

	    <div class="x_content">
	      <div class="table-responsive">
	        <table class="table table-striped jambo_table bulk_action">
	          <thead>
	            <tr class="headings">
	              <th class="column-title">Name </th>
	              <th class="column-title">Parent </th>
	              <th class="column-title">Slug </th>
	              <th class="column-title no-link last"><span class="nobr">Action</span></th>
	            </tr>
	          </thead>

	          <tbody>
	          	{foreach $models as $model}
	            <tr class="even pointer">
	              <td class=" ">{$model->name}</td>
	              <td class=" ">{$model->getParentName()}</td>
	              		
	              
	              <td class=" ">{$model->slug}</td>
	              <td class=" last">
	              	<a href='{url route="category/edit" id=$model->id}' class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>

	              	<a href='{url route="category/change-visible" id=$model->id}' class="btn btn-primary btn-xs" action="visible-status">
	              		{if $model->isVisible()}
	              		<i class="fa fa-eye"></i>
	              		{else}
	              		<i class="fa fa-eye-slash"></i>
	              		{/if}
	              	</a>
	              </td>
	            </tr>
	          	{/foreach}
	          </tbody>
	        </table>
	      </div>
	    </div>
	  </div>
	</div>
</div>

{registerJs}
{literal}
$('.x_content').on("click", 'tr a[action="visible-status"]', function(event) {
	event.preventDefault();
	var _href = $(this).attr('href');
	var _v = $(this).find('.fa-eye').length;
	_v = (_v) ? 0 : 1;
  that = this;
  $.ajax({
    url: _href,
    type: "GET",
    data: {visible: _v},
    dataType: 'json',
    success: function (result, textStatus, jqXHR) {
        if (result.status == false) {
          //alert(result.error);
        } else {
          if (!_v) {
          	$(that).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
          } else {
          	$(that).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
          }
        }
        
    },
  });

});
{/literal}
{/registerJs}