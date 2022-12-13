<?php


//定制器中添加控件
add_action('customize_register', 'my_customize_register');
function my_customize_register($wp_customize)
{
    $wp_customize->add_setting('custom_excerpt_length');
    $wp_customize->add_control('custom_excerpt_length', array(
        'type' => 'range', //'text''checkbox''textarea''radio''select''dropdown-pages''email''url''number''hidden''date''range'
        'section' => 'title_tagline', //暂时放置在 站点身份 中
        'label' => '长度',
        'description' => '设置文章摘要的长度',
        'input_attrs' => array(
            'min' => 0,
            'max' => 200,
            'step' => 1,
        ),
    ));


    // 下面的代码用于参考
    /*     
function themename_customize_register($wp_customize){

    $wp_customize->add_section('themename_color_scheme', array(
        'title'    => __('Color Scheme', 'themename'),
        'description' => '',
        'priority' => 120,
    ));

    //  =============================
    //  = Text Input                =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[text_test]', array(
        'default'        => 'value_xyz',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('themename_text_test', array(
        'label'      => __('Text Test', 'themename'),
        'section'    => 'themename_color_scheme',
        'settings'   => 'themename_theme_options[text_test]',
    ));

    //  =============================
    //  = Radio Input               =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[color_scheme]', array(
        'default'        => 'value2',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control('themename_color_scheme', array(
        'label'      => __('Color Scheme', 'themename'),
        'section'    => 'themename_color_scheme',
        'settings'   => 'themename_theme_options[color_scheme]',
        'type'       => 'radio',
        'choices'    => array(
            'value1' => 'Choice 1',
            'value2' => 'Choice 2',
            'value3' => 'Choice 3',
        ),
    ));

    //  =============================
    //  = Checkbox                  =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[checkbox_test]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));

    $wp_customize->add_control('display_header_text', array(
        'settings' => 'themename_theme_options[checkbox_test]',
        'label'    => __('Display Header Text'),
        'section'  => 'themename_color_scheme',
        'type'     => 'checkbox',
    ));

    //  =============================
    //  = Select Box                =
    //  =============================
     $wp_customize->add_setting('themename_theme_options[header_select]', array(
        'default'        => 'value2',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'example_select_box', array(
        'settings' => 'themename_theme_options[header_select]',
        'label'   => 'Select Something:',
        'section' => 'themename_color_scheme',
        'type'    => 'select',
        'choices'    => array(
            'value1' => 'Choice 1',
            'value2' => 'Choice 2',
            'value3' => 'Choice 3',
        ),
    ));

    //  =============================
    //  = Image Upload              =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[image_upload_test]', array(
        'default'           => 'image.jpg',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'image_upload_test', array(
        'label'    => __('Image Upload Test', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'themename_theme_options[image_upload_test]',
    )));

    //  =============================
    //  = File Upload               =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[upload_test]', array(
        'default'           => 'arse',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'upload_test', array(
        'label'    => __('Upload Test', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'themename_theme_options[upload_test]',
    )));

    //  =============================
    //  = Color Picker              =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[link_color]', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label'    => __('Link Color', 'themename'),
        'section'  => 'themename_color_scheme',
        'settings' => 'themename_theme_options[link_color]',
    )));

    //  =============================
    //  = Page Dropdown             =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[page_test]', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('themename_page_test', array(
        'label'      => __('Page Test', 'themename'),
        'section'    => 'themename_color_scheme',
        'type'    => 'dropdown-pages',
        'settings'   => 'themename_theme_options[page_test]',
    ));

    // =====================
    //  = Category Dropdown =
    //  =====================
    $categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cats[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('_s_f_slide_cat', array(
		'default'        => $default
	));
	$wp_customize->add_control( 'cat_select_box', array(
		'settings' => '_s_f_slide_cat',
		'label'   => 'Select Category:',
		'section'  => '_s_f_home_slider',
		'type'    => 'select',
		'choices' => $cats,
	));
}

add_action('customize_register', 'themename_customize_register');






$wp_customize->add_setting('setting_id');
    $wp_customize->add_control('setting_id', array(
        'type' => 'text', //'text''checkbox''textarea''radio''select''dropdown-pages''email''url''number''hidden''date'
        'section' => 'colors',
        'label' => '我自定义的颜色',
        'description' => '我自定义的描述'
    ));


    $wp_customize->add_setting('default_thumbnail');
    $media_control = new WP_Customize_Media_Control(
        $wp_customize,
        'default_thumbnail', #setting/option_id
        [
            'mime_type' => 'image',
            'section' => 'colors',
            'label' => __('Label for control', 'domain'),
            'description' => __('Description for control', 'domain')
        ]
    );
    $wp_customize->add_control($media_control);
    $wp_customize->add_setting('color_control');
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_control', array(
        'label' => '全局背景颜色自定义',
        'section' => 'colors',
    ))); */
}


