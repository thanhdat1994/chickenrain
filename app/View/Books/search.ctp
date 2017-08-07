<!-- Form tìm kiếm -->
<?php echo $this->Form->create('Book',['url'=>['action'=>'get_keyword','novalidate'=>true]]); ?>
<?php if (isset($keyword)): ?>
	<?php echo $this->Form->input('keyword',['value'=>$keyword,'error'=>false,'label'=>'','placeholder'=>'Gõ vào từ khóa để tìm kiếm...']); ?>
<?php else: ?>
	<?php echo $this->Form->input('keyword',['error'=>false,'label'=>'','placeholder'=>'Gõ vào từ khóa để tìm kiếm...']); ?>
<?php endif ?>

<?php echo $this->Form->end('Search'); ?>

<!-- hiển thị thông tin lỗi -->
<?php if (isset($errors)): ?>
	<?php foreach ($errors as $error): ?>
		<?php echo $error[0]; ?>
	<?php endforeach ?>
<?php endif ?>

<!-- hiển thị kết quả tìm kiếm -->

<?php if ($notfound == false && isset($results)): ?>
	Kết quả tìm kiếm của từ khóa <strong><?php echo $keyword ?></strong><br>
	<?php echo $this->element('books',['books'=>$results]); ?>
	<?php echo $this->element('pagination',['object' => 'quyển sách']); ?>
<?php elseif($notfound): ?>
	Không tìm thấy quyển sách này!<br>
<?php endif ?>