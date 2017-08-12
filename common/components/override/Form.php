<?php
namespace common\components\override;

use Yii;
use yii\base\Model;

class Form extends Model
{
	public $pageParam = 'page';
    public $pageSizeParam = 'per-page';
    public $defaultPageSize = 10;

	public function getPage()
	{
		$request = Yii::$app->getRequest();
		return (int) $request->getQueryParam($this->pageParam, 1);
	}

	public function getPageSize()
	{
		$request = Yii::$app->getRequest();
		return (int) $request->getQueryParam($this->pageSizeParam, $this->getDefaultPageSize());
	}

	public function getDefaultPageSize()
	{
		return (int) $this->defaultPageSize;
	}

	public function getOffset()
	{
		$page = $this->getPage();
		$pageSize = $this->getPageSize();
		$offset = ($page - 1) * $pageSize;
	}

	public function setPagination($command) 
	{
		$command->limit($this->getPageSize());
        $command->offset($this->getOffset());
        return $command;
	}
}
?>