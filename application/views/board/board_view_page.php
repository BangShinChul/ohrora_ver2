<script type="text/javascript" src="/static/js/httpRequest.js"></script>
<script>
    function modifyComment(){
        alert("modify comment");
    }


    function deleteComment(){
        alert("delete comment");
    }

</script>

<script>
$(document).ready(function(){    

    //해당 게시글의 comment가 있는지 확인 후 jquery load로 댓글들을 가져옴
    //$('#comment_area').load('index.php/board/test');
    
    function comment_refresh(){
        $.ajax({
            url: '/index.php/board_comment/ajax_comment_get',
            type: 'POST',
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'board_id': '<?php echo $this->uri->segment(3); ?>'
            },
            dataType: 'html',
            success: function(data){
                $('#comment_area').html(data);
                // var auto_refresh = setInterval(function(){
                //     $('#comment_area').html(data);
                // }, 3000);
            },
            error: function(){
                alert("comment error");
            }
        })
    }

    //comment_refresh();

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
            success: function(data){
                alert("success : "+data);
            },
            error: function(error){
                alert("error : "+error);
            },
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





    // 이건 완벽하게 됨
    // $("#comment_modify").click(function(){

    //     var s = $("#comment_modify").attr('data');

    //     if(s==null){
    //         $("#comment_modify").html('수정완료');
    //         $("#comment_modify").attr('data','comment_modify_success');
            
    //         $("#comment_delete").html('취소');
    //         $("#comment_delete").attr('data','comment_modify_cancel');
    //         alert("댓글 수정");
    //     }else{
    //         if(s=='comment_modify_success'){
    //             alert("댓글 수정 완료");
    //             $("#comment_modify").html('수정');
    //             $("#comment_modify").removeAttr('data','comment_modify_success');
            
    //             $("#comment_delete").html('삭제');
    //             $("#comment_delete").removeAttr('data','comment_modify_cancel');
    //         }
    //     }
        
    // });

    // $("#comment_delete").click(function(){

    //     var c = $("#comment_delete").attr('data');
        
    //     if(c==null){
    //         alert("댓글 삭제");
    //     }else{
    //         if(c=='comment_modify_cancel'){
    //             $("#comment_modify").html('수정');
    //             $("#comment_modify").removeAttr('data','comment_modify_success');
            
    //             $("#comment_delete").html('삭제');
    //             $("#comment_delete").removeAttr('data','comment_modify_cancel');
    //             alert("수정 취소, 댓글 삭제버튼으로 변경");
    //         }
    //     }
    // });

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

    </div>
</article>
