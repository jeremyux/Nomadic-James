<?php get_header();?>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8 blog-content"> 
                <h3 class="section-title blog-title"><?php the_title();?></h3>
                <div class="blog-title">
                    <?php get_template_part("includes/section", "content");?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>