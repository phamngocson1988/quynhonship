<?php
namespace common\forms;

use yii\base\Model;
use common\models\Location;
use Yii;

class FetchLocationForm extends Model
{
    protected $_list;

    protected $_total;
    
    public function fetch()
    {
        $command = $this->createCommand();
        $this->_list = $command->all();
        return $this->getList();
    }

    public function count()
    {
        $command = $this->createCommand();
        $this->_total = $command->count();
        return $this->getTotal();
    }

    protected function createCommand()
    {
        $command = Location::find();
        $command->orderBy('id desc');
        return $command;
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