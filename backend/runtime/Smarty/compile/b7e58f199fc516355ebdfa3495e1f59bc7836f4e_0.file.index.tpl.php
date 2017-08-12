<?php
/* Smarty version 3.1.31, created on 2017-08-10 08:59:34
  from "C:\xampp\htdocs\quynhonship\backend\views\category\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_598c045626a847_56080430',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b7e58f199fc516355ebdfa3495e1f59bc7836f4e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\quynhonship\\backend\\views\\category\\index.tpl',
      1 => 1502336810,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_598c045626a847_56080430 (Smarty_Internal_Template $_smarty_tpl) {
?>
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
	          	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['models']->value, 'model');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['model']->value) {
?>
	            <tr class="even pointer">
	              <td class=" "><?php echo $_smarty_tpl->tpl_vars['model']->value->getName();?>
</td>
	              <td class=" "><?php echo $_smarty_tpl->tpl_vars['model']->value->getParentName();?>
</td>
	              		
	              
	              <td class=" "><?php echo $_smarty_tpl->tpl_vars['model']->value->getSlug();?>
</td>
	              <td class=" last">
	              	<a href='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->functionUrl(array('route'=>"category/edit",'id'=>$_smarty_tpl->tpl_vars['model']->value->getId()),$_smarty_tpl);?>
' class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>

	              	<a href='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->functionUrl(array('route'=>"category/change-visible",'id'=>$_smarty_tpl->tpl_vars['model']->value->getId()),$_smarty_tpl);?>
' class="btn btn-primary btn-xs" action="visible-status">
	              		<?php if ($_smarty_tpl->tpl_vars['model']->value->isVisible()) {?>
	              		<i class="fa fa-eye"></i>
	              		<?php } else { ?>
	              		<i class="fa fa-eye-slash"></i>
	              		<?php }?>
	              	</a>
	              </td>
	            </tr>
	          	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

	          </tbody>
	        </table>
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

<?php $_block_repeat=false;
echo $_block_plugin1->blockJavaScript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
