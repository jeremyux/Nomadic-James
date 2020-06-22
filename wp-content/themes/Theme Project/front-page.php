<?php get_header();?>
  <!--HERO POST -->
  
  <div class="container-fluid full-width">
    <div class="hero-section">
        <div class="row">
        <?php            
            echo do_shortcode('[vidbg container=".hero-section" mp4="http://localhost/james/wp-content/uploads/2020/06/offroad.mp4" webm="#" poster="#" loop="true" overlay="true" overlay_color="#000" overlay_alpha="0.2" muted="false"]');
            ?> 
          <?php if(have_posts()) : while(have_posts()) : the_post();?>
          <?php the_content();?>
          <?php endwhile; else: endif;?>
          <?php
          $args = array(
            "post_type" => "post",
            "posts_per_page" => 1,
            'category_name' => "hero",
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
        "post_type" => "post",
        "posts_per_page" => 6,
        'category_name' => "Blog",
      );

      $_posts = new WP_Query( $args );
      ?>
      <?php if($_posts->have_posts());?>
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
          
            <a href="<?php the_permalink();?>" class="grid-hover">
              
                <?php if(has_post_thumbnail()):?> 
                    <div class="grid-img" style="background-image:url('<?php the_post_thumbnail_url("grid-item");?>')"></div>
                <?php endif;?>

                <h4 class="grid-title">
                    <?php the_title();?>
                </h4>
                </a>
        <p class="grid-date"><?php the_time("F jS, Y");?></p>  
      </div>
      <?php endwhile;?>
    </div>
  </div>
  <div class="container-fluid full-width">
    <h4 class="section-title grid-title">Instagram</h4>
    <p class="grid-date instagram">@jpimentel</p>    
      <div class="row">
<!-- LightWidget WIDGET --><script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/bd5679d4b73e547588c07fc7cd60e420.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;"></iframe>

      </div>
  </div>
<?php get_footer();?>

