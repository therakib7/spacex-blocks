<?php
/*
 * Template Name: SpaceX Blocks
 * Description: Template for SpaceX Blocks
 */
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    if (is_user_logged_in() && apply_filters('bfsb_admin', current_user_can('bfsb_core'))) {
        if (bfsb()->wage()) {
            echo '<div id="bfsb-dashboard"></div>';
        } else {
            bfsb()->render('template/partial/403');
        }
    } else {  
        bfsb()->render('template/partial/403');
    }
    ?>
    <?php wp_footer(); ?>
</body>

</html>