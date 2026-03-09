<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="site-container">
        <header id="masthead">
            <div class="site-branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title">
                    >_ <?php bloginfo( 'name' ); ?>
                </a>
                <p class="site-description"><?php bloginfo( 'description' ); ?></p>
            </div>
            
            <nav id="site-navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'container' => false ) ); ?>
            </nav>

            <hr class="retro-divider">

            <div class="sidebar-widget search-widget">
                <h3 class="widget-title">SEARCH_QUERY</h3>
                <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" class="search-field" placeholder="Keywords..." value="<?php echo get_search_query(); ?>" name="s" />
                    <button type="submit" class="search-submit">GO</button>
                </form>
            </div>

            <div class="sidebar-widget archive-widget">
                <h3 class="widget-title">LOGS_ARCHIVE</h3>
                <ul class="archive-list-custom">
                <?php
                global $wpdb;
                $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");
                
                foreach($years as $year) : 
                ?>
                    <li>
                        <a href="#" class="archive-year-toggle" data-year="<?php echo $year; ?>">[+] <?php echo $year; ?></a>
                        <ul id="archive-year-<?php echo $year; ?>" class="archive-month-list" style="display:none; padding-left: 15px;">
                            <?php 
                                $months = $wpdb->get_results("SELECT DISTINCT MONTH(post_date) as month, COUNT(ID) as count FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND YEAR(post_date) = '$year' GROUP BY month ORDER BY month DESC");
                                foreach($months as $m) :
                                    $month_name = date_i18n("M", mktime(0, 0, 0, $m->month, 10));
                                    $link = get_month_link($year, $m->month);
                            ?>
                                <li>
                                    <a href="<?php echo $link; ?>"><?php echo $month_name; ?> (<?php echo $m->count; ?>)</a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>

            <div class="sidebar-widget tag-widget">
                <h3 class="widget-title">DATA_TAGS</h3>
                <div class="tag-cloud-content">
                    <?php 
                    wp_tag_cloud(array(
                        'smallest' => 12, 
                        'largest' => 12, 
                        'unit' => 'px', 
                        'format' => 'flat',
                        'separator' => ' ',
                    )); 
                    ?>
                </div>
            </div>

            <div class="sidebar-widget link-widget">
                <h3 class="widget-title">HYPERLINKS</h3>
                <?php 
                wp_nav_menu( array( 
                    'theme_location' => 'menu-links', 
                    'container' => false,
                    'fallback_cb' => false 
                ) ); 
                ?>
            </div>
            
        </header>
