<?php
/**
 * Loop item template
 */
?>
<div class="jet-carousel__item"><?php
	echo $this->__loop_item( array( 'item_link' ), '<a href="%s" class="jet-carousel__item-link">' );
	echo $this->get_advanced_carousel_img( 'jet-carousel__item-img' );
	echo $this->__loop_item( array( 'item_link' ), '</a>' );

	$title = $this->__loop_item( array( 'item_title' ), '<h5 class="jet-carousel__item-title">%s</h5>' );
	$text  = $this->__loop_item( array( 'item_text' ), '<div class="jet-carousel__item-text">%s</div>' );

	if ( $title || $text ) {

		echo '<div class="jet-carousel__content">';
			echo $title;
			echo $text;
		echo '</div>';

	}

?></div>