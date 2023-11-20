<?php
	
	namespace Jesse\SimplifiedMVC\Database;
	use \PDO;
	
	final class DatabaseInterfaceException extends \Exception
	{
		function __construct ($message = "", $code = 0, ?\Exception $previous = null)
		{
			parent::__construct($message, $code, $previous);
		}
	}
	abstract class DatabaseBase
	{
	
		/**
		 * host variable is a string
		 * @var string $host
		 * @author Jesse Fender
		 */
		private string $host = 'localhost';
		/**
		 * Database name, if type is sqlite this is the path to the database file
		 * @var string $name
		 * @author Jesse Fender
		 */
		private string $name = '';
		/**
		 * Username for the connection
		 * @var string $user
		 * @author Jesse Fender
		 */
		private string $user = '';
		/**
		 * Password for the user
		 * @var string $pass
		 * @author Jesse Fender
		 */
		private string $pass = '';
		/**
		 * Database port used
		 * @var string $port
		 * @author Jesse Fender
		 */
		private string $port = '3306';
		/**
		 * Database type, used only with PDO connection
		 * @var string $type
		 * @author Jesse Fender
		 */
		private string $type = 'pdo';
		/**
		 * PDO Connection options array, currently sets default returns as assoc arrays, can change or add other properties. Only use dby the PDODatabase
		 * @var array $pdoOptions
		 * @author Jesse Fender
		 */
		private array $pdoOptions = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false];
		/**
		 * Summary of connection
		 * @var PDO
		 * @author Jesse Fender
		 */
		private PDO $connection;
		
		public function __get ($prop)
		{
			return $this->{$prop};
		}
		
		public function __set ($prop, $value)
		{
			$this->{$prop} = $value;
		}
		
		/**
		 * Create connection object
		 * @return void
		 * @author Jesse Fender
		 */
		abstract public function connect ();
		
		/**
		 * Fetches connection from the class. you technically can use teh getter, but this allows a functional process for this
		 * @return PDO database connection object
		 * @author Jesse Fender
		 */
		function getConnection () : PDO
		{
			return $this->connection;
		}
	}