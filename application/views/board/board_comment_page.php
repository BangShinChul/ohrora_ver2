
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
                <a id="comment_modify" data-pk="<?php echo $lt->comment_pk; ?>" href="#" class="btn btn-warning" click="modifyComment();"> 수정 </a>
                <a id="comment_delete" data-pk="<?php echo $lt->comment_pk; ?>" href="#" class="btn btn-danger" click="deleteComment();"> 삭제 </a>
            <?php 
            endif; 
            ?>
            <td>
                <time datatime="<?php echo mdate('%Y-%M-%J',human_to_unix($lt->reg_date)); ?>">
                    <?php echo $lt->reg_date; ?>
                </time>
            </td>
        </tr>
    <?php
        }
    }else{
        echo "this uri segment(3) : ".$this->uri->segment(3);
        echo "댓글이 없습니다.";
    }
    ?>
    </tbody>
</table>