<?php
// error_reporting(E_ALL ^ E_NOTICE);//镇魔石，镇压一切魑魅魍魉！

/**
 * 主题需要在4.7版本以上进行工作
 */
if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}

include(get_template_directory() . '/functions/widget.php');//创建自定义组件

/* 添加主题在线升级功能 ----自定义主题下载地址 */
/* require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'http://wudi.com/theme.json',//将这里的网址改成你的theme.json所在地的网址
	__FILE__, //Full path to the main plugin file or functions.php.
	'unique-plugin-or-theme-slug'
); */

//添加主题在线升级功能----github升级方式
require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/five-brother/five-theme',
	__FILE__,
	'unique-plugin-or-theme-slug'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

//Optional: If you're using a private repository, specify the access token like this:
$myUpdateChecker->setAuthentication('your-token-here');

//去除钩子中系统自带的函数
remove_action('wp_head', '_wp_render_title_tag', 1);
// remove_action('wp_head', 'wp_enqueue_scripts', 1 );//脚本排队功能
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
remove_action('wp_head', 'locale_stylesheet');
remove_action('wp_head', 'noindex', 1);
remove_action('wp_head', 'print_emoji_detection_script', 7);
// remove_action('wp_head', 'wp_print_styles', 8 );//打印CSS
// remove_action('wp_head', 'wp_print_head_scripts', 9 );//打印js
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_custom_css_cb', 101);
remove_action('wp_head', 'wp_site_icon', 99);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_generator');
remove_action('publish_future_post', 'check_and_publish_future_post', 10);
remove_action('wp_head', '_custom_logo_header_styles');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_enqueue_scripts', 'wp_localize_jquery_ui_datepicker', 1000);
remove_action('admin_enqueue_scripts', 'wp_localize_jquery_ui_datepicker', 1000);
remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');
remove_action('admin_enqueue_scripts', 'wp_common_block_scripts_and_styles');
remove_action('wp_print_styles', 'print_emoji_styles');

// remove_action( 'wp_default_scripts', 'wp_default_scripts' );
// remove_action( 'wp_default_scripts', 'wp_default_packages' );

// remove_action('wp_head', 'wp_post_preview_js', 1 );



/**
 * 排队加载CSS和JS文件
 */
function wpdocs_scripts_method()
{


    //引入bootstrap5
    wp_enqueue_style('bootstrap-css', 'https://cdn.staticfile.org/bootstrap/5.2.2/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.staticfile.org/bootstrap/5.2.2/js/bootstrap.min.js');
    //引入style.css
    wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css');
    //引入bootstrap图标库
    wp_enqueue_style('icons-css', get_template_directory_uri() . '/assets/css/icons-1.10.2/font/bootstrap-icons.css');
    //引入百度jQuery
    wp_enqueue_script('jquery-js', 'http://libs.baidu.com/jquery/2.1.4/jquery.min.js');
    //引入main.js文件
    wp_enqueue_script('main-script', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'wpdocs_scripts_method');

//注册菜单栏
register_nav_menus(
    array(
        'top'    => '头部菜单栏',
        'foot' => '底部菜单栏',
    )
);

// 注册侧边栏
// 自定义侧边栏
function my_custom_sidebar()
{
    register_sidebar(
        array(
            'name' => '五弟主题的侧边栏', //侧边栏名称
            'id' => 'custom-side-bar', //侧边栏ID
            'description' => '这里是侧边栏的描述', //侧边栏描述
            'before_widget'  => '<div id="%1$s" class="sidebar-widget %2$s">',
            'after_widget'   => "</div>\n",
            'before_title'   => '<h3 class="widget-title">',
            'after_title'    => "</h3>\n",
        )
    );
}
add_action('widgets_init', 'my_custom_sidebar');



//定制器中添加控件
add_action('customize_register', 'my_customize_register');
function my_customize_register($wp_customize)
{
    $wp_customize->add_setting('setting_id');
    $wp_customize->add_control('setting_id', array(
        'type' => 'text', //'text''checkbox''textarea''radio''select''dropdown-pages''email''url''number''hidden''date''text'
        'section' => 'colors',
        'label' => '我自定义的颜色',
        'description' => '我自定义的描述'
    ));

    $wp_customize->add_setting('color_control');
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_control', array(
        'label' => '全局背景颜色自定义',
        'section' => 'colors',
    )));
}


