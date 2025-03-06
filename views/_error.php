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
<div>
	<h3 class="text-center display-5 text-muted" style="padding:25% 0;"><?= $exception->getCode() ?> - <?= $exception->getMessage() ?></h3>
</div>