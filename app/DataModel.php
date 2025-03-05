<?php
	
	namespace Jesse\SimplifiedMVC;
	
	use PDOStatement;
	
	abstract class DataModel extends Model
	{
		abstract static public function tableName() : string;
		abstract static public function attributes() : array;
		abstract static public function primaryKey() : string;
		function labels () : array { return []; }
		function save(): void
		{
			$tableName = static::tableName();
			$attributes = static::attributes();
			$params = [];
			foreach($attributes as $attribute) $params[$attribute] = $this->{$attribute};
			Application::$app->builder->build(Application::$app->builder->builder()->insert($tableName, $params));
		}
		static function findOne (array $where) : PDOStatement
		{
			// do query, find user and return user object to caller
			$table = static::tableName();
			$builder = Application::$app->builder->builder();
			$builder->select($table, ['*']);
			foreach(array_keys($where) as $index => $value) $index === 0 ? $builder->where($value, '=', $where[$value]) : $builder->andWhere($value, '=', $where[$value]);
			return Application::$app->builder->build($builder);
		}
		static function fetchAll(?array $orderBy = []) : PDOStatement
		{
			$table = static::tableName();
			$sql = "SELECT * FROM {$table}";
			foreach ($orderBy as $key => $value) $sql .= $key === 0 ? " ORDER BY {$value}" : ", {$value}";
			return Application::$app->builder->build(Application::$app->builder->builder()->raw($sql));
		}
		function update() : void
		{
			$tableName = static::tableName();
			$attributes = static::attributes();
			$pk = static::primaryKey();
			$params = [];
			foreach($attributes as $attribute) $params[$attribute] = $this->{$attribute};
			Application::$app->builder->build(Application::$app->builder->builder()
				->update($tableName, $params)
				->where($pk, '=', $this->{$pk})
			);
		}
		function patch(array $field2Values) : void
		{
			$tableName = static::tableName();
			$pk = static::primaryKey();
			$params = [];
			foreach($field2Values as $attribute) if ($attribute !== $pk) $params[$attribute] = $this->{$attribute};
			Application::$app->builder->build(Application::$app->builder->builder()
				->update($tableName, $params)
				->where($pk, '=', $this->{$pk})
			);
		}
		function delete() : void
		{
			$tableName = static::tableName();
			$pk = static::primaryKey();
			Application::$app->builder->build(Application::$app->builder()->delete($tableName)->where($pk, '=', $this->{$pk}));
		}
	}