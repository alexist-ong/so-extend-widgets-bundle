<?php
/*
Widget Name: Ubicomp SiteOrigin Square Card Sidget
Description: Create vertical square card
Author: Alexist Ong
*/

class Square_Card_Widget extends SiteOrigin_Widget {
    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'square-card-widget',

            // The name of the widget for display purposes.
            __('Ubicomp SiteOrigin Square Card Widget', 'so-extend-widgets-bundle'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('A vertical square card widget.', 'so-extend-widgets-bundle')
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'card_content_section' => array(
                    'type' => 'section',
                    'label' => __( 'Card Content' , 'so-extend-widgets-bundle' ),
                    'hide' => false,
                    'fields' => array(
                        'card_content' => array(
                            'type' => 'tinymce',
                            'label' => __( 'Rich Text Content', 'so-extend-widgets-bundle' ),
                            'rows' => 10
                        ),
                        'card_action_button' => array(
                            'type' => 'widget',
                            'label' => __( 'Action Button', 'so-extend-widgets-bundle' ),
                            'class' => 'SiteOrigin_Widget_Button_Widget',
                            'hide' => true
                        )
                    )
                ),
                'card_image_section' => array(
                    'type' => 'section',
                    'label' => __( 'Card Image' , 'so-extend-widgets-bundle' ),
                    'hide' => false,
                    'fields' => array(
                        'card_image' => array(
                            'type' => 'media',
                            'label' => __( 'Choose Card Image', 'so-extend-widgets-bundle' ),
                            'choose' => __( 'Choose image', 'so-extend-widgets-bundle' ),
                            'update' => __( 'Set image', 'so-extend-widgets-bundle' ),
                            'library' => 'image',
                            'fallback' => true
                        )
                    )
                ),
                'card_orientation' => array(
                    'type' => 'order',
                    'label' => __( 'Card Orientation', 'so-extend-widgets-bundle' ),
                    'options' => array(
                        'card_image' => __( 'Card Image', 'so-extend-widgets-bundle' ),
                        'card_content' => __( 'Card Content', 'so-extend-widgets-bundle' )
                    ),
                    'default' => array( 'card_image', 'card_content' ),
                )
            ),

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance) {
        return 'square-card-template';
    }

    function get_template_dir($instance) {
        return 'sc-templates';
    }
    
    function get_style_name($instance) {
		return 'square-card';
	}
    
    /**
	 * Render the actual content of the frame
	 *
	 * @param $i
	 * @param $frame
	 */
	function render_card_content($section) {
		?><article>
            <?php echo $this->process_content( $section['card_content'], $section['card_action_button'] ); ?>
        </article><?php
	}
    
    /**
	 * Process the content. Most importantly add the buttons by replacing [buttons] in the content
	 *
	 * @param $content
	 * @param $frame
	 *
	 * @return string
	 */
	function process_content( $content, $button ) {
		ob_start();
		$this->sub_widget('SiteOrigin_Widget_Button_Widget', array(), $button);
		$button_code = ob_get_clean();

		// Add in the button code
		$san_content = wp_kses_post($content);
		$content = preg_replace('/(?:<(?:p|h\d|em|strong|li|blockquote) *([^>]*)> *)?\[ *button *\](:? *<\/(?:p|h\d|em|strong|li|blockquote)>)?/i', '<div class="soew-square-card-button" $1>' . $button_code . '</div>', $san_content );
		
		// Process normal shortcodes
		$content = do_shortcode( shortcode_unautop( $content ) );
		return $content;
	}
}
siteorigin_widget_register('square-card-widget', __FILE__, 'Square_Card_Widget');