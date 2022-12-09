jQuery(function ($) {
    //文章点赞
$.fn.postLike = function () {
    if ($(this).hasClass('done')) {
        return false;
    } else {
        $(this).addClass('done');
        var id = $(this).data("id"),
            action = $(this).data('action'),
            rateHolder = $(this).children('.count');
        var ajax_data = {
            action: "bigfa_like",
            um_id: id,
            um_action: action
        };
        $.post("/wp-admin/admin-ajax.php", ajax_data, function (data) {
            $(rateHolder).html(data);
        });
        return false;
    }
};
$(document).on("click", ".favorite", function () {
    $(this).postLike();
});


// 加载评论
    //加载更多按钮点击事件 
    $('.comment_loadmore').click(function () {
        var button = $(this);
        //减少当前评论页面的值 
        button.text(cpage);
        cpage = cpage - 1;
        $.ajax({
            url: ajaxurl,
            data: {
                'action': 'cloadmore',
                'post_id': parent_post_id,//当前文章
                'cpage': cpage,//当前评论页
            },
            type: 'POST',
            beforeSend: function (xhr) {
                button.text('加载中...');
            },
            success: function (data) {
                if (data) {
                    $('ol.comment-list').append(data);
                    button.text('加载更多');
                    //如果最后一页，则删除按钮
                    if (cpage == 1)
                        button.remove();
                } else {
                    button.remove();
                }
            }
        });
        return false;
    });

});


