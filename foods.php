<?php
    
    include('front-reusables/menu.php');
    
?>

    <!-- Food Search Section Starts Here -->

    <section class="food-search text-center">

        <div class="container">
            
            <form action="<?php echo HOMEURL; ?>food-search.php" method="POST">          
                <!-- As we can see this form for the search bar in the foods page, already directs to the food-search.php-->
                <!-- And we have already fixed that one with the SQL function so we don't need to do anything here!-->

                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">

            </form>


        </div>

    </section>

    <!-- Food Search Section Ends Here -->



    <!-- Food Menu Section Starts Here -->

    <section class="food-menu">
        <div class="container">

            <h2 class="text-center">Food Menu</h2>

            <?php

                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";         // All active foods will be displayed on this page. 

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count > 0){

                    while($row = mysqli_fetch_assoc($res)){

                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>

                        
                        <div class="food-menu-box">
                            <div class="food-menu-img">

                                <?php

                                    if($image_name == ""){

                                        echo "<div class = 'error'> No Images Available! </div>";
                                    
                                    } else {

                                        ?>

                                        <img src="<?php echo HOMEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                        <?php

                                    }

                                ?>

                            </div>

                            <div class="food-menu-desc">
                                
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo HOMEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            
                            </div>
                        
                        </div>

                        <?php
                    }

                } else {

                    // Category not available!

                    echo "<div class = 'error'> Food Items Not Found! </div>";
                }

            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>

    <!-- Food Menu Section Ends Here -->


    <?php
    
    include('front-reusables/footer.php');
    
?>