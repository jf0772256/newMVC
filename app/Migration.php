<?php
	
	namespace Jesse\SimplifiedMVC;
	
	abstract class Migration {
		abstract function up();
		abstract function down();
	}