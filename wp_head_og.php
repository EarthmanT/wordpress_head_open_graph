<?php

  /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
   * Facebook offers developers the opportunity to have more control over 
   * how their applications are represented on Facebook, using the open
   * graph protocol.
   * This module offers wordpress developers a simple approach to inserting
   * Open Graph tags into the <head></head> tags of their wordpress sites.
   * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  */

  /* Insert the URL of an image. This is the default image that should be   
   * displayed in the case that there is no other image in the page.
  */

  add_action('wp_head', 'open_graph_properties');
  
  function og_get_attachment_image_src_url() {
  $site_default = (get_option('magnificent_logo') <> '') ? get_option('magnificent_logo') : get_template_directory_uri().'/images/'.$colorSchemePath.'logo.png';
    if ( is_single() ) {
      if ( has_post_thumbnail( $post->ID ) ) {
        $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
        $image_url = $image_src[0];
      }
    } else {
      $image_url = $site_default;
    }
    return $image_url;
  }
  
  function open_graph_properties() {
    $og_properties = [
      "og_title" => get_the_title( $post->ID ),
      "og_type" => "website",
      "og_image" => og_get_attachment_image_src_url(),
      "og_url" => get_permalink( $post->ID ),
      "og_description" => get_bloginfo ( 'description' ),
      "og_sitename" => get_bloginfo( 'name' ),
    ];
    echo '<meta property="og:title" content="'.$og_properties["og_title"].'" />';    
    echo '<meta property="og:type" content="'.$og_properties["og_type"].'" />';    
    echo '<meta property="og:image" content="'.$og_properties["og_image"].'" />';
    echo '<meta property="og:url" content="'.$og_properties["og_url"].'" />';
    echo '<meta property="og:description" content="'.$og_properties["og_description"].'" />';
    echo '<meta property="og:sitename" content="'.$og_properties["og_sitename"].'" />';
  }
?>
