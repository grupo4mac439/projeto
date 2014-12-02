<?php namespace lib\DAO;

use ReflectionObject;

class CastModels {
	
	public static function castModel($model, $result)
	{
		$model = new $model();

		$resultReflection = new ReflectionObject($result);

		$modelReflection = new ReflectionObject($model);

		$resultProperties = $resultReflection->getProperties();

		foreach ($resultProperties as $resultProperty) {

			$resultProperty->setAccessible(true);

			$name = $resultProperty->getName();

			$value = $resultProperty->getValue($result);

			if ($modelReflection->hasProperty($name)) {

				$propDest = $modelReflection->getProperty($name);

				$propDest->setAccessible(true);

				$propDest->setValue($model,$value);

			} else {

				$model->$name = $value;
			}
		}
		return $model;
	}

	public static function castModels($model, $results) {
		
		$models = array();

		foreach ($results as $result) {
			$new_model = CastModels::castModel($model, $result);
			array_push($models, $new_model);
		}
		
		if ( empty($models) ) return NULL;

		return $models;
	}
}