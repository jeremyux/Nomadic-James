<?php get_header();?>
  <!--HERO POST -->
  
  <div class="container-fluid full-width">
    <div class="hero-section">
        <div class="row">
        <?php            
            echo do_shortcode('[vidbg container=".hero-section" mp4="http://localhost/james/wp-content/uploads/2020/06/hammock_ws.mp4" webm="#" poster="#" loop="true" overlay="true" overlay_color="#000" overlay_alpha="0.2" muted="false"]');
            ?> 
          <?php if(have_posts()) : while(have_posts()) : the_post();?>
          <?php the_content();?>
          <?php endwhile; else: endif;?>
          <?php
          $args = array(
            "post_type" => "post",
            "posts_per_page" => 1
          );

          $_posts = new WP_Query( $args );
          ?>
          <?php if($_posts->have_posts());?>
          <?php while ($_posts->have_posts()): $_posts->the_post();?>
          <div class="col-lg-4 hero hero-text">
            <div class="secondary-title">
                <?php echo get_secondary_title(); ?>
            </div>    
            <h3>
              <?php the_title();?>
            </h3>
            <?php the_excerpt();?>
            <button type="button" class="btn btn-primary">DISCOVER HERE</button>  
          </div>
          <?php endwhile;?>   
        </div>
    </div>    
  </div>
  


  <!--GRID POSTS    -->
  <div class="container">
    <div class="row">
      <?php if(have_posts()) : while(have_posts()) : the_post();?>
      <?php the_content();?>
      <?php endwhile; else: endif;?>
        
      <?php
      $args = array(
        "post_type" => "post"
      );

      $_posts = new WP_Query( $args );
      ?>
      <?php if($_posts->have_posts());?>
      <?php $count = -1; ?>
      <!-- declare counter variable. start = -1 -->
      <?php while ($_posts->have_posts()): $_posts->the_post();?>
      <?php $count += 1 ?>
      <!-- increment counter each time loop starts -->
      <?php if ($count == 0) { continue; } ?>
      <!-- if counter is equal to the first index in array (0) skip -->
      <div class="col-md-4 col-sm-6 grid-item">
        <div style="display: none;">
            <?php echo get_secondary_title(); ?>
        </div>
        <div>
        </div>  
          
            <div class="grid-hover">
                <?php if(has_post_thumbnail()):?> 
                    <img src="<?php the_post_thumbnail_url("grid-item");?>" class="grid-img">
                <?php endif;?>

                <h4 class="grid-title">
                    <?php the_title();?>
                </h4>
            </div>
        <p class="grid-date"><?php the_time("F jS, Y");?></p>  
      </div>
      <?php endwhile;?>
    </div>
  </div>
<?php get_footer();?>

