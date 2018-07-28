<?php

namespace app\models;

use Yii;


class Common extends \yii\base\Model
{
	public $name;
	public $url;
	public $arr;

	/**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'string', 'max' => 256],
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
