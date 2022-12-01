<?php
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="mt-2 p-4 bg-white comments-area ">

	<?php
	// 评论表单
	$req   = get_option('require_name_email');
	$html5 = true;
	$required_attribute = ($html5 ? ' required' : ' required="required"');
	$required_indicator = ' ' . wp_required_field_indicator();
	$commenter     = wp_get_current_commenter();

	$comments_args = array(
		'class_form' => 'row mt-3 pb-3 border comment-form', //form表单的class
		'title_reply_before'   => '<h3 id="reply-title" class="h5 px-2 comment-reply-title">',
		'title_reply_after'    => '</h3>',
		'fields' => array(
			'author' => sprintf(
				'<div class="col-md-4 p-2"><p class="input-group comment-form-author">%s %s</p></div>',
				sprintf(
					'<label class="input-group-text" for="author">%s%s</label>',
					'昵称',
					($req ? $required_indicator : '')
				),
				sprintf(
					'<input class="form-control" id="author" name="author" type="text" value="%s" size="30" maxlength="245" autocomplete="name"%s />',
					esc_attr($commenter['comment_author']),
					($req ? $required_attribute : '')
				)
			),
			'email'  => sprintf(
				'<div class="col-md-4 p-2"><p class="input-group comment-form-email">%s %s</p></div>',
				sprintf(
					'<label class="input-group-text" for="email">%s%s</label>',
					'邮箱',
					($req ? $required_indicator : '')
				),
				sprintf(
					'<input class="form-control" id="email" name="email" %s value="%s" size="30" maxlength="100" aria-describedby="email-notes" autocomplete="email"%s />',
					'type="email"',
					esc_attr($commenter['comment_author_email']),
					($req ? $required_attribute : '')
				)
			),
			'url'    => sprintf(
				'<div class="col-md-4 p-2"><p class="input-group comment-form-url">%s %s</p></div>',
				sprintf(
					'<label class="input-group-text" for="url">%s</label>',
					'网址'
				),
				sprintf(
					'<input class="form-control" id="url" name="url" %s value="%s" size="30" maxlength="200" autocomplete="url" />',
					'type="url"',
					esc_attr(wp_get_current_commenter()['comment_author_url'])
				)
			),
		),
		'label_submit' => '提交评论',
		'title_reply' => '发表评论',
		'comment_field'        => sprintf(
			'<div class="col-12 my-3"><p class="input-group comment-form-comment">%s %s</p></div>',
			sprintf(
				'<label class="input-group-text" for="comment">%s%s</label>',
				'评论内容',
				$required_indicator
			),
			'<textarea class="form-control comment-textarea" id="comment" name="comment" cols="45" rows="8" maxlength="65525"' . $required_attribute . '></textarea>'
		),
		'submit_field' => '<p class="text-end form-submit">%1$s %2$s</p>',
		'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="btn %3$s" value="%4$s" />'
	);
	comment_form($comments_args);

	//评论列表
	if (have_comments()) :
		// 评论列表的标题
		$comment_count = get_comments_number();
		printf('<h3 class="h5 mt-4 comments-title">评论列表( %s 条)</h3>', $comment_count);
	?>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'callback' => 'custom_comment',
					'style'      => 'ul',
					'short_ping' => true,
					'avatar_size'       => 64,

				)
			);
			?>
		</ol><!-- .comment-list -->
		<div class="text-center load-more-comment">
			<?php
			// 加载更多评论
			$cpage = get_query_var('cpage') ? get_query_var('cpage') : 1;

			if ($cpage > 1) {
				echo '<div class="comment_loadmore">加载更多评论</div>
	<script>
	var ajaxurl = \'' . site_url('wp-admin/admin-ajax.php') . '\',
	    parent_post_id = ' . get_the_ID() . ',
    	    cpage = ' . $cpage . '
	</script>';
			}
			?>
		</div>
	<?php
	endif;
	?>

</div><!-- #comments -->
