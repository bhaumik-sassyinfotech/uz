<div class="main-content full">
    <div class="uz-wrap full uz-list-page">
        <div class="Website-add-sec full">
            <div class="container-fluid">
                <div class="ad full">
                    <span class="adtext">WEBSITES</span>
                    <p>Choose Your Appropriate Type & Ad Spots</p>
                </div>

            </div>
        </div>

        <div class="uz-lp-black-strip full">
            <div class="container">
                <div class="sort-form-wrap full">
                    <form class="sort-form full" action="<?php base_url('website');?>" method="get">
                        <div class="sort-form-main full">
                            <div class="sort-form-col">

                                <div class="sort-form-row full">
                                    <div class="sort-form-row-col">
                                        <img src="<?php echo IMAGE_PATH; ?>sort.png" alt="uz-img">
                                    </div>
                                    <div class="sort-form-row-col">
                                        <label class="label ">Sort By:</label>
                                    </div>
                                    <div class="select-arrow sort-form-row-col">
                                        <select name="sort" id="" class="form-control select-arrow">
                                            <option value="">Select Sorting Option</option>
                                            <option <?php if(isset($_GET['sort'] ) && $_GET['sort'] === "latest") echo "selected"; ?> value="latest">Latest </option>
                                            <option <?php if(isset($_GET['sort'] ) && $_GET['sort'] === "alpha") echo "selected"; ?> value="alpha">A-Z</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="sort-form-col">
                                <div class="sort-form-row full">
                                    <div class="search-form-row-col">
                                        <img src="<?php echo IMAGE_PATH; ?>search.png" alt="uz-img" >
                                    </div>
                                    <div class="search-form-row-col">
                                        <input name="search" id="search" class="form-control required" placeholder="Search here" type="text" value="<?php echo @$_GET['search']; ?>">
                                        <button type="submit" class="btn "><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>



        </div>

        <div class="uz-all-list full">
            <ul class="listing full">
                <!--PHP foreach LOOP-->
                <?php
//                echo "<pre>"; print_r($websiteData);die;
                if (empty($websiteData))
                {
                    ?>
                    <li class="full listing-col">
                            <div class="listing-main full">
                                <div class="col-md-12 center no-content" data-aos="fade-down-right">
                                    <h1>No website is there yet. </h1>
                                </div>
                            </div>
                    </li>
                <?php
                } else {
                    foreach ($websiteData as $key => $web) { ?>
                        <li class="full listing-col">
                            <div class="listing-main full">
                                <div class="listing-main-img aos-init aos-animate" data-aos="fade-down-right">
                                    <img src="<?php echo UPLOAD_URL; ?>website/<?php echo @$web['web_image']; ?>" alt="uz-img">
                                </div>


                                <div class="listing-main-content">
                                    <div class="listing-main-content-hd full  aos-init aos-animate" data-aos="zoom-in-left">
                                        <div class="title full">
                                            <h2 class=""><?php echo @$web['web_name']; ?></h2> <span>- <?php echo @$web['web_sdesc']; ?></span>
                                        </div>
                                        <div class="price full">
                                            <div class="price-col">
                                                <span>Ad Price Starts From:</span>
                                            </div>
                                            <div class="price-col">
                                                <ul>
                                                    <li>
                                                        <span>Hourly- </span> <span class="num"><?php
                                                            $hourly = $web['minPrice']['min_hourly'];
                                                            echo CURRENCY . number_format($hourly, 2, '.', ','); ?>
                                                    </span>
                                                    </li>
                                                    <li>
                                                        <span>Daily- </span> <span class="num"><?php
                                                            $daily = @$web['minPrice']['min_daily'];
                                                            echo CURRENCY . number_format($daily, 2, '.', ','); ?>
                                                    </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="listing-main-content-text full aos-init aos-animate" data-aos="zoom-in-left">
                                        <div class="rating-text full">
                                            <div class="rating-text-col">
                                                <div class="stars stars-example-css full">
                                                    <!--<label>Avarage Customer Rating</label>-->
                                                    <span class="title">Average Customer Rating</span>
                                                    <select class="website_ratings" name="rating" autocomplete="off">
                                                        <option value="1" <?php if ($web['website_rating'] == '1')
                                                            echo "selected"; ?> >1
                                                        </option>
                                                        <option value="2" <?php if ($web['website_rating'] == '2')
                                                            echo "selected"; ?> >2
                                                        </option>
                                                        <option value="3" <?php if ($web['website_rating'] == '3')
                                                            echo "selected"; ?> >3
                                                        </option>
                                                        <option value="4" <?php if ($web['website_rating'] == '4')
                                                            echo "selected"; ?> >4
                                                        </option>
                                                        <option value="5" <?php if ($web['website_rating'] == '5')
                                                            echo "selected"; ?> >5
                                                        </option>
                                                    </select>

                                                </div>
                                                <div class="full check-btn">
                                                    <a href="<?php echo base_url('website/space/') . base64_encode($web['web_id']); ?>">
                                                        <button class="btn site-btn">Check Website</button>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="rating-text-col">
                                                <ul class="list-info">
                                                    <?php foreach ($web['pages'] as $keys => $val) {
                                                        ?>
                                                        <li>
                                                            <?php echo $val['page_name']; ?>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php }
                }?>

            </ul>

            <div class="listing-pagination full">
                <?php echo @$links;?>
            </div>
        </div>
    </div>
</div>