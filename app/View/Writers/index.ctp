<h2><?php echo __('Các tác giả'); ?></h2>
<p>
<?php echo $this->Paginator->sort('name','Sắp xếp theo thứ tự ngược lại'); ?>
</p>
<p>
<?php foreach($writers as $writer):
	echo $writer['Writer']['name'];
	echo "<br>";
	endforeach;	
?>
</p>
<?php echo $this->element('pagination',array('object'=>'tác giả')); ?>

	