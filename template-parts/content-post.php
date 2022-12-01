<main class="col-md-8 p-0">

    <article class='entry'>
        <div class="bg-white">
            <div class=" site-main p-4">
                <h1 class="entry-title">
                    <?php the_title(); ?>
                </h1>

                <div class="d-flex flex-wrap my-2 entry-info">
                    <!-- 显示文章作者 -->
                    <div class="bi bi-person p-2 post-author">
                        <?php the_author_link() ?>
                    </div>
                    <!-- 显示文章的分类目录 -->
                    <div class='bi bi-folder p-2 muted'>
                        <?php the_category(','); ?>
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

                    <!-- 显示编辑按钮 -->
                    <?php edit_post_link(' 编辑','','','','bi bi-pencil-square p-2 muted'); ?>

                </div>

                <div>
                    <?php the_content(); ?>
                </div>
            </div>
            <?php
            // 分页阅读
            wp_link_pages(array(
                'before' => '<div class="fenye my-3 p-2 bg-light">分页阅读： ',
                'after' => '</div>',
                'next_or_number' => 'next',
                'previouspagelink' => '<span class="fenye-link fenye-pre p-2">上一页</span>',
                'nextpagelink' => '<span class="fenye-link fenye-next p-2">下一页</span>'
            ));
            ?>
        </div>




        <!-- 文章导航 -->
        <div class=" bg-zise mt-2">
        <div class="row p-3">
            <div class="col-6 pre-post">
                <?php
                previous_post_link('%link', '上一篇: %title');
                ?>
            </div>

            <div class="col-6 text-end next-post">
                <?php
                next_post_link('%link', '下一篇: %title');
                ?>
            </div>
        </div>
        </div>

        <?php
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>




    </article>
</main>