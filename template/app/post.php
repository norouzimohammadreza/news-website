<?php
  require_once (BASE_PATH .'/template/app/layout/header.php');
?>
    <div class="site-main-container">
        <!-- Start top-post Area -->
        <!-- End top-post Area -->
        <!-- Start post Area -->
        <section class="latest-post-area pb-120">
            <div class="container no-padding">
                <div class="row">
                    <div class="col-lg-8 post-list">
                        <!-- Start single-post Area -->
                        <div class="single-post-wrap">
                            <div class="feature-img-thumb relative">
                                <div class="overlay overlay-bg"></div>
                                <img class="img-fluid" src="<?= asset($post['image'])?>" alt="">
                            </div>
                            <div class="content-wrap">
                                <ul class="tags mt-10">
                                    <li><a href="#"><?= $post['cat_title']?></a></li>
                                </ul>
                                    <h3><?= $post['title'] ?></h3>
                                <ul class="meta pb-20">
                                    <li><a href="#"><span class="lnr lnr-user"></span>ادمین</a></li>
                                    <li>۱۳۹۹/۲۲/۳۳<span class="lnr lnr-calendar-full"></span></li>
                                    <li>۴<span class="lnr lnr-bubble"></span></li>
                                </ul>
                                <!-- main body -->
                            <div>
                                <?= $post['summary'] ?>
                                <hr>
                                <?= $post['body'] ?>
                            </div>
                                <div class="navigation-wrap justify-content-between d-flex">
                                    <a class="prev" href="#"><span class="lnr lnr-arrow-right"></span>خبر بعدی</a>
                                    <a class="next" href="#">خبر قبلی<span class="lnr lnr-arrow-left"></span></a>
                                </div>
                                <?php if(!empty($comments)){ ?>
                                <div class="comment-sec-area">
                                    <div class="container">
                                        <div class="row flex-column">
                                            <h6>نظرات</h6>
                                            <div class="comment-list">
                                                <?php foreach ($comments as $comment) {?>
                                                <div class="single-comment justify-content-between d-flex">
                                                    <div class="user justify-content-between d-flex">

                                                        <div class="desc">
                                                            <h5><a href="#"><?= $comment['username'] ?></a></h5>
                                                            <p class="date mt-3"><?= jalaliData( $comment['created_time']) ?></p>
                                                            <p class="comment">
                                                            <?= $comment['body'] ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>
                            </div>
                            <?php if(isset($_SESSION['user'])){ ?>
                            <div class="comment-form">
                                <h4>درج نظر جدید</h4>
                                <form method="POST" action="<?= url('comment'.'/'.$post['id']) ?>">
                                    <div class="form-group">
                                        <textarea class="form-control mb-10" rows="5" name="body" placeholder="متن نظر" onfocus="this.placeholder = ''" onblur="this.placeholder = 'متن نظر'" required=""></textarea>
                                    </div>
                                    <input type="submit" class="primary-btn text-uppercase" value="ارسال">
                                </form>
                            </div>
                            <?php }else{ ?>
                                <h4>لطفا وارد اکانت خود شوید.</h4>
                                <?php } ?>
                        </div>
                        <?php
                    require_once (BASE_PATH .'/template/app/layout/sidebar.php');
                    ?>
                    </div>
                </div>
                
            </div>
                  
        </section>
        <!-- End latest-post Area -->
        
    </div>
<?php
 require_once (BASE_PATH .'/template/app/layout/footer.php');
       ?>