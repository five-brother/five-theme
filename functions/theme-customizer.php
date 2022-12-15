<?php
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

Kirki::add_config(
	'fivebro_config',
	[
		'option_type' => 'theme_mod',
		'capability'  => 'manage_options',
	]
);

//添加面板
Kirki::add_panel('panel_id',array(
    'priority'    => 10,
    'title'       => '五弟主题选项',
    'description' => '主题选项的相关描述',
));

//添加组件
Kirki::add_section( 'section_id', array(
    'title'       => '通用',
    'description' => '通用组件的相关描述',
    'panel'       => 'panel_id',
    'priority'    => 160,
) );

//添加字段
Kirki::add_field('fivebro_theme',array(
	'type'			=> 'slider',
    'settings'    => 'custom_excerpt_length',
    'label'       => '摘要长度',
    'section'     => 'section_id',
    'default'     => 100,
    'choices'     => [
        'min'  => 0,
        'max'  => 200,
        'step' => 1,
    ],
) );


/* new \Kirki\Panel(
	'panel_id',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'My Panel', 'kirki' ),
		'description' => esc_html__( 'My Panel Description.', 'kirki' ),
	]
); */


//定制器中添加控件
// add_action('customize_register', 'my_customize_register');
/* function my_customize_register($wp_customize)
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
    )); */


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