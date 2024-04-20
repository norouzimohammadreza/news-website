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
                        <!-- Start latest-post Area -->
                        <div class="latest-post-wrap">
                            <h4 class="cat-title">آخرین اخبار</h4>
                        <?php foreach ($lastPosts as $lastPost) { ?>
                            <div class="single-latest-post row align-items-center">
                                <div class="col-lg-5 post-left">
                                    <div class="feature-img relative">
                                        <div class="overlay overlay-bg"></div>
                                        <img class="img-fluid" src="<?= asset($lastPost['image']) ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-7 post-right">
                                    <a href="image-post.html">
                                        <h4><?=$lastPost['title'] ?></h4>
                                    </a>
                                    <ul class="meta">
                                        <li><a href=""><span class="lnr lnr-user"></span><?=$lastPost['username'] ?></a></li>
                                        <li><a href="#"><?=$lastPost['created_time'] ?><span class="lnr lnr-calendar-full"></span></a></li>
                                        <li><a href="#"> <?=$lastPost['comment_count'] ?><span class="lnr lnr-bubble"></span></a></li>
                                    </ul>
                                    <p class="excert">
                                    <?= substr($lastPost['summary'],0,120) ?>
                                    </p>
                                </div>
                            </div>
                            <?php  } ?>
                        </div>
                        <!-- End latest-post Area -->

                        <!-- Start banner-ads Area -->
                        <div class="col-lg-12 ad-widget-wrap mt-30 mb-30">
                            <img class="img-fluid" src="<?= asset($bodyBanner['image']) ?>" alt="">
                        </div>
                        <!-- End banner-ads Area -->
                        
                      
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