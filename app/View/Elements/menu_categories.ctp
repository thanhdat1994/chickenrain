<?php
	$categories = $this->requestAction('/categories/menu');
	//debug($categories);
?>
<?php if (!empty($categories)): ?>
	<?php foreach ($categories as $category): ?>
		<!--category-productsr-->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<?php echo $this->Html->link($category['Category']['name'], '/danh-muc/'.$category['Category']['slug']) ?>
				</h4>
			</div>
		</div>
	<?php endforeach ?>
<?php endif ?>
							