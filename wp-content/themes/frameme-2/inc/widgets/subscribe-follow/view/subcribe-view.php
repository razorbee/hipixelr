<?php
/**
 * Template part to display subscribe form.
 *
 * @package FrameMe
 * @subpackage widgets
 */
?>
<div class="subscribe-block">

	<?php echo $this->get_block_title( 'subscribe' ); ?>
	<?php echo $this->get_block_message( 'subscribe' ); ?>

	<form method="POST" action="#" class="subscribe-block__form">
		<?php echo $this->get_nonce_field(); ?>
		<div class="subscribe-block__input-group">
			<div class="subscribe-block__input-wrap">
				<?php echo $this->get_subscribe_input(); ?>
			</div>
			<?php $btn = 'btn btn-accent-1'; ?>
			<?php echo $this->get_subscribe_submit( $btn ); ?>
		</div>
		<?php echo $this->get_subscribe_messages(); ?>
	</form>
</div>
