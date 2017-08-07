<div class="books view">
<h2><?php echo __('Book'); ?></h2>
	<dl>
		<dt><?php echo ('Title'); ?></dt>
		<dd>
			<?php echo h($book['Book']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo $this->Html->image(h('/app'.$book['Book']['image'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo ('Info'); ?></dt>
		<dd>
			<?php echo h($book['Book']['info']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($book['Book']['sale_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Publisher'); ?></dt>
		<dd>
			<?php echo h($book['Book']['publisher']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Publish Date'); ?></dt>
		<dd>
			<?php echo h($book['Book']['publish_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($book['Book']['comment_count']); ?> comments
			&nbsp;
		</dd>
	</dl>
</div>
	<!-- hiển thị tác giả -->
<div class="related">
	<h3><?php echo __('Tác giả'); ?></h3>
	<?php if (!empty($book['Writer'])): ?>	
	<?php foreach ($book['Writer'] as $writer): ?>
		<?php echo $this->Html->link($writer['name'], '/tac-gia/'.$writer['slug']); ?>
	<?php endforeach; ?>
<?php endif; ?>

</div>
<br>
<!-- hiển thị sách liên quan -->
<div>
	<h3>Sách liên quan</h3>
	<?php echo $this->element('books',array('books'=>$related_books)); ?>
</div>

<!-- hiển thị comments -->
<div class="related">
	<h3><?php echo __('Related Comments'); ?></h3>
	<?php if (!empty($comments)): ?>
	<?php foreach ($comments as $comment): ?>
		<?php echo $comment['User']['username']; ?> đã gửi:
		"<?php echo $comment['Comment']['content']; ?>" <br>
	<?php endforeach ?>
<?php endif; ?>

</div>

<!-- gởi comment -->
<div class="comments form">
<?php echo $this->Form->create('Comment',['url'=>['action'=>'add']]); ?>
	<fieldset>
		<legend><?php echo __('Add Comment'); ?></legend>
	<?php
		echo $this->Form->input('user_id',array('type'=>'text','value'=>2,'hidden'=>true,'label'=>''));
		echo $this->Form->input('book_id',array('type'=>'text','value'=>$book['Book']['id'],'hidden'=>true,'label'=>''));
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

