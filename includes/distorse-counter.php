<?php
/**
 * Adds Distorse_Counter widget.
 */
class Distorse_Counter_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'distorsecounter_widget', // Base ID
			esc_html__( 'COVID19 Live Updates', 'dist_domain' ), // Name
			array( 'description' => esc_html__( 'Widget to display COVID19 live updates', 'dist_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		$data = wp_remote_retrieve_body( wp_remote_get( 'https://distorse.com/api-basic-stats-world/' ) );

		$data = json_decode( $data, true );
		echo "<div class='distorse-covid-counter-container'>";
			echo "<div class='distorse-covid-counter-confirmed'>";
				echo "<div style='color:#ddd'> ".$instance['confirmed_cases']."</div>";
				echo "<div> " . $data['confirmed'] . '</div>';
			echo "</div>";
			echo "<div style='padding:5px'> </div>";
			echo "<div class='distorse-covid-counter-deaths'>";			
				echo "<div style='color:#ddd'>  ".$instance['deaths']."</div>";
				echo "<div > " . $data['deaths'] . '</div>';
			echo "</div>";
			echo "<div style='padding:5px'> </div>";
			echo "<div class='distorse-covid-counter-recovered'>";
				echo "<div style='color:#ddd'> ".$instance['recovered']."</div>";
				echo "<div > " . $data['recovered'] . '</div>';
			echo "</div>";
			echo "<a style='font-size:14px;color: #89d57f;' target='_blank' href='https://distorse.com/covid-19-coverage-world/'>more statistics on Distorse</a>";
		echo "</div>";
			
		echo $args['after_widget'];
		
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'COVID19 Live Updates', 'dist_domain' );
		$confirmed_cases = ! empty( $instance['confirmed_cases'] ) ? $instance['confirmed_cases'] : esc_html__( 'Confirmed Cases', 'dist_domain' );
		$deaths = ! empty( $instance['deaths'] ) ? $instance['deaths'] : esc_html__( 'Deaths', 'dist_domain' );
		$recovered = ! empty( $instance['recovered'] ) ? $instance['recovered'] : esc_html__( 'Recovered', 'dist_domain' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'dist_domain' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'confirmed_cases' ) ); ?>"><?php esc_attr_e( 'Confirmed Cases', 'dist_domain' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'confirmed_cases' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'confirmed_cases' ) ); ?>" type="text" value="<?php echo esc_attr( $confirmed_cases ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'deaths' ) ); ?>"><?php esc_attr_e( 'Deaths', 'dist_domain' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'deaths' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'deaths' ) ); ?>" type="text" value="<?php echo esc_attr( $deaths ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'recovered' ) ); ?>"><?php esc_attr_e( 'Recovered', 'dist_domain' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'recovered' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'recovered' ) ); ?>" type="text" value="<?php echo esc_attr( $recovered ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['confirmed_cases'] = ( ! empty( $new_instance['confirmed_cases'] ) ) ? sanitize_text_field( $new_instance['confirmed_cases'] ) : '';
		$instance['deaths'] = ( ! empty( $new_instance['deaths'] ) ) ? sanitize_text_field( $new_instance['deaths'] ) : '';
		$instance['recovered'] = ( ! empty( $new_instance['recovered'] ) ) ? sanitize_text_field( $new_instance['recovered'] ) : '';

		return $instance;
	}

} // class Foo_Widget