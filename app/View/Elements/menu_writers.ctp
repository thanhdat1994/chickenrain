<?php
	$writers = $this->requestAction('/writers/menu');
?>
<?php if (!empty($writers)): ?>
	<?php foreach ($writers as $writer): ?>
		<!--category-writers-->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<?php echo $this->Html->link($writer['Writer']['name'], '/tac-gia/'.$writer['Writer']['slug']) ?>
				</h4>
			</div>
		</div>
	<?php endforeach ?>
<?php endif ?>
							