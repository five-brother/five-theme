</div><!-- .row -->
</div><!-- .container-xxl -->

<!-- 底部区域 -->
<div class="footer p-3">

    <?php
    /* 输出底部区域自定义的内容 */
    echo "<span class='field-footer-content'>" . fivebro_get_option('field-footer-content') . "</span>";
    /* 输出底部区域备案号 */

    if (fivebro_get_option('field-footer-beian')) {
        echo '<span class="field-footer-beian"><a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow"> ' . fivebro_get_option('field-footer-beian') . '</a></span>';
    }
    //输出底部站点地图
    if (fivebro_get_option('field-footer-sitemap')) {
        echo " | <a href=" . home_url("/wp-sitemap.xml") . ">站点地图</a>";
    }
    ?>


    <span>
        | Theme By <a href="https://www.555d.cn" target="_blank">五弟</a>
    </span>

</div>
</div><!-- .wrap -->

<?php wp_footer(); ?>
<!-- 数据库<?php echo get_num_queries(); ?>次查询 | 用时：<?php timer_stop(1, 7) ?>秒 | 消耗了：<?php echo memory_get_peak_usage() / 1024 / 1024; ?>MB 内存-->
</body>

</html>
