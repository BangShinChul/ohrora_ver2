<script type="text/javascript">
    $(document).ready(function(){
        $('#search_btn').click(function(){
            if($("#search").val() == ''){
                alert('검색어를 입력하세요');
                return false;
            }else{
                var act = "/index.php/board/board_lists/search/" + $("#search").val() + "/page/1";
                $("#bd_search").attr('action',act).submit();
            }
        });
    });

    function board_search_enter(form){
        var keycode = window.event.keyCode;
        if(keycode == 13){
            $('#search_btn').click();
        }
    }
</script>

<article id="board_area">
    <header>
        <h1></h1>
    </header>
    <h1></h1>
    <table cellpadding="0" cellspacing="0" border="1">
        <thead>
            <tr>
                <th scope="col">번호</th>
                <th scope="col">제목</th>
                <th scope="col">작성자</th>
                <th scope="col">조회수</th>
                <th scope="col">댓글수</th>
                <th scope="col">작성일</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $c = 0;
foreach($list as $lt)
{
           ?>

            <tr>
                <th scope="row"><?php echo $lt -> board_id;?></th>
                <td><a rel="external" href="/index.php/<?php echo $this -> uri -> segment(1); ?>/view/<?php echo $lt -> board_id; ?>"> <?php echo $lt -> subject;?></a></td>
                <td><?php echo $lt -> user_name; ?></td>
                <td><?php echo $lt -> hits; ?></td>
                <td><?php echo $lt -> comments; ?></td>
                <td>
                <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt -> reg_date)); ?>">
                    <?php echo mdate("%Y-%M-%j", human_to_unix($lt -> reg_date));?>
                </time></td>
            </tr>
            <?php
            $c++;
            }
           ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" style="border:1px solid #fff; border-top:1px solid #000;"><?php echo $pagination; ?></th>
            </tr>
            <tr>
                <td colspan="5" style="border:1px solid #fff;">
                    
                    <?php 
                        if(@$this->session->userdata('logged_in') == TRUE) :
                    ?>
                    <a href="/index.php/board/board_write/" class="btn btn-success">글쓰기</a>
                    <?php
                        else : 
                    ?>
                    게시글을 작성하시려면 <a href="/index.php/auth/get_login">로그인</a>이 필요합니다.</th>
                    <?php endif; ?>
                </td>
            </tr>
        </tfoot>
    </table>
    <div>
        <form id="bd_search" method="post">
            <input type="hidden" id="<?php echo $this->security->get_csrf_token_name(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
            <input type="text" name="search_word" id="search" onkeypress="board_search_enter(document.search);" />
            <input type="button" value="검색" id="search_btn" />
        </form>
    </div>
</article>
