<?php

namespace backend\forms;

use Yii;
use common\components\override\Form;
use common\models\User;

/**
 * FetchUserForm
 */
class FetchUserForm extends Form
{
    public $order_field = 'id';
    public $order = 'DESC';

    private $_command;
    private $_list;
    private $_total;

    public function fetch()
    {
        $command = $this->createCommand();
        $this->_list = $command->all();
        $this->_command = $command;
        return $this->getList();
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

    protected function createCommand()
    {
        $command = User::find();
        $command = $this->setPagination($command);
        $order = sprintf("%s %s", $this->getOrderField(), $this->getOrder());
        $command->orderBy($order);
        $command->with('avatarImage');
        return $command;
    }
}
