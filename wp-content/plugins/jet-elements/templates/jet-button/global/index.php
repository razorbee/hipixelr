<?php
	$settings = $this->get_settings();

	$classes_list = array( 'jet-button__instance' );

	$button_url_data = $this->get_settings( 'button_url' );
	$button_url = $button_url_data['url'];
	$button_is_external = $button_url_data['is_external'];
	$button_nofollow = $button_url_data['nofollow'];

	$position = $this->get_settings( 'button_icon_position' );
	$use_icon = $this->get_settings( 'use_button_icon' );
	$hover_effect = $this->get_settings( 'hover_effect' );

	$classes_list[] = 'jet-button__instance--icon-' . $position;
	$classes_list[] = 'hover-' . $hover_effect;

	$classes = implode( ' ', $classes_list );
	?>
	<div class="jet-button__container">
		<a class="<?php echo $classes; ?>" href="<?php echo $button_url; ?>">
			<div class="jet-button__plane jet-button__plane-normal"></div>
			<div class="jet-button__plane jet-button__plane-hover"></div>
			<div class="jet-button__state jet-button__state-normal">
				<?php
					if ( filter_var( $use_icon, FILTER_VALIDATE_BOOLEAN ) ) {
						echo $this->__html( 'button_icon_normal', '<span class="jet-button__icon"><i class="%s"></i></span>' );
					}
					echo $this->__html( 'button_label_normal', '<span class="jet-button__label">%s</span>' );
				?>
			</div>
			<div class="jet-button__state jet-button__state-hover">
				<?php
					if ( filter_var( $use_icon, FILTER_VALIDATE_BOOLEAN ) ) {
						echo $this->__html( 'button_icon_hover', '<span class="jet-button__icon"><i class="%s"></i></span>' );
					}
					echo $this->__html( 'button_label_hover', '<span class="jet-button__label">%s</span>' );
				?>
			</div>
		</a>
	</div>