/* 
*制作五弟主题选项的具体样式和功能 
*/
add_action('admin_init', 'fivebro_admin_init');
function fivebro_admin_init()
{
    //注册设置项
    register_setting('fivebro-setting-group', 'fivebro-settings'); //以数组形式保存数据到数据库
    //添加一个组件到mypage页面
    add_settings_section('section-header', '头部区域设置', 'section_footer_callback', 'mypage');
    add_settings_section('section-footer', '底部区域设置', 'section_footer_callback', 'mypage');
    //添加字段到mypage页面的section-header组件中
    add_settings_field('field-head-code', '头部head区域添加(HTML)代码:', 'field_head_code_callback', 'mypage', 'section-header');


    //添加字段到mypage页面的section-footer组件中
    add_settings_field('field-footer-sitemap', '显示站点地图:', 'field_footer_sitemap_callback', 'mypage', 'section-footer');
    add_settings_field('field-footer-content', '底部区域添加内容(HTML):', 'field_footer_content_callback', 'mypage', 'section-footer');
    add_settings_field('field-footer-beian', '填写备案号:', 'field_footer_beian_callback', 'mypage', 'section-footer');
}
//组件section-footer显示的内容,显示在mypage页面中
function section_footer_callback()
{
}
//字段field-head-code显示的内容,显示在mypage页面中
function field_head_code_callback()
{
    $result = fivebro_get_option('field-head-code');
    echo "<textarea name='fivebro-settings[field-head-code]' cols='45' rows='8' maxlength='65525'>$result</textarea>";
}
//字段field-footer-sitemap显示的内容,显示在mypage页面中
function field_footer_sitemap_callback()
{
    $result = fivebro_get_option('field-footer-sitemap') ? "checked" : "";
    echo "<input class='field-footer-sitemap' type='checkbox' name='fivebro-settings[field-footer-sitemap]' $result>";
    echo "<span>在网站底部显示默认的站点地图链接</span>";
}
//字段field-footer-beian显示的内容,显示在mypage页面中
function field_footer_beian_callback()
{
    $result = fivebro_get_option('field-footer-beian');
    echo "<textarea name='fivebro-settings[field-footer-beian]' cols='45' rows='8' maxlength='65525'>$result</textarea>";
}
//字段field-footer-content显示的内容,显示在mypage页面中
function field_footer_content_callback()
{
    $result = fivebro_get_option('field-footer-content');
    echo "<textarea name='fivebro-settings[field-footer-content]' cols='45' rows='8' maxlength='65525'>$result</textarea>";
}


/* 后台添加页面 */
add_action('admin_menu', 'register_menu_page');
function register_menu_page()
{
    add_menu_page('主题选项', '五弟主题-选项', 'edit_theme_options', 'wudipage', 'menu_page_html');
    // add_submenu_page('wudipage', '子页面1标题', '子菜单1标题', 'edit_theme_options', 'wudi-submenu-page1', 'submenu_page_html', '1');
    // add_submenu_page('wudipage', '子页面2标题', '子菜单2标题', 'edit_theme_options', 'wudi-submenu-page2', 'submenu_page_html', '1');
    // add_options_page('设置菜单子页面1', '设置菜单子菜单1', 'edit_theme_options', 'options_submenu_page', 'options_submenu_page_html');
    // add_pages_page('子菜单页面3', '子菜单标题3', 'administrator', 'zicaidan3', 'page_3');
    // add_management_page('测试子菜单页面3', '测试子菜单标题3', 'administrator', 'zicaidan4', 'page_3');
}
//设计五弟主题选项页面的样式
function menu_page_html()
{
    echo '<form action="options.php" method="POST">';
    settings_fields('fivebro-setting-group');
    // 展示mypage页面
    do_settings_sections('mypage');
    //提交按钮
    submit_button();
    echo '</form>';
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

//后台顶部菜单添加按钮
/* add_action('admin_bar_menu', 'modify_admin_bar', 99);
function modify_admin_bar($wp_admin_bar)
{
    $wp_admin_bar->add_menu(array(
        'id' => 'custom-topmenu',
        'title' => '自定义顶部菜单',
        'href' => 'http://www.wudi.com/wp-admin/admin.php?page=wudi-submenu-page2'
    ));
} */



/* 读取五弟主题的设置项 */
function fivebro_get_option($info)
{
    $settings = get_option('fivebro-settings');
    $result = isset($settings[$info]) ? $settings[$info] : false;
    return stripslashes($result);
}