// 给菜单栏的li标签添加class
function addli_menu_classes($classes, $item, $args)
{
    if ($args->theme_location == 'top') { //这里的 top 是填写菜单别名
        $classes[] = 'nav-item col-12 col-md-auto'; //这里的 nav-item 是要添加的class类
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'addli_menu_classes', 10, 3);

// 给菜单栏的a标签添加class
function adda_menu_link_atts($atts, $item, $args)
{
    //所有菜单的a都添加nav-link
    $atts['class'] = 'nav-link';
    // 有子菜单时添加dropdown-toggle
    if (in_array('menu-item-has-children', $item->classes)) {
        $atts['class'] .= ' dropdown-toggle';
    }
    //菜单项有父菜单时,说明是子菜单,添加dropdown-item。$item->menu_item_parent用于获取父菜单的ID，为0时没有父菜单，不为0时说明有父菜单，则当前菜单为子菜单
    if ($item->menu_item_parent != '0') {
        $atts['class'] =  'dropdown-item';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'adda_menu_link_atts', 10, 3);

// 菜单项的class包含menu-item-has-children时,添加class选择器dropdown
function add_menu_li_class($classes, $item)
{
    if (in_array('menu-item-has-children', $classes)) {
        $classes[] = 'dropdown ';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_li_class', 10, 3);

//给子菜单的UL添加class
add_filter('nav_menu_submenu_css_class', 'add_submenu_ul_class', 10, 3);
function add_submenu_ul_class($classes, $item, $args)
{
    if (in_array('sub-menu', $classes)) {
        $classes[] = 'dropdown-menu';
    }
    return $classes;
}


//class中有current-menu-item时添加class选择器active
// add_filter('nav_menu_css_class' , 'add_menu_active_class' , 10 , 2);
// function add_menu_active_class($classes, $item){
//      if( in_array('current-menu-item', $classes) ){
//              $classes[] = 'active ';
//      }
//      return $classes;
// }









//后台添加页面
add_action('admin_menu', 'register_menu_page');
function register_menu_page()
{
    add_menu_page('页面标题2', '菜单标题2', 'edit_theme_options', 'wudipage', 'menu_page_html', '', '1');
    add_submenu_page('wudipage', '子页面1标题', '子菜单1标题', 'edit_theme_options', 'wudi-submenu-page1', 'submenu_page_html', '1');
    add_submenu_page('wudipage', '子页面2标题', '子菜单2标题', 'edit_theme_options', 'wudi-submenu-page2', 'submenu_page_html', '1');
    add_options_page('设置菜单子页面1', '设置菜单子菜单1', 'edit_theme_options', 'options_submenu_page', 'options_submenu_page_html');
    add_pages_page('子菜单页面3', '子菜单标题3', 'administrator', 'zicaidan3', 'page_3');
    add_management_page('测试子菜单页面3', '测试子菜单标题3', 'administrator', 'zicaidan4', 'page_3');
}
function menu_page_html()
{
    echo 11111111111;
}
function submenu_page_html()
{
    echo 222222;
}
function options_submenu_page_html()
{
    echo 33333;
}
function page_3()
{
    echo 444444;
}

//后台顶部添加按钮
add_action('admin_bar_menu', 'modify_admin_bar', 99);
function modify_admin_bar($wp_admin_bar)
{
    $wp_admin_bar->add_menu(array(
        'id' => 'custom-topmenu',
        'title' => '自定义顶部菜单',
        'href' => 'http://www.wudi.com/wp-admin/admin.php?page=wudi-submenu-page2'
    ));
}





//输出缩略图地址
function post_thumbnail_src()
{
    global $post;
    if ($values = get_post_custom_values("thumbnail")) { //输出自定义域图片地址
        $values = get_post_custom_values("thumbnail");
        $post_thumbnail_src = $values[0];
    } elseif (has_post_thumbnail()) { //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
        $post_thumbnail_src = $thumbnail_src[0];
    } else {
        $post_thumbnail_src = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        @$post_thumbnail_src = $matches[1][0]; //获取该图片 src
        if (empty($post_thumbnail_src)) {
            $post_thumbnail_src = get_bloginfo('template_url') . "/images/no-image.jpg"; //如果日志中没有图片，则显示默认图片
        }
    };
    echo $post_thumbnail_src;
}

// 获取文章的阅读次数
function get_post_views($post_id)
{

    $count_key = 'views';
    $count = get_post_meta($post_id, $count_key, true);

    if ($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        $count = '0';
    }

    echo number_format_i18n($count);
}
// 设置更新文章的阅读次数
function set_post_views()
{
    // echo 11111; 

    global $post;
    if (!isset($post)) {
        return;
    }
    $post_id = $post->ID;
    $count_key = 'views';
    $count = get_post_meta($post_id, $count_key, true);

    if (is_single() || is_page()) {

        if ($count == '') {
            delete_post_meta($post_id, $count_key);
            add_post_meta($post_id, $count_key, '0');
        } else {
            update_post_meta($post_id, $count_key, $count + 1);
        }
    }
}
add_action('get_header', 'set_post_views');

//点赞功能
add_action('wp_ajax_nopriv_bigfa_like', 'bigfa_like');
add_action('wp_ajax_bigfa_like', 'bigfa_like');
function bigfa_like()
{
    global $wpdb, $post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ($action == 'ding') {
        $bigfa_raters = get_post_meta($id, 'bigfa_ding', true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('bigfa_ding_' . $id, $id, $expire, '/', $domain, false);
        if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
            update_post_meta($id, 'bigfa_ding', 1);
        } else {
            update_post_meta($id, 'bigfa_ding', ($bigfa_raters + 1));
        }
        echo get_post_meta($id, 'bigfa_ding', true);
    }
    die;
}

// 使用国内头像源
if (!function_exists('get_cravatar_url')) {
    /**
     * 替换 Gravatar 头像为 Cravatar 头像
     *
     * Cravatar 是 Gravatar 在中国的完美替代方案，你可以在 https://cravatar.cn 更新你的头像
     */
    function get_cravatar_url($url)
    {
        $sources = array(
            'www.gravatar.com',
            '0.gravatar.com',
            '1.gravatar.com',
            '2.gravatar.com',
            'secure.gravatar.com',
            'cn.gravatar.com',
            'gravatar.com',
        );
        return str_replace($sources, 'cravatar.cn', $url);
    }
    add_filter('um_user_avatar_url_filter', 'get_cravatar_url', 1);
    add_filter('bp_gravatar_url', 'get_cravatar_url', 1);
    add_filter('get_avatar_url', 'get_cravatar_url', 1);
}
if (!function_exists('set_defaults_for_cravatar')) {
    /**
     * 替换 WordPress 讨论设置中的默认头像
     */
    function set_defaults_for_cravatar($avatar_defaults)
    {
        $avatar_defaults['gravatar_default'] = 'Cravatar 标志';
        return $avatar_defaults;
    }
    add_filter('avatar_defaults', 'set_defaults_for_cravatar', 1);
}
if (!function_exists('set_user_profile_picture_for_cravatar')) {
    /**
     * 替换个人资料卡中的头像上传地址
     */
    function set_user_profile_picture_for_cravatar()
    {
        return '<a href="https://cravatar.cn" target="_blank">您可以在 Cravatar 修改您的资料图片</a>';
    }
    add_filter('user_profile_picture_description', 'set_user_profile_picture_for_cravatar', 1);
}

// 自定义评论列表样式
function custom_comment($comment, $args, $depth)
{

    if ('div' === $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }

    $commenter          = wp_get_current_commenter();
    $show_pending_links = isset($commenter['comment_author']) && $commenter['comment_author'];

    if ($commenter['comment_author_email']) {
        $moderation_note = __('Your comment is awaiting moderation.');
    } else {
        $moderation_note = __('Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.');
    }
?>
    <!-- 这里添加了一个class -->
    <<?php echo $tag; ?> class="cutom-comment-item" id="comment-<?php comment_ID(); ?>">
        <?php if ('div' !== $args['style']) : ?>
            <div id="div-comment-<?php comment_ID(); ?>" class="d-flex comment-body">
            <?php endif; ?>
            <div class="comment-left">
                <div class="comment-avatar">
                    <?php
                    // 获取作者头像
                    if (0 != $args['avatar_size']) {
                        echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'img-thumbnail'));
                    }
                    ?>
                </div>
            </div>

            <div class="w-100">
                <div class="comment-author vcard">
                    <?php
                    $comment_author = get_comment_author_link($comment);

                    if ('0' == $comment->comment_approved && !$show_pending_links) {
                        $comment_author = get_comment_author($comment);
                    }

                    printf(
                        sprintf('<cite class="fn">%s</cite>', $comment_author)
                    );
                    ?>
                </div>
                <?php if ('0' == $comment->comment_approved) : ?>
                    <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
                    <br />
                <?php endif; ?>

                <div class="comment-text">
                    <?php
                    // 评论的内容
                    comment_text(
                        $comment,
                        array_merge(
                            $args,
                            array(
                                'add_below' => $add_below,
                                'depth'     => $depth,
                                'max_depth' => $args['max_depth']
                            )
                        )
                    );
                    ?>
                </div>
                <div class="d-flex justify-content-between comment-footer">
                    <div class="d-flex comment-meta commentmetadata ">
                        <?php
                        // 评论日期
                        comment_date('', $comment);
                        //评论回复按钮
                        comment_reply_link(
                            array_merge(
                                $args,
                                array(
                                    'add_below' => $add_below,
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before'    => '<div class="reply"> &nbsp;&nbsp;&nbsp;',
                                    'after'     => '&nbsp;</div>',
                                )
                            )
                        );
                        ?>
                    </div>


                    <div class="d-flex">
                        <?php
                        edit_comment_link('编辑', '&nbsp;', '&nbsp;'); //评论的 编辑 按钮


                        ?>
                    </div>
                </div>


                <?php if ('div' !== $args['style']) : ?>
            </div>
        <?php endif; ?>

            </div>
        <?php
    }
        ?>

<?php
// 评论ajax加载功能
add_action('wp_ajax_cloadmore', 'comments_loadmore_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_cloadmore', 'comments_loadmore_handler'); // wp_ajax_nopriv_{action}

function comments_loadmore_handler()
{
    global $post;
    $post = get_post($_POST['post_id']);
    setup_postdata($post);

    wp_list_comments(array(
        'callback' => 'custom_comment',
        'per_page' => get_option('comments_per_page'),
        'avatar_size' => 64,
        'page' => $_POST['cpage'],
        'style' => 'ul',
        'short_ping' => true,
    ));
    die;
}
?>