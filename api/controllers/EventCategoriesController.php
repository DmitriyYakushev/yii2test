<?php
namespace api\controllers;

use common\models\EventCategories;

class EventCategoriesController extends BaseController
{
	public $modelClass = 'common\models\EventCategories';
	public function actions() {
		$act = parent::actions();
		$actions=[];
		$actions['index']=$act['index'];
		return $actions;
	}
}
