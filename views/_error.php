<?php 
    /**
     * @var \Exception $exception
     */
    /**
     * @var $this View
     */
	
	use Jesse\SimplifiedMVC\View;
	
	$this->title = "{$exception->getCode()} Error";
?>

<h3 class="text-center"><?= $exception->getCode() ?> - <?= $exception->getMessage() ?></h3>