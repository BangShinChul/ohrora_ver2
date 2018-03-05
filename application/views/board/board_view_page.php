<article id="board_area">
    <header>
        <h1></h1>
    </header>
    <table cellspacing="0" cellpadding="0" class="table table-striped">
        <thead>
            <tr>
                <th scope="col"><?php echo $views -> subject;?></th>
                <th scope="col">이름: <?php echo $views -> user_name;?></th>
                <th scope="col">조회수: <?php echo $views -> hits;?></th>
                <th scope="col">등록일: <?php echo $views -> reg_date;?></th>
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
                        if( (@$this->session->userdata('logged_in') == TRUE && $this->session->userdata('user_id') == $views -> user_name) || (@$this->session->userdata('logged_in') == TRUE && $this->session->userdata('user_id') == 'admin') ) :
                    ?>
                    <a href="/index.php/board/board_modify/<?php echo $this -> uri -> segment(3);?>" class="btn btn-warning"> 수정 </a>
                    <a href="/index.php/board/board_delete/<?php echo $this -> uri -> segment(3);?>" class="btn btn-danger"> 삭제 </a>
                    <?php endif; ?>
                </th>
            </tr>
        </tfoot>
    </table>
</article>
