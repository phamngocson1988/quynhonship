<?php

namespace common\forms;

use Yii;
use yii\base\Model;
use common\models\Client;
use common\models\ClientImage;
use common\forms\FetchCategoryForm;
use yii\helpers\ArrayHelper;

/**
 * EditClientForm
 */
class EditClientForm extends Model
{
    public $id;
    public $title;
    public $content;
    public $address;
    public $phone;
    public $facebook;
    public $open_time;
    public $close_time;
    public $image_id;
    public $status;

    private $_client;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'content'], 'required'],
            ['id', 'validateClient'],
            ['status', 'default', 'value' => Client::STATUS_VISIBLE],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_DEFAULT] = ['id', 'title', 'content', 'address', 'phone', 'facebook', 'open_time', 'close_time', 'image_id', 'status'];
        return $scenarios;
    }

    public function save()
    {
        if ($this->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            $client = $this->getClient();
            try {
                $client->title = $this->title;
                $client->content = $this->content;
                $client->address = $this->address;
                $client->phone = $this->phone;
                $client->facebook = $this->facebook;
                $client->open_time = $this->open_time;
                $client->close_time = $this->close_time;
                $client->image_id = $this->image_id;
                $client->status = $this->status;
                $result = $client->save();

                $transaction->commit();
                return $result;
            } catch (Exception $e) {
                $transaction->rollBack();                
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
    }

    protected function getClient()
    {
        if ($this->_client === null) {
            $this->_client = Client::findOne($this->id);
        }

        return $this->_client;
    }

    public function loadData($id)
    {
        $this->id = $id;
        $client = $this->getClient();
        $this->title = $client->title;
        $this->content = $client->content;
        $this->address = $client->address;
        $this->phone = $client->phone;
        $this->facebook = $client->facebook;
        $this->open_time = $client->open_time;
        $this->close_time = $client->close_time;
        $this->image_id = $client->image_id;
        $this->status = $client->status;
    }

    public function validateClient($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $client = $this->getClient();
            if (!$client) {
                $this->addError($attribute, 'Invalid client.');
            }
        }
    }

    public function hasImage()
    {
        $client = $this->getClient();
        return $client->image;
    }
    public function getImageUrl($size)
    {
        $client = $this->getClient();
        return $client->getImageUrl($size, '');
    }
}
