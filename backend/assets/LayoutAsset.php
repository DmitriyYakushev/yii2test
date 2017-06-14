<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author KeyGen <keygenqt@gmail.com>
 * @since 2.0
 */
class LayoutAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
	
    public function init() {
        $this->jsOptions['position'] = View::POS_BEGIN;
        parent::init();
    }
	public $css = [
		'css/site.css?=1',
        'css/my-bootstrap.css',
	];
    public $js = [
		'js/web.js'
	];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',   
    ];
}
