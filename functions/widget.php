<?php

/**
 * 类 WPDocs_New_Widget 创建一个新组件(小工具)
 */
class WPDocs_New_Widget extends WP_Widget
{

    /**
     * 新组建的构造函数
     *
     * @see WP_Widget::__construct()
     */
    function __construct()
    {
        // Instantiate the parent object.
        parent::__construct(false, '五弟-相同分类文章列表');
    }

    /**
     * 输出HTML内容
     */
    function widget($args, $instance)
    {
        //显示文章的分类列表
        $category = get_the_category(); //获取文章所属分类的信息,返回数组
        if (isset($category[0]) && $category[0]) {
            $posts = get_posts(array(
                'category' => $category[0]->cat_ID, //显示哪个分类下的文章
                'numberposts' => 10, //显示的文章数量
            ));
            if (!empty($posts)) {
                echo "<div class='sidebar-widget'>";
                echo "<div class='bd-callout bd-callout-warning'><h3>你可能感兴趣的文章：</h3></div>";
                echo "<ul class='p-2'>";
                foreach ($posts as $post2) {
?>
                    <li class="single-posts-li">
                        <div>
                            <a class="text-black" title="<?php echo $post2->post_title; ?>" href="<?php echo get_permalink($post2->ID); ?>"><?php echo $post2->post_title; ?></a>
                        </div>
                        <div class="muted">
                            <?php echo get_the_time('Y-m-d'); ?>
                        </div>
                    </li>
<?php
                }
                echo "</ul></div>";
            }
        }
    }
}


/**
 * 注册新组件
 *
 * @see 'widgets_init'
 */
function wpdocs_register_widgets()
{
    register_widget('WPDocs_New_Widget');
}
add_action('widgets_init', 'wpdocs_register_widgets');

?>
