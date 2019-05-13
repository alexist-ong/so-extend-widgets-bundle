<div class="soew-square-card-container">
    <div>
        <?php
        $order = $instance['card_orientation'];
        
        $bg_img_url = '';
		if( ! empty( $instance['card_image_section']['card_image'] ) ) {
			$image = wp_get_attachment_image_src( $instance['card_image_section']['card_image'], 'full' );

			if ( ! empty( $image ) ) {
				$bg_img_url = $image[0];
			}
		}
        
        foreach( $order as $item ) {
            switch( $item ) {
                case 'card_image' : ?>
                    <div class="soew-square-card-image" style="<?php echo 'background-image: url(' . sow_esc_url( $bg_img_url ) . ')' ?>"></div><?php
                    break;

                case 'card_content' : 
                    $this->render_card_content($instance['card_content_section']);
                    break;
            }
        } ?>        
    </div>
</div>