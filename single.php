<?php get_header(); ?>

<main id="primary" class="language-python">
    <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="entry-meta">
                    USER: <?php the_author(); ?> | DATE: <?php echo get_the_date(); ?>
                </div>
            </header>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <div class="post-navigation-retro">
                <div class="nav-previous">
                    <?php previous_post_link( '<span class="nav-label"><< PREV_LOG</span><br>%link' ); ?>
                </div>
                <div class="nav-next">
                    <?php next_post_link( '<span class="nav-label">NEXT_LOG >></span><br>%link' ); ?>
                </div>
            </div>

        </article>

        <?php
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
