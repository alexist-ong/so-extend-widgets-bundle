<?php
/*
Widget Name: Ubicomp SiteOrigin Book Now Button
Description: Create a book now button for Qikres reservation and promotion
Author: Alexist Ong
*/

class Book_Now_Button_Widget  extends SiteOrigin_Widget {
	function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'book-now-button-widget',

            // The name of the widget for display purposes.
            __('Ubicomp SiteOrigin Book Now Button Widget', 'so-extend-widgets-bundle'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Book now button for Qikres reservation and promotion.', 'so-extend-widgets-bundle')
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            false,

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

	function initialize() {
		$this->register_frontend_styles(
			array(
				array(
					'sow-button-base',
					plugin_dir_url(__FILE__) . 'css/style.css',
					array(),
					SOW_BUNDLE_VERSION
				),
			)
		);
	}

	function get_widget_form() {
		return array(
			'text' => array(
				'type' => 'text',
				'label' => __('Button text', 'so-extend-widgets-bundle'),
			),

			'booking_type' => array(
                'type' => 'select',
                'label' => __( 'Booking type', 'so-extend-widgets-bundle' ),
                'options' => array(
                    'reservation'    => __( 'Room Reservation', 'so-extend-widgets-bundle' ),
                    'promotion'  => __( 'Promotion', 'so-extend-widgets-bundle' )
                ),
            ),

			'new_window' => array(
				'type' => 'checkbox',
				'default' => false,
				'label' => __('Open in a new window', 'so-extend-widgets-bundle'),
			),

			'button_icon' => array(
				'type' => 'section',
				'label' => __('Icon', 'so-extend-widgets-bundle'),
				'fields' => array(
					'icon_selected' => array(
						'type' => 'icon',
						'label' => __('Icon', 'so-extend-widgets-bundle'),
					),

					'icon_color' => array(
						'type' => 'color',
						'label' => __('Icon color', 'so-extend-widgets-bundle'),
					),

					'icon' => array(
						'type' => 'media',
						'label' => __('Image icon', 'so-extend-widgets-bundle'),
						'description' => __('Replaces the icon with your own image icon.', 'so-extend-widgets-bundle'),
					),

					'icon_placement' => array(
						'type' => 'select',
						'label' => __( 'Icon Placement', 'so-extend-widgets-bundle' ),
						'default' => 'left',
						'options' => array(
							'top'    => __( 'Top', 'so-extend-widgets-bundle' ),
							'right'  => __( 'Right', 'so-extend-widgets-bundle' ),
							'bottom' => __( 'Bottom', 'so-extend-widgets-bundle' ),
							'left'   => __( 'Left', 'so-extend-widgets-bundle' ),
						),
					),
				),
			),

			'design' => array(
				'type' => 'section',
				'label' => __('Design and layout', 'so-extend-widgets-bundle'),
				'hide' => true,
				'fields' => array(

					'width' => array(
						'type' => 'measurement',
						'label' => __( 'Width', 'so-extend-widgets-bundle' ),
						'description' => __( 'Leave blank to let the button resize according to content.', 'so-extend-widgets-bundle' )
					),

					'align' => array(
						'type' => 'select',
						'label' => __('Align', 'so-extend-widgets-bundle'),
						'default' => 'center',
						'options' => array(
							'left' => __('Left', 'so-extend-widgets-bundle'),
							'right' => __('Right', 'so-extend-widgets-bundle'),
							'center' => __('Center', 'so-extend-widgets-bundle'),
							'justify' => __('Justify', 'so-extend-widgets-bundle'),
						),
					),

					'theme' => array(
						'type' => 'select',
						'label' => __('Button theme', 'so-extend-widgets-bundle'),
						'default' => 'atom',
						'options' => array(
							'atom' => __('Atom', 'so-extend-widgets-bundle'),
							'flat' => __('Flat', 'so-extend-widgets-bundle'),
							'wire' => __('Wire', 'so-extend-widgets-bundle'),
						),
					),


					'button_color' => array(
						'type' => 'color',
						'label' => __('Button color', 'so-extend-widgets-bundle'),
					),

					'text_color' => array(
						'type' => 'color',
						'label' => __('Text color', 'so-extend-widgets-bundle'),
					),

					'hover' => array(
						'type' => 'checkbox',
						'default' => true,
						'label' => __('Use hover effects', 'so-extend-widgets-bundle'),
					),

					'font' => array(
						'type' => 'font',
						'label' => __( 'Font', 'so-extend-widgets-bundle' ),
						'default' => 'default'
					),

					'font_size' => array(
						'type' => 'select',
						'label' => __('Font size', 'so-extend-widgets-bundle'),
						'options' => array(
							'1' => __('Normal', 'so-extend-widgets-bundle'),
							'1.15' => __('Medium', 'so-extend-widgets-bundle'),
							'1.3' => __('Large', 'so-extend-widgets-bundle'),
							'1.45' => __('Extra large', 'so-extend-widgets-bundle'),
						),
					),

					'rounding' => array(
						'type' => 'select',
						'label' => __('Rounding', 'so-extend-widgets-bundle'),
						'default' => '0.25',
						'options' => array(
							'0' => __('None', 'so-extend-widgets-bundle'),
							'0.25' => __('Slightly rounded', 'so-extend-widgets-bundle'),
							'0.5' => __('Very rounded', 'so-extend-widgets-bundle'),
							'1.5' => __('Completely rounded', 'so-extend-widgets-bundle'),
						),
					),

					'padding' => array(
						'type' => 'select',
						'label' => __('Padding', 'so-extend-widgets-bundle'),
						'default' => '1',
						'options' => array(
							'0.5' => __('Low', 'so-extend-widgets-bundle'),
							'1' => __('Medium', 'so-extend-widgets-bundle'),
							'1.4' => __('High', 'so-extend-widgets-bundle'),
							'1.8' => __('Very high', 'so-extend-widgets-bundle'),
						),
					),

				),
			),

			'attributes' => array(
				'type' => 'section',
				'label' => __('Other attributes and SEO', 'so-extend-widgets-bundle'),
				'hide' => true,
				'fields' => array(
					'id' => array(
						'type' => 'text',
						'label' => __('Button ID', 'so-extend-widgets-bundle'),
						'description' => __('An ID attribute allows you to target this button in Javascript.', 'so-extend-widgets-bundle'),
					),

					'classes' => array(
						'type' => 'text',
						'label' => __('Button Classes', 'so-extend-widgets-bundle'),
						'description' => __('Additional CSS classes added to the button link.', 'so-extend-widgets-bundle'),
					),

					'title' => array(
						'type' => 'text',
						'label' => __('Title attribute', 'so-extend-widgets-bundle'),
						'description' => __('Adds a title attribute to the button link.', 'so-extend-widgets-bundle'),
					)
				)
			),
		);
	}

	function get_style_name($instance) {
		if(empty($instance['design']['theme'])) return 'atom';
		return $instance['design']['theme'];
	}    

	/**
	 * Get the variables for the button widget.
	 *
	 * @param $instance
	 * @param $args
	 *
	 * @return array
	 */
	function get_template_variables( $instance, $args ) {
		$button_attributes = array();

		$attributes = $instance['attributes'];

		$classes = ! empty( $attributes['classes'] ) ? $attributes['classes'] : '';
		if ( ! empty( $classes ) ) {
			$classes .= ' ';
		}
		$classes .= 'ow-icon-placement-'. $instance['button_icon']['icon_placement'];
		if ( ! empty( $instance['design']['hover'] ) ) {
			$classes .= ' ow-button-hover';
		}

		$button_attributes['class'] = implode( ' ',
			array_map( 'sanitize_html_class',
				explode( ' ', $classes )
			)
		);

		if ( ! empty( $instance['new_window'] ) ) {
			$button_attributes['target'] = '_blank';
			$button_attributes['rel'] = 'noopener noreferrer';
		}

		if ( ! empty( $attributes['id'] ) ) {
			$button_attributes['id'] = $attributes['id'];
		}
		if ( ! empty( $attributes['title'] ) ) {
			$button_attributes['title'] = $attributes['title'];
		}
		if ( ! empty( $attributes['rel'] ) ) {
			if ( isset ( $button_attributes['rel'] ) ) {
				$button_attributes['rel'] .= " $attributes[rel]";
			} else {
				$button_attributes['rel'] = $attributes['rel'];
			}
		}

		$icon_image_url = '';
		if( ! empty( $instance['button_icon']['icon'] ) ) {
			$attachment = wp_get_attachment_image_src( $instance['button_icon']['icon'] );

			if ( ! empty( $attachment ) ) {
				$icon_image_url = $attachment[0];
			}
		}
        
        $href = '#';
        if( ! empty( $instance['booking_type'] ) ) {
            $booking_type = $instance['booking_type'];
            
            $post_id = get_the_ID();
            $contextPath = get_site_url();
            $site_name = get_bloginfo();
            $propertyCode = getSitePropertyCode($site_name);
            
            if( empty($propertyCode) ) {
                $propertyCode = UBI_PROPERTY_CODE;
            }
            
            $checkin_date = get_post_meta( $post_id, 'checkin_date', true );
            $checkout_date = get_post_meta( $post_id, 'checkout_date', true );
            $min_stay_length = get_post_meta( $post_id, 'min_stay_length', true );
            $lead_day = get_post_meta( $post_id, 'lead_day', true );
            $adult = get_post_meta( $post_id, 'adult', true );
            $child = get_post_meta( $post_id, 'child', true );
            $promo_code = get_post_meta( $post_id, 'promo_code', true );
            
            if( !$min_stay_length ) {
                $min_stay_length = '1';
            }
            
            if( !$checkin_date ) {
                $date = date_create();
                if( $lead_day && $lead_day != '0' ) {
                    date_add($date, date_interval_create_from_date_string($lead_day.' days'));
                }                
                $checkin_date = date_format($date, 'Y-m-d');
                
                if( !$checkout_date ) {
                    //check if check out date is after check in date
                    //otherwise nullify it
                    $date1 = date_create($checkin_date); //take this so no time component
                    $date2 = date_create($checkout_date);
                    $date_diff = date_diff($date1, $date2);
                    
                    if($date_diff <= 0) {
                        $checkout_date = '';
                    }
                }
            }
            
            if( !$checkout_date ) {
                $date = date_create($checkin_date);
                
                date_add($date, date_interval_create_from_date_string($min_stay_length.' days'));
                $checkout_date = date_format($date, 'Y-m-d');
            }
            
            if( !$adult ) {
                $adult = '1';
            }
            
            if( !$child ) {
                $child = '0';
            }
            
            $href = $contextPath;
            if( !empty($site_name) ) {
                $href .= '/'.$site_name;
            }
            
            $href .= '/reservation/?property='.$propertyCode.'&checkin='.$checkin_date.'&checkout='.$checkout_date.'&adult='.$adult.'&child='.$child;
            if( $booking_type == 'promotion' && !empty($promo_code) ) {
                $href .= '&productcode='.$promo_code;
            }
        }

		return array(
			'button_attributes' => $button_attributes,
			'href' => $href,
			'onclick' => ! empty( $attributes['onclick'] ) ? $attributes['onclick'] : '',
			'align' => $instance['design']['align'],
			'icon_image_url' => $icon_image_url,
			'icon' => $instance['button_icon']['icon_selected'],
			'icon_color' => $instance['button_icon']['icon_color'],
			'text' => $instance['text'],
		);
	}

	/**
	 * Get the variables that we'll be injecting into the less stylesheet.
	 *
	 * @param $instance
	 *
	 * @return array
	 */
	function get_less_variables($instance){
		if( empty( $instance ) || empty( $instance['design'] ) ) return array();

		$less_vars = array(
			'button_width' => isset( $instance['design']['width'] ) ? $instance['design']['width'] : '',
			'button_color' => isset($instance['design']['button_color']) ? $instance['design']['button_color'] : '',
			'text_color' =>   isset($instance['design']['text_color']) ? $instance['design']['text_color'] : '',

			'font_size' => isset($instance['design']['font_size']) ? $instance['design']['font_size'] . 'em' : '',
			'rounding' => isset($instance['design']['rounding']) ? $instance['design']['rounding'] . 'em' : '',
			'padding' => isset($instance['design']['padding']) ? $instance['design']['padding'] . 'em' : '',
			'has_text' => empty( $instance['text'] ) ? 'false' : 'true',
		);

		if ( ! empty( $instance['design']['font'] ) ) {
			$font = siteorigin_widget_get_font( $instance['design']['font'] );
			$less_vars['button_font'] = $font['family'];
			if ( ! empty( $font['weight'] ) ) {
				$less_vars['button_font_weight'] = $font['weight'];
			}
		}
		return $less_vars;
	}

	function get_google_font_fields( $instance ) {
		return array(
			$instance['design']['font'],
		);
	}
	/**
	 * Make sure the instance is the most up to date version.
	 *
	 * @param $instance
	 *
	 * @return mixed
	 */
	function modify_instance( $instance ) {
		$migrate_props = array(
			'button_icon' => array(
				'icon_selected',
				'icon_color',
				'icon',
			),
			'design' => array(
				'align',
				'theme',
				'button_color',
				'text_color',
				'hover',
				'font_size',
				'rounding',
				'padding',
			),
			'attributes' => array(
				'id'
			),
		);
		
		foreach ( $migrate_props as $prop => $sub_props ) {
			if ( empty( $instance[ $prop ] ) ) {
				$instance[ $prop ] = array();
				foreach ( $sub_props as $sub_prop ) {
					if ( isset( $instance[ $sub_prop ] ) ) {
						$instance[ $prop ][ $sub_prop ] = $instance[ $sub_prop ];
						unset( $instance[ $sub_prop ] );
					}
				}
			}
		}

		return $instance;
	}
}

siteorigin_widget_register('book-now-button-widget', __FILE__, 'Book_Now_Button_Widget');
