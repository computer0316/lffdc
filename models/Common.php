<?php

namespace app\models;

use Yii;


class Common extends \yii\base\Model
{
	public $id;
	public $name;
	public $url;
	public $arr;
	public $number;

	/**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'string', 'max' => 256],
            [['id', 'number'], 'integer'],
            ['arr','safe'],
        ];
    }
    public function attributeLabels(){
    	return [
    		'name'	=> '名称',
    		'url'	=> '地址',
    	];
    }

}
