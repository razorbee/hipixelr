<?php
/**
 * Animated box action button
 */

$classes_list = array( 'elementor-button', 'elementor-size-md', 'jet-animated-box__button', 'jet-animated-box__button--back' );

$position = $this->get_settings( 'button_icon_position' );
$use_icon = $this->get_settings( 'add_button_icon' );

$classes_list[] = 'jet-animated-box__button--icon-' . $position;

$classes = implode( ' ', $classes_list );
?>
<a class="<?php echo $classes; ?>" href="<?php echo $this->__html( 'back_side_button_link' ); ?>"><?php
	echo $this->__html( 'back_side_button_text', '<span class="jet-animated-box__button-text">%s</span>' );

	if ( filter_var( $use_icon, FILTER_VALIDATE_BOOLEAN ) ) {
		echo $this->__html( 'button_icon', '<i class="jet-animated-box__button-icon %s"></i>' );
	}
?></a>

