<div class="main-content full">
    <div class="uz-wrap full web-info-page">
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
                <div class="black-strip-text full">
                    <p><span><?php echo $websiteData['website_name']; ?></span>
                        - <?php echo $websiteData['short_description']; ?></p>

                </div>

            </div>


        </div>

        <div class="web-info-wrap full">
            <div class="web-info-text full">
                <div class="container">
                    <p>
                        <?php echo $websiteData['website_description']; ?>
                    </p>
                </div>
            </div>


            <div class="web-info-list full">
                <ul>

                    <!-- Foreach loop -->
                    <?php
                    //                    echo "<pre>"; print_r($spaceData); die;
                    $count=-1;
                    foreach ($spaceData as $space) {
                        $count++;
                        ?>


                        <li class="web-info-list-col">
                            <div class="web-info-list-main full">
                                <div class="web-info-list-main-col">
                                    <div class="web-info-list-main-img full aos-init aos-animate" data-aos="zoom-in-down">

                                        <div id="myCarousel<?php echo $count;?>" class="carousel slide" data-ride="carousel" data-interval="2000">
                                            <?php /* ?>
                                                <ol class="carousel-indicators">
                                                    <?php for( $i=0; $i< count($space); $i++ )
                                                    {
                                                        if($i == 0)
                                                        {
//                                                            echo '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                                                            echo "<li data-target='#myCarousel$count' data-slide-to='0' class='active'></li>";
                                                        } else
                                                        {
//                                                            echo '<li data-target="#myCarousel" data-slide-to="$i"></li>';
                                                            echo "<li data-target='#myCarousel$count' data-slide-to='$i'></li>";

                                                        }
                                                    } ?>
                                                </ol>
 <?php */ ?>

                                            <div class="carousel-inner">
                                                <?php
                                                for ($i = 0; $i < count($space); $i++)
                                                { ?>

                                                    <?php if ($i==0){ ?>
                                                    <div class="item active">
                                                        <!--                                                        <img src="--><?php //echo UPLOAD_URL . '/space/' . $space[$i]['image']; ?><!--" alt="uz-img" style="width:100%;">-->
                                                        <img src="<?php echo base_url() . 'timthumb/timthumb.php'; ?>?src=<?php echo UPLOAD_URL . 'space/' . $space[$i]['image'] . '&h=380&w=300'; ?>" />
                                                    </div> <?php } else {?>
                                                    <div class="item">
                                                        <!--                                                        <img src="--><?php //echo UPLOAD_URL . '/space/' . $space[$i]['image']; ?><!--" alt="uz-img" style="width:100%;">-->
                                                        <img src="<?php echo base_url() . 'timthumb/timthumb.php'; ?>?src=<?php echo UPLOAD_URL . 'space/' . $space[$i]['image'] . '&h=380&w=300'; ?>" />
                                                    </div>
                                                <?php }
                                                } ?>

                                            </div>

                                            <!-- Left and right controls -->
                                            <a class="left carousel-control" href="#myCarousel<?php echo $count;?>" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#myCarousel<?php echo $count;?>" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>

                                        <div class="img-bottom full">
                                            <h3 class="title"><?php echo $space[0]['page_name']; ?> </h3>
                                        </div>
                                    </div>

                                </div>

                                <div class="web-info-list-main-col">
                                    <div class="web-info-list-main-table full aos-init aos-animate" data-aos="flip-left">
                                        <table id="info-list-tb" class="table info-list-tb" width="100%"
                                               cellspacing="0">
                                            <thead class="info-list-tb-head ">
                                            <tr>
                                                <th class="info-list-tb-head-col">Ad Space Location</th>
                                                <th class="info-list-tb-head-col">Size Of Banner</th>
                                                <th class="info-list-tb-head-col">Hourly Rates</th>
                                                <th class="info-list-tb-head-col">Daily Rates</th>
                                                <th class="info-list-tb-head-col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="info-list-tb-content-main ">
                                            <?php
                                            for ($i = 0; $i < count($space); $i++) { ?>

                                                <tr class="">
                                                    <td class="info-list-tb-content-col">
                                                        <div class="info-list-tb-td"><?php echo $space[$i]['space_name']; ?></div>
                                                    </td>
                                                    <td class="info-list-tb-content-col">
                                                        <div class="info-list-tb-td"><?php echo $space[$i]['banner_width'] . "x" . $space[$i]['banner_height']; ?></div>
                                                    </td>
                                                    <td class="info-list-tb-content-col">
                                                        <div class="info-list-tb-td">
                                                            $<?php echo $space[$i]['base_price_per_hour']; ?></div>
                                                    </td>
                                                    <td class="info-list-tb-content-col">
                                                        <div class="info-list-tb-td">
                                                            $<?php echo $space[$i]['base_price_per_day']; ?></div>
                                                    </td>
                                                    <td class="info-list-tb-content-col">
                                                        <div class="info-list-tb-td">
                                                            <a href="<?php echo base_url('website/spaceDetails/'). base64_encode($space[$i]['sp_id']);?>">
                                                                <button class="btn site-btn">book</button>
                                                            </a>
                                                        </div>
                                                    </td>

                                                </tr>
                                            <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                    } ?>


                </ul>

            </div>
        </div>


    </div>
</div>