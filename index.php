<?php get_header(); ?>

<main id="primary">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <article class="language-python" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php if ( is_sticky() ) echo '<span style="background:black;color:white;padding:2px 5px;">TOP</span> '; ?>
                <span class="entry-date" style="font-family: monospace; color: #666;">
                    [<?php echo get_the_date('Y-m-d'); ?>]
                </span>
                
                <h2 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
            </header>

            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div>
            
            <footer class="entry-footer" style="margin-top:15px; border-top:1px dashed #ccc; padding-top:10px;">
                <a href="<?php the_permalink(); ?>" style="font-weight:bold; font-family:monospace;">Read_File.exe >></a>
            </footer>
        </article>

    <?php endwhile; endif; ?>
    
    <div class="pagination" style="text-align:center; padding: 20px; font-family: monospace;">
        <?php echo paginate_links(array('prev_text' => '<< PREV', 'next_text' => 'NEXT >>')); ?>
    </div>
</main>

<?php get_footer(); ?>
