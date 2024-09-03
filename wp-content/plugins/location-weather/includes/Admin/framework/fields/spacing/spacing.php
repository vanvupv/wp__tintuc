<?php
/**
 *  Framework spacing field file.
 *
 * @package    Location_weather
 * @subpackage Location_weather/framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPLWT_Field_spacing' ) ) {
	/**
	 *
	 * Field: spacing
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPLWT_Field_spacing extends SPLWT_Fields {

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
					'right_icon'         => '<i class="fas fa-long-arrow-alt-right"></i>',
					'bottom_icon'        => '<i class="fas fa-long-arrow-alt-down"></i>',
					'left_icon'          => '<i class="fas fa-long-arrow-alt-left"></i>',
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
					'horizontal'         => false,
					'unit'               => true,
					'show_units'         => true,
					'all'                => false,
					'units'              => array( 'px', '%', 'em' ),
				)
			);

			$default_values = array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
				'all'    => '',
				'unit'   => 'px',
			);

			$value   = wp_parse_args( $this->value, $default_values );
			$unit    = ( count( $args['units'] ) === 1 && ! empty( $args['unit'] ) ) ? $args['units'][0] : '';
			$is_unit = ( ! empty( $unit ) ) ? ' splwt-lite--is-unit' : '';

			echo $this->field_before(); // phpcs:ignore

			echo '<div class="splwt-lite--inputs">';

			if ( ! empty( $args['all'] ) ) {

				$placeholder = ( ! empty( $args['all_placeholder'] ) ) ? ' placeholder="' . esc_attr( $args['all_placeholder'] ) . '"' : '';
				$title       = ( ! empty( $args['all_title'] ) ) ? '<div class="splwt-lite--title">' . esc_html( $args['all_title'] ) . '</div>' : '';

				echo '<div class="splwt-lite--input">';
				echo $title;
				echo ( ! empty( $args['all_icon'] ) ) ? '<span class="splwt-lite--label splwt-lite--icon">' . wp_kses_post( $args['all_icon'] ) . '</span>' : '';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[all]' ) ) . '" value="' . esc_attr( $value['all'] ) . '"' . $placeholder . ' class="splwt-lite-input-number splwt-lite--all' . esc_attr( $is_unit ) . '" />'; // phpcs:ignore
				echo ( $unit ) ? '<span class="splwt-lite--label splwt-lite--unit">' . esc_attr( $args['units'][0] ) . '</span>' : '';
				echo '</div>';

			} else {

				$properties = array();

				foreach ( array( 'top', 'right', 'bottom', 'left' ) as $prop ) {
					if ( ! empty( $args[ $prop ] ) ) {
						$properties[] = $prop;
					}
				}

				$properties = ( array( 'right', 'left' ) ) === $properties ? array_reverse( $properties ) : $properties;

				foreach ( $properties as $property ) {

					$placeholder = ( ! empty( $args[ $property . '_placeholder' ] ) ) ? ' placeholder="' . esc_attr( $args[ $property . '_placeholder' ] ) . '"' : '';

					echo '<div class="splwt-lite--input">';
					echo '<div class="splwt-lite--title">' . esc_html( $property ) . '</div>';
					echo ( ! empty( $args[ $property . '_icon' ] ) ) ? '<span class="splwt-lite--label splwt-lite--icon">' . wp_kses_post( $args[ $property . '_icon' ] ) . '</span>' : '';
					echo '<input type="number" name="' . esc_attr( $this->field_name( '[' . $property . ']' ) ) . '" value="' . esc_attr( $value[ $property ] ) . '"' . $placeholder . ' class="splwt-lite-input-number' . esc_attr( $is_unit ) . ' splwt-lite--' . esc_attr( $property ) . '" />'; // phpcs:ignore
					echo ( $unit ) ? '<span class="splwt-lite--label splwt-lite--unit">' . esc_attr( $args['units'][0] ) . '</span>' : '';
					echo '</div>';

				}
			}

			if ( ! empty( $args['horizontal'] ) ) {

				$placeholder = ( ! empty( $args['all_placeholder'] ) ) ? $args['all_placeholder'] : '';

				echo '<div class="splwt-lite--input">';
				echo '<div class="splwt-lite--title">' . esc_html( __( 'Horizontal', 'location-weather' ) ) . '</div>';
				echo ( ! empty( $args['horizontal_icon'] ) ) ? '<span class="splwt-lite--label splwt-lite--icon">' . wp_kses_post( $args['horizontal_icon'] ) . '</span>' : '';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[horizontal]' ) ) . '" value="' . esc_attr( $value['horizontal'] ) . '" placeholder="' . esc_attr( $placeholder ) . '" class="splwt-lite-input-number splwt-lite--all' . esc_attr( $is_unit ) . '" />';
				echo ( $unit ) ? '<span class="splwt-lite--label splwt-lite--unit">' . esc_attr( $args['units'][0] ) . '</span>' : '';
				echo '</div>';

			}

			if ( ! empty( $args['unit'] ) && ! empty( $args['show_units'] ) && count( $args['units'] ) > 1 ) {
				echo '<div class="splwt-lite--input">';
				echo '<select name="' . esc_attr( $this->field_name( '[unit]' ) ) . '">';
				foreach ( $args['units'] as $unit ) {
					$selected = ( $value['unit'] === $unit ) ? ' selected' : '';
					echo '<option value="' . esc_attr( $unit ) . '"' . esc_attr( $selected ) . '>' . esc_attr( $unit ) . '</option>';
				}
				echo '</select>';
				echo '</div>';
			}

			echo '</div>';

			echo $this->field_after(); // phpcs:ignore

		}
	}
}
