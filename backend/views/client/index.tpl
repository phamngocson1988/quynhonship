{use class='yii\widgets\LinkPager'}
{use class='yii\widgets\Pjax' type='block'}

<div class="clearfix"></div>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	  <div class="x_panel">
	    <div class="x_title">
	      <h2>Posts</h2>
	      <div class="clearfix"></div>
	    </div>

	    <div class="x_content">
	      {Pjax}
	      <div class="table-responsive">
	        <table class="table table-striped jambo_table bulk_action">
	          <thead>
	            <tr class="headings">
	              <th class="column-title">Title </th>
	              <th class="column-title">Content </th>
	              <th class="column-title">Author </th>
	              <th class="column-title">Status </th>
	              <th class="column-title">Created Date </th>
	              <th class="column-title">Action </th>
	            </tr>
	          </thead>

	          <tbody>
	          	{foreach $models as $model}
	            <tr class="even pointer">
	              <td class=" ">{$model->title}</td>
	              <td class=" ">{$model->content}</td>
	              <td class=" ">{$model->getUserName()}</td>
	              <td class=" "></td>
	              <td class="a-right a-right ">{$model->getCreatedAt(true)}</td>
	              <td class=" last">
                  <a href='{url route="client/edit" id=$model->id}' class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                  <a href='{url route="client/delete" id=$model->id}' class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
	              </td>
	            </tr>
	        		{/foreach}
	          </tbody>
	        </table>
	      </div>

	      <nav aria-label="Page navigation" class="pull-right">
		  		{LinkPager::widget(['pagination' => $pages])}
				</nav>
				{/Pjax}
	    </div>
	  </div>
	</div>
</div>

{registerJs}
{literal}
{/literal}
{/registerJs}