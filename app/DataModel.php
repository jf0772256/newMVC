<?php
	
	namespace Jesse\SimplifiedMVC;
	
	use PDOStatement;
	
	abstract class DataModel extends Model
	{
		abstract static public function tableName() : string;
		abstract static public function attributes() : array;
		abstract static public function primaryKey() : string;
		function labels () : array { return []; }
		function save() {
			$tableName = static::tableName();
			$attributes = static::attributes();
			$params = [];
			foreach($attributes as $attribute) $params[] = $this->{$attribute};
			$stmnt = $this->prepare("INSERT INTO {$tableName} (" . implode(',', $attributes) . ") VALUES (" . implode(',', array_fill(0, count($attributes), '?')) . ")", $params);
			$rows = -1;
			$rows = $stmnt->rowCount();
			$stmnt->closeCursor();
			return $rows;
		}
		function prepare($sql, $params) { return Application::$app->connection->ExecuteQuery($sql, $params); }
		static function findOne (array $where) : PDOStatement
		{
			// do query, find user and return user object to caller
			$table = static::tableName();
			$sql = "SELECT * FROM {$table} WHERE ";
			$values = [];
			foreach (array_keys($where) as $index => $searchString)
			{
				$sql .=  ($index == 0)  ? "{$searchString} = ?" : " AND {$searchString} = ?";
				$values[] = $where[$searchString];
			}
			return Application::$app->connection->ExecuteQuery($sql, $values);
		}
		static function fetchAll(?array $orderBy = []) : PDOStatement
		{
			$table = static::tableName();
			$sql = "SELECT * FROM {$table}";
			foreach ($orderBy as $key => $value) $sql .= $key === 0 ? " ORDER BY {$value}" : ", {$value}";
			return Application::$app->connection->ExecuteQuery($sql);
		}
		function update() : void
		{
			$tableName = static::tableName();
			$attributes = static::attributes();
			$pk = static::primaryKey();
			$params = [];
			$fieldString = "";
			foreach($attributes as $attribute)
			{
				$fieldString .= " {$attribute}=?,";
				$params[] = $this->{$attribute};
			}
			$fieldString = rtrim(',', $fieldString);
			$params[] = $this->{$pk};
			$sql = "UPDATE {$tableName} SET{$fieldString} WHERE {$pk}=?";
			Application::$app->connection->ExecuteQuery($sql, $params);
		}
		function patch(array $field2Values) : void
		{
			$tableName = static::tableName();
			$pk = static::primaryKey();
			$params = [];
			$fieldString = "";
			foreach($field2Values as $attribute)
			{
				if ($attribute === "id") continue;
				$fieldString .= " {$attribute}=?,";
				$params[] = $this->{$attribute};
			}
			$params[] = $this->{$pk};
			$sql = "UPDATE {$tableName} SET{$fieldString} WHERE {$pk}=?";
			Application::$app->connection->ExecuteQuery($sql, $params);
			
		}
		function delete() : void
		{
			$tableName = static::tableName();
			$pk = static::primaryKey();
			$params = [];
			$params[] = $this->{$pk};
			$sql = "DELETE FROM {$tableName} WHERE {$pk} = ?";
			Application::$app->connection->ExecuteQuery($sql, $params);
		}
	}