<?php

namespace app\models;

use Yii;


class Text extends \yii\base\Model
{
	public $name;
	public $url;

	/**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'string', 'max' => 256],
        ];
    }
    public function attributeLabels(){
    	return [
    		'name'	=> '名称',
    		'url'	=> '地址',
    	];
    }

}
