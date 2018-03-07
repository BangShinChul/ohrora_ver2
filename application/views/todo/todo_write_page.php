        <div id="main">
            <header id="header" data-role="header" data-position="fixed">
                <blockquote>
                    <p>
                        만들면서 배우는 CodeIgniter
                    </p>
                    <small>실행 예제</small>
                </blockquote>
            </header>
 
            <nav id="gnb">
                <ul>
                    <li>
                        <a rel="external" href="/index.php/todo/">todo 애플리케이션 프로그램</a>
                    </li>
                </ul>
            </nav>
            <article id="board_area">
                <header>
                    <h1>Todo 쓰기</h1>
                </header>
                <?php echo validation_errors(); ?>
                <form class="form-horizontal" method="post" action="" id="write_action">
                    <input type="hidden" id="<?php echo $this->security->get_csrf_token_name(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="input01">내용</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="input01" name="content">
                                <p class="help-block"></p>
                            </div>
                            <label class="control-label" for="input02">시작일</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="input02" name="created_on" placeholder="YYYY-MM-DD">
                                <p class="help-block"></p>
                            </div>
                            <label class="control-label" for="input03">종료일</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="input03" name="due_date"  placeholder="YYYY-MM-DD">
                                <p class="help-block"></p>
                            </div>
 
                            <div class="form-actions">
                                <input type="submit" class="btn btn-success" id="write_btn" value="작성" />
                                <a href="/index.php/todo/" class="btn btn-primary">뒤로가기</a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </article>
 
            <footer>
                <blockquote>
                    <p>
                        <a class="azubu" href="http://www.cikorea.net/" target="blank">CodeIgniter 한국 사용자 포럼</a>
                    </p>
                    <small>Copyright by <em class="black"><a href="mailto:zhfldi4@gmail.com">Palpit</a></em></small>
                </blockquote>
            </footer>
        </div>