<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<title>Nomadic James</title>
        <?php wp_head();?>
</head>

<body>  
    <header>
<nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
  <div class="container-fluid custom-padding">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="nav-container">  
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar-collapse" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <?php
                the_custom_logo();
            ?> 
        </a>
    </div>    
        <div class="custom-nav">      
            <?php
                wp_nav_menu( array(
                    'theme_location'  => 'primary',
                    'depth'           => 1, // 1 = no dropdowns, 2 = with dropdowns.
                    'container'       => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id' => 'main-navbar-collapse',
                    'menu_class'      => 'navbar-nav mr-auto',
                    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'          => new WP_Bootstrap_Navwalker(),
                ) );            
            
            ?>
        </div>
    </div>
</nav>          
    </header>  