<?php

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    if ( have_comments() ) :
        ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ( '1' === $comment_count ) {
                printf( esc_html__( '1 LOG_ENTRY FOUND', 'retros' ) );
            } else {
                printf( 
                    esc_html__( '%1$s LOG_ENTRIES FOUND', 'retros' ),
                    number_format_i18n( $comment_count )
                );
            }
            ?>
        </h2>

        <ol class="comment-list" style="list-style: none; padding: 0;">
            <?php
            wp_list_comments( array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size'=> 48,
            ) );
            ?>
        </ol>

        <?php
        the_comments_navigation();

        if ( ! comments_open() ) :
            ?>
            <p class="no-comments"><?php esc_html_e( '/// SYSTEM LOCKED: COMMENTS CLOSED ///', 'retros' ); ?></p>
            <?php
        endif;

    endif; 

    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html_req = ( $req ? " required='required'" : '' );

    $fields =  array(
        'author' =>
            '<p class="comment-form-author"><label for="author">NAME_ID:</label> ' .
            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
            '" size="30"' . $aria_req . $html_req . ' /></p>',

        'email' =>
            '<p class="comment-form-email"><label for="email">EMAIL_ADDR:</label> ' .
            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
            '" size="30"' . $aria_req . $html_req . ' /></p>',

        'url' =>
            '<p class="comment-form-url"><label for="url">WEB_LINK:</label> ' .
            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
            '" size="30" /></p>',

        'cookies' => '',
    );


    $comment_args = array(
        'title_reply'       => 'INPUT_NEW_LOG',
        'title_reply_to'    => 'REPLY_TO_NODE %s',
        'label_submit'      => 'EXECUTE_SEND >>',
        'comment_notes_before' => '',

        'fields' => $fields,

        'comment_notes_after' => '
            <div class="comment-manual-box">
                <h4 class="manual-title">>> SYSTEM_MANUAL_v1.0</h4>
                <ul class="manual-list">
                    <li>[INFO] Email field is required for messages only.</li>
                    <li>[INFO] Use <code>&lt;pre&gt;&lt;code class="language-xxx(python for default)"&gt;...&lt;/code&gt;&lt;/pre&gt;</code> for code blocks.</li>
                    <li>[INFO] Use <code>$..$</code> for inline math, <code>$$..$$</code> for display math.</li>
                    <li>[WARN] Cross-site scripting (XSS) attempts will be logged.</li>
                </ul>
            </div>
        ',
        
        'comment_field' =>  '<p class="comment-form-comment"><label for="comment">DATA_INPUT:</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required="required"></textarea></p>',
    );

    comment_form( $comment_args );
    ?>

</div>
