<?php

namespace common\forms;

use Yii;
use common\components\override\FetchForm;
use common\models\Post;

/**
 * FetchPostForm is the model behind the contact form.
 */
class FetchPostForm extends FetchForm
{
    public function fetch()
    {
        $command = $this->createCommand();
        $this->_list = $command->all();
        $this->_command = $command;
        return $this->getList();
    }

    protected function createCommand()
    {
        $command = Post::find();
        $command = $this->setPagination($command);
        $order = sprintf("%s %s", $this->getOrderField(), $this->getOrder());
        $command->orderBy($order);
        $command->with('category');
        $command->with('user');
        return $command;
    }
}
