<?php
$categories = get_the_category();
if (!empty($categories)) :
?>
<article class='border-bottom py-3'>
    <div class='row'>
        <div class="col-5 col-lg-3">
            <img class="img-thumbnail" src="<?php post_thumbnail_src();  ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
        </div>

        <!-- 所有行 -->
        <div class="col-7 col-lg-9 row">
            <!-- 前两行 -->
            <div class="p-2">

                <!-- 第一行 -->
                <div class="lh-lg">
                    <div class=" cat-div d-inline">
                        <?php
                        //输出分类目录
                            echo '<a class="d-inline-block px-2" href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
                        ?>
                        <i></i>
                    </div><!-- cat-link end -->
                    <?php
                    the_title('<h2 class="d-inline p-2 h4"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
                    ?>
                </div><!-- row-cols-auto end -->


                <div class="py-2">
                    <?php the_excerpt(); ?>
                </div>
            </div>

            <div class="align-self-end d-flex entry-info flex-wrap">
                <!-- 显示文章作者 -->
                <div class="bi bi-person-fill p-2 muted">
                    <?php the_author_link() ?>
                </div>
                <!-- 显示文章发布时间 -->
                <div class='bi bi-alarm p-2 muted'>
                    <?php echo get_the_time('Y-m-d'); ?>
                </div>
                <!-- 显示文章评论总数 -->
                <div class="bi bi-chat-dots p-2 muted">
                    <?php echo get_comment_count($post->ID)['approved']; ?>
                </div>
                <!-- 显示文章的阅读次数 -->
                <div class='bi bi-eye p-2 muted'>
                    <?php get_post_views($post->ID); ?>
                </div>



                <a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if (isset($_COOKIE['bigfa_ding_' . $post->ID])) echo ' done'; ?> bi bi-heart p-2 text-danger"><span class="count">
                        <?php if (get_post_meta($post->ID, 'bigfa_ding', true)) {
                            echo get_post_meta($post->ID, 'bigfa_ding', true);
                        } else {
                            echo '0';
                        } ?></span>个赞
                </a>

                <?php edit_post_link(' 编辑', '', '', '', 'bi bi-pencil-square p-2 muted'); ?>

            </div>
        </div>
    </div>
</article>

<?php
endif
?>