<div class="col-sm-12">
	<div class="product-image-wrapper">
	<?php foreach($books as $book): ?>

		<div class="single-products col-sm-4">
			<div class="productinfo text-center">
					<?php echo $this->Html->image('/app'.$book['Book']['image'],array('class'=>'img img-responsive', 'style'=>'width:220px;height:220px;')); ?>
					<h4><?php echo $this->Html->link($book['Book']['title'],'/'.$book['Book']['slug']); ?></h4>
					<?php echo 'Tác giả: ';
					foreach ($book['Writer'] as $writer) {
						echo $this->Html->link($writer['name'],'/tac-gia/'.$writer['slug']);
					}  ?><br>					
					<?php echo $this->Number->currency($book['Book']['sale_price'],' VND',array('places'=>0,'wholePosition'=>'after',['class'=>'btn btn-warning ']));?>
				
			</div>

		</div>
		<?php endforeach; ?>
	</div>
</div>