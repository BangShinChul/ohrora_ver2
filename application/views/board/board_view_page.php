<script type="text/javascript" src="/static/js/httpRequest.js"></script>
<script>
$(document).ready(function(){
    $('#comment_submit').click(function(){
        $.ajax({
            url: '/index.php/board_comment/ajax_comment_add',
            type: 'POST',
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'comment_contents': encodeURIComponent($('#input01').val()),
                'board_id': '<?php echo $this->uri->segment(3); ?>'
            },
            dataType: 'html',
            complete: function(xhr, textStatus){
                if(textStatus == 'success'){
                    if(xhr.responseText == 1000){
                        alert('댓글 내용을 입력하세요.');
                    }else if(xhr.responseText == 2000){
                        alert('댓글을 다시 업력해주세요.');
                    }else if(xhr.responseText == 9000){
                        alert('댓글을 입력하시려면 로그인이 필요합니다.');
                    }else{
                        $('#comment_area').html(xhr.responseText);
                        $('#input01').val('');
                    }
                }
            }
        })
    });

});    

</script>


<article id="board_area">
    <header>
        <h1></h1>
    </header>
    <table cellspacing="0" cellpadding="0" class="table table-striped">
        <thead>
            <tr>
                <th scope="col"><?php echo $views -> subject;?></th>
                <th scope="col">작성자: <?php echo $views -> user_name;?>(<?php echo $views -> user_id;?>)</th>
                <th scope="col">조회수: <?php echo $views -> hits;?></th>
                <th scope="col">등록일: <?php echo $views -> reg_date;?><?php if($views->board_status == '1') : ?>(수정됨)<?php endif; ?>

                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th colspan="4">
                    <?php echo $views -> contents;?>
                </th>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">
                    <a href="/index.php/board/board_lists" class="btn btn-primary">목록 </a>

                    <?php 
                        if( (@$this->session->userdata('logged_in') == TRUE && $this->session->userdata('user_id') == $views -> user_id) || (@$this->session->userdata('logged_in') == TRUE && $this->session->userdata('user_id') == 'admin') ) :
                    ?>
                    <a href="/index.php/board/board_modify/<?php echo $this -> uri -> segment(3);?>" class="btn btn-warning"> 수정 </a>
                    <a href="/index.php/board/board_delete/<?php echo $this -> uri -> segment(3);?>" class="btn btn-danger"> 삭제 </a>
                    <?php endif; ?>
                </th>
            </tr>
        </tfoot>
    </table>

    <?php 
    if(@$this->session->userdata('logged_in') == TRUE) :
    ?>
    <form class="form-horizontal" method="POST" action="" name="comment_add">
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="input01">댓글</label>
                <div class="controls">
                    <textarea class="input-xlarge" id="input01" name="comment_contents" rows="3" placeholder="contents"></textarea><br>
                    <input type="button" id="comment_submit" class="btn btn-primary" value="작성"/>
                    <p class="help-block"></p>
                </div>
            </div>
        </fieldset>
    </form>
    <?php
    else :
    ?>
    댓글을 작성하시려면 <a href="/index.php/auth/get_login">로그인</a>이 필요합니다.
    <?php 
    endif;
    ?>
    <p>댓글 <?php echo $views -> comments; ?></p>
    <div id="comment_area">
        <table cellpadding="0" cellspacing="0" class="table table-striped">
            <tbody>
                <?php 
                if(isset($comment_list)){
                    foreach ($comment_list as $lt) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $lt->user_id; ?></th>
                        <td><?php echo $lt->comment_contents; ?></td>
                        <td>
                            <?php 
                            if( (@$this->session->userdata('logged_in') == TRUE && $this->session->userdata('user_id') == $lt->user_id) || (@$this->session->userdata('logged_in') == TRUE && $this->session->userdata('user_id') == 'admin') ) :
                            ?>
                            <a href="/index.php/board_comment/ajax_comment_delete/<?php echo $this -> uri -> segment(3);?>" class="btn btn-warning"> 수정 </a>
                            <a href="/index.php/board_comment/ajax_comment_delete/<?php echo $this -> uri -> segment(3);?>" class="btn btn-danger"> 삭제 </a>
                            <?php endif; ?>
                        <td>
                            <time datatime="<?php echo mdate('%Y-%M-%J',human_to_unix($lt->reg_date)); ?>">
                                <?php echo $lt->reg_date; ?>
                            </time>
                        </td>
                    </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</article>
