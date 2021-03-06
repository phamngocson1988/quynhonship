<?php

namespace backend\forms;

use Yii;
use common\components\override\FetchForm;
use common\models\User;

/**
 * FetchUserForm
 */
class FetchUserForm extends FetchForm
{
    public function fetch()
    {
        $command = $this->createCommand();
        $this->_list = $command->all();
        
        return $this->getList();
    }

    protected function createCommand()
    {
        $command = User::find();
        $command = $this->setPagination($command);
        $order = sprintf("%s %s", $this->getOrderField(), $this->getOrder());
        $command->orderBy($order);
        $command->with('avatarImage');
        $this->_command = $command;
        return $command;
    }
}
