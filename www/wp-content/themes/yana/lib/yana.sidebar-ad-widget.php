<?php

namespace YANA;

const ID = 'yana-sidebar-ad-widget';

add_action( 'widgets_init', function () { register_widget( 'YANA\SidebarAdWidget' ); } );

class SidebarAdWidget extends \WP_Widget {
  var $images = array();

  public function __construct() {
    $this->images = array(
      '' => 'None',
      'sidebar-auction.jpg' => 'Auction',
      'sidebar-ride.jpg' => 'Ride',
      'sidebar-upcoming-events.jpg' => 'Upcoming Events'
    );

    parent::__construct(
      ID,
      'YANA Sidebar Ad',
      array( 'description' => 'Pre-designed ad for the YANA sidebar' ),
      array( 'width' => 306 )
    );
  }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['image'] = trim( strip_tags( $new_instance['image'] ) );
    $instance['url'] = trim( strip_tags( $new_instance['url'] ) );
    return $instance;
  }

  public function form( $instance ) {
    $image = isset( $instance[ 'image' ] ) ? $instance[ 'image' ] : '';
    $url = isset( $instance[ 'url' ] ) ? $instance[ 'url' ] : '';
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'image' ); ?>">Image</label>
      <select class="widefat"
             id="<?php echo $this->get_field_id( 'image' ); ?>"
             name="<?php echo $this->get_field_name( 'image' ); ?>">
        <?php foreach( $this->images as $slug => $label ): ?>
          <option value="<?php echo $slug; ?>" <?php selected( $image, $slug ); ?>><?php echo esc_html($label); ?></option>
        <?php endforeach; ?>
      </select>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id( 'url' ); ?>">URL to link to</label>
      <input class="widefat"
             id="<?php echo $this->get_field_id( 'url' ); ?>"
             name="<?php echo $this->get_field_name( 'url' ); ?>"
             type="text" value="<?php echo esc_attr( $url ); ?>">
    </p>
    <?php
  }

  public function widget( $args, $instance ) {
    extract( $args );
    echo $before_widget;

    $url    = isset( $instance['url'] ) ? $instance['url'] : false;
    $image = isset( $instance['image'] ) ? $instance['image'] : false;

    $html = sprintf( "<img src='%s/img/ads/%s' alt=''>",
                      get_template_directory_uri(),
                      esc_attr( $image )
                    );

    if ( !empty( $url ) ) {
      $html = sprintf( "<a href='%s' class='frame'>%s</a>", esc_attr( $url ), $html );
    } else {
      $html = sprintf( "<div class='frame'>%s</div>", $html );
    }


    printf( "<div class='sidebar-ad'>%s</div>", $html );

    echo $after_widget;
  }
}
