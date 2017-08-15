<?php
namespace common\components\override;

use Yii;
use yii\base\Model;

class FetchForm extends Model
{
	public $order_field = 'id';
    public $order = 'DESC';
	public $pageParam = 'page';
    public $pageSizeParam = 'per-page';
    public $defaultPageSize = 10;

    protected $_command;
    protected $_list;
    protected $_total;

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

	public function count()
    {
        $this->_total = $this->_command->count();
        return $this->getTotal();
    }

    public function getOrder()
    {
        if (in_array(strtoupper($this->order), ['DESC', 'ASC'])) {
            return $this->order;
        }
        return 'DESC';
    }

    public function getOrderField()
    {
        return $this->order_field;
    }

    public function getList()
    {
        return $this->_list;
    }

    public function getTotal()
    {
        return $this->_total;
    }
}
?>