<?php
/* Smarty version 3.1.31, created on 2017-08-09 07:33:09
  from "C:\xampp\htdocs\quynhonship\backend\views\user\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_598a9e95a7b408_18529122',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3c6493a8a5f4f923026c5375554b0e59e363636e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\quynhonship\\backend\\views\\user\\index.tpl',
      1 => 1502256745,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_598a9e95a7b408_18529122 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php
    $viewRenderer=$_smarty_tpl->default_template_handler_func[0];
    $viewRenderer->widgets['blocks']['Pjax'] = 'yii\widgets\Pjax';
    try {
        $_smarty_tpl->registerPlugin('block', 'Pjax', [$viewRenderer, '_widget_block__Pjax']);
    }
    catch (SmartyException $e) {
        /* Ignore already registered exception during first execution after compilation */
    }
?>

<div class="clearfix"></div>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	  <div class="x_panel">
	    <div class="x_title">
	      <h2>Users</small></h2>
	      <div class="clearfix"></div>
	    </div>

	    <div class="x_content">
	      <?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['Pjax'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['Pjax'][0][0] : null;
if (!is_callable(array($_block_plugin1, '_widget_block__Pjax'))) {
throw new SmartyException('block tag \'Pjax\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('Pjax', array());
$_block_repeat=true;
echo $_block_plugin1->_widget_block__Pjax(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
?>

	      <div class="table-responsive">
	        <table class="table table-striped jambo_table bulk_action">
	          <thead>
	            <tr class="headings">
	              <th class="column-title">Username </th>
	              <th class="column-title">Name </th>
	              <th class="column-title">Email </th>
	              <th class="column-title">Role </th>
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
	              <td class=" "><?php echo $_smarty_tpl->tpl_vars['model']->value->getUserName();?>
</td>
	              <td class=" "><?php echo $_smarty_tpl->tpl_vars['model']->value->getName();?>
</td>
	              <td class=" "><?php echo $_smarty_tpl->tpl_vars['model']->value->getEmail();?>
</td>
	              <td class=" "><?php echo implode(", ",$_smarty_tpl->tpl_vars['model']->value->getRoles());?>
</td>
	              <td class=" last">
	              	<a href='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->functionUrl(array('route'=>"user/view",'id'=>$_smarty_tpl->tpl_vars['model']->value->getId()),$_smarty_tpl);?>
' class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
	              	<a href='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->functionUrl(array('route'=>"user/edit",'id'=>$_smarty_tpl->tpl_vars['model']->value->getId()),$_smarty_tpl);?>
' class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
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
	      <nav aria-label="Page navigation" class="pull-right">
		  		<?php echo yii\widgets\LinkPager::widget(array('pagination'=>$_smarty_tpl->tpl_vars['pages']->value));?>

				</nav>
				<?php $_block_repeat=false;
echo $_block_plugin1->_widget_block__Pjax(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	    </div>
	  </div>
	</div>
</div><?php }
}
