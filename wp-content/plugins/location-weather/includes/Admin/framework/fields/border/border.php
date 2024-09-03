<?php
/**
 *  Framework border field file.
 *
 * @package    Location_weather
 * @subpackage Location_weather/framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPLWT_Field_border' ) ) {
	/**
	 *
	 * Field: border
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPLWT_Field_border extends SPLWT_Fields {

		/**
		 * Column field constructor.
		 *
		 * @param array  $field The field type.
		 * @param string $value The values of the field.
		 * @param string $unique The unique ID for the field.
		 * @param string $where To where show the output CSS.
		 * @param string $parent The parent args.
		 */
		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		/**
		 * Render field
		 *
		 * @return void
		 */
		public function render() {

			$args = wp_parse_args(
				$this->field,
				array(
					'top_icon'           => '<i class="fas fa-long-arrow-alt-up"></i>',
					'left_icon'          => '<i class="fas fa-long-arrow-alt-left"></i>',
					'bottom_icon'        => '<i class="fas fa-long-arrow-alt-down"></i>',
					'right_icon'         => '<i class="fas fa-long-arrow-alt-right"></i>',
					'all_icon'           => '<i class="fas fa-arrows-alt"></i>',
					'top_placeholder'    => esc_html__( 'top', 'location-weather' ),
					'right_placeholder'  => esc_html__( 'right', 'location-weather' ),
					'bottom_placeholder' => esc_html__( 'bottom', 'location-weather' ),
					'left_placeholder'   => esc_html__( 'left', 'location-weather' ),
					'all_placeholder'    => esc_html__( 'all', 'location-weather' ),
					'top'                => true,
					'left'               => true,
					'bottom'             => true,
					'right'              => true,
					'all'                => false,
					'background'         => false,
					'active_color'       => false,
					'active_bg'          => false,
					'radius'             => false,
					'color'              => true,
					'style'              => true,
					'unit'               => 'px',
				)
			);

			$default_value = array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
				'color'  => '',
				'style'  => 'solid',
				'all'    => '',
			);

			$border_props = array(
				'solid'  => esc_html__( 'Solid', 'location-weather' ),
				'dashed' => esc_html__( 'Dashed', 'location-weather' ),
				'dotted' => esc_html__( 'Dotted', 'location-weather' ),
				'double' => esc_html__( 'Double', 'location-weather' ),
				'inset'  => esc_html__( 'Inset', 'location-weather' ),
				'outset' => esc_html__( 'Outset', 'location-weather' ),
				'groove' => esc_html__( 'Groove', 'location-weather' ),
				'ridge'  => esc_html__( 'ridge', 'location-weather' ),
				'none'   => esc_html__( 'None', 'location-weather' ),
			);

			$default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

			$value = wp_parse_args( $this->value, $default_value );

			echo $this->field_before(); // phpcs:ignore

			echo '<div class="splwt-lite--inputs">';

			if ( ! empty( $args['all'] ) ) {

				$placeholder = ( ! empty( $args['all_placeholder'] ) ) ? ' placeholder="' . esc_attr( $args['all_placeholder'] ) . '"' : '';

				echo '<div class="splwt-lite--input">';
				echo '<div class="splwt-lite--title">Width</div>';
				echo ( ! empty( $args['all_icon'] ) ) ? '<span class="splwt-lite--label splwt-lite--icon">' . wp_kses_post( $args['all_icon'] ) . '</span>' : '';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[all]' ) ) . '" value="' . esc_attr( $value['all'] ) . '"' . $placeholder . ' class="splwt-lite-input-number splwt-lite--is-unit" />'; // phpcs:ignore
				echo ( ! empty( $args['unit'] ) ) ? '<span class="splwt-lite--label splwt-lite--unit">' . esc_attr( $args['unit'] ) . '</span>' : '';
				echo '</div>';

			} else {

				$properties = array();

				foreach ( array( 'top', 'right', 'bottom', 'left' ) as $prop ) {
					if ( ! empty( $args[ $prop ] ) ) {
						$properties[] = $prop;
					}
				}

				$properties = ( array( 'right', 'left' ) === $properties ) ? array_reverse( $properties ) : $properties;

				foreach ( $properties as $property ) {

					$placeholder = ( ! empty( $args[ $property . '_placeholder' ] ) ) ? ' placeholder="' . esc_attr( $args[ $property . '_placeholder' ] ) . '"' : '';

					echo '<div class="splwt-lite--input">';
					echo ( ! empty( $args[ $property . '_icon' ] ) ) ? '<span class="splwt-lite--label splwt-lite--icon">' . wp_kses_post( $args[ $property . '_icon' ] ) . '</span>' : '';
					echo '<input type="number" name="' . esc_attr( $this->field_name( '[' . $property . ']' ) ) . '" value="' . esc_attr( $value[ $property ] ) . '"' . $placeholder . ' class="splwt-lite-input-number splwt-lite--is-unit" />'; // phpcs:ignore
					echo ( ! empty( $args['unit'] ) ) ? '<span class="splwt-lite--label splwt-lite--unit">' . esc_attr( $args['unit'] ) . '</span>' : '';
					echo '</div>';

				}
			}

			if ( ! empty( $args['style'] ) ) {
				echo '<div class="splwt-lite--input">';
				echo '<div class="splwt-lite--title">Style</div>';
				echo '<select name="' . esc_attr( $this->field_name( '[style]' ) ) . '">';
				foreach ( $border_props as $border_prop_key => $border_prop_value ) {
					$selected = ( $value['style'] === $border_prop_key ) ? ' selected' : '';
					echo '<option value="' . esc_attr( $border_prop_key ) . '"' . esc_attr( $selected ) . '>' . esc_attr( $border_prop_value ) . '</option>';
				}
				echo '</select>';
				echo '</div>';
			}

			echo '</div>';

			if ( ! empty( $args['color'] ) ) {
				$default_color_attr = ( ! empty( $default_value['color'] ) ) ? ' data-default-color="' . esc_attr( $default_value['color'] ) . '"' : '';
				echo '<div class="splwt-lite--color">';
				echo '<div class="splwt-lite--title">Color</div>';
				echo '<div class="splwt-lite-field-color">';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[color]' ) ) . '" value="' . esc_attr( $value['color'] ) . '" class="splwt-lite-color"' . $default_color_attr . ' />'; // phpcs:ignore
				echo '</div>';
				echo '</div>';
			}
			if ( ! empty( $args['active_color'] ) ) {
				$default_color_attr = ( ! empty( $default_value['active_color'] ) ) ? ' data-default-color="' . esc_attr( $default_value['active_color'] ) . '"' : '';
				echo '<div class="splwt-lite--color">';
				echo '<div class="splwt-lite--title">Active Color</div>';
				echo '<div class="splwt-lite-field-color">';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[active_color]' ) ) . '" value="' . esc_attr( $value['active_color'] ) . '" class="splwt-lite-color"' . wp_kses_post( $default_color_attr ) . ' />';
				echo '</div>';
				echo '</div>';
			}
			if ( ! empty( $args['background'] ) ) {
				$default_color_attr = ( ! empty( $default_value['background'] ) ) ? ' data-default-color="' . esc_attr( $default_value['background'] ) . '"' : '';
				echo '<div class="splwt-lite--color">';
				echo '<div class="splwt-lite--title">Background</div>';
				echo '<div class="splwt-lite-field-color">';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[background]' ) ) . '" value="' . esc_attr( $value['background'] ) . '" class="splwt-lite-color"' . wp_kses_post( $default_color_attr ) . ' />';
				echo '</div>';
				echo '</div>';
			}
			if ( ! empty( $args['active_bg'] ) ) {
				$default_color_attr = ( ! empty( $default_value['active_bg'] ) ) ? ' data-default-color="' . esc_attr( $default_value['active_bg'] ) . '"' : '';
				echo '<div class="splwt-lite--color">';
				echo '<div class="splwt-lite--title">Active BG</div>';
				echo '<div class="splwt-lite-field-color">';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[active_bg]' ) ) . '" value="' . esc_attr( $value['active_bg'] ) . '" class="splwt-lite-color"' . wp_kses_post( $default_color_attr ) . ' />';
				echo '</div>';
				echo '</div>';
			}

			if ( ! empty( $args['radius'] ) ) {

				$placeholder = ( ! empty( $args['all_placeholder'] ) ) ? $args['all_placeholder'] : '';

				echo '<div class="splwt-lite--input">';
				echo '<div class="splwt-lite--title">Radius</div>';
				echo ( ! empty( $args['all_icon'] ) ) ? '<span class="splwt-lite--label splwt-lite--icon">' . wp_kses_post( $args['all_icon'] ) . '</span>' : '';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[radius]' ) ) . '" value="' . esc_attr( $value['radius'] ) . '" placeholder="' . esc_attr( $placeholder ) . '" class="splwt-lite-input-number splwt-lite--is-unit" />';
				echo ( ! empty( $args['unit'] ) ) ? '<span class="splwt-lite--label splwt-lite--unit">' . esc_attr( $args['unit'] ) . '</span>' : '';
				echo '</div>';

			}

			echo $this->field_after(); // phpcs:ignore

		}

	}
}
