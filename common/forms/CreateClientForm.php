<?php

namespace common\forms;

use Yii;
use yii\base\Model;
use common\models\Client;
use common\models\ClientImage;
use yii\helpers\ArrayHelper;

/**
 * CreateClientForm
 */
class CreateClientForm extends Model
{
    public $title;
    public $content;
    public $address;
    public $phone;
    public $facebook;
    public $open_time;
    public $close_time;
    public $image_id;
    public $status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            ['status', 'default', 'value' => Client::STATUS_VISIBLE],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_DEFAULT] = ['title', 'content', 'address', 'phone', 'facebook', 'open_time', 'close_time', 'image_id', 'status'];
        return $scenarios;
    }

    public function save()
    {
        if ($this->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            $client = $this->getClient();
            try {
                $client->save();
                $newId = $client->id;
                $transaction->commit();
                return $newId;
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
        $client = new Client();
        $client->user_id = Yii::$app->user->id;
        $client->title = $this->title;
        $client->content = $this->content;
        $client->address = $this->address;
        $client->phone = $this->phone;
        $client->facebook = $this->facebook;
        $client->open_time = $this->open_time;
        $client->close_time = $this->close_time;
        $client->image_id = $this->image_id;
        $client->created_by = Yii::$app->user->id;
        $client->created_at = strtotime('now');
        $client->updated_at = strtotime('now');
        $client->status = $this->status;
        return $client;
    }
}
