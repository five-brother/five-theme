</div><!-- .row -->
</div><!-- .container-xxl -->

<!-- 底部区域 -->
<div class="footer">
    底部区域
    <?php

    $settings = get_option('fivebro-settings');
    $beian = isset($settings['beian']) ? esc_attr($settings['beian']) : "";

    if ($beian) {
        echo '<a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow"> ' . $beian . '</a>';
    }

    ?>
<span>
 | Theme By <a href="https://www.555d.cn" target="_blank">五弟</a>
</span>

</div>
</div><!-- .wrap -->

</body>

</html>