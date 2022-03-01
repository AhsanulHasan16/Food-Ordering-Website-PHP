<?php
    
    include('front-reusables/menu.php');

?>

    <!-- Food Search Section Starts Here -->

    <section class="food-search text-center">

        <div class="container">
            
            <form action="<?php echo HOMEURL; ?>food-search.php" method="POST">

                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">

            </form>

        </div>

    </section>
    
    <!-- Food Search Section Ends Here -->

    <?php

        if(isset($_SESSION['order'])){

            echo $_SESSION['order'];
            unset($_SESSION['order']);

        }

    ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

                // SQL Query to display categories from the database. 
                $sql = "SELECT * FROM tbl_category WHERE featured = 'Yes' AND active = 'Yes' LIMIT 3";

                // Executing the query.
                $res = mysqli_query($conn, $sql);

                // Count rows to check if the category is available.
                $count = mysqli_num_rows($res);

                if($count > 0){

                    // Category Available.
                    while($row = mysqli_fetch_assoc($res)){

                        // Get the id, title and image_name of the category.
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo HOMEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">

                                <?php

                                    if($image_name == ""){

                                        echo "<div class = 'error'> Image Not Available! </div>";

                                    } else {

                                        ?>

                                        <img src="<?php echo HOMEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        
                                        <?php
                                    }

                                ?>
                                 

                                 <h3 class="float-text text-white"><?php echo $title; ?></h3>
                             </div>
                         </a>  

                        <?php 

                    }

                } else {

                    // Category not available. 
                    echo "<div class = 'error'> Category Not Available!</div>";
                }

            ?>     

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- Categories Section Ends Here -->

    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                // Sql query to get foods from the database!

                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2 > 0){

                    // Food available!
                    while($row2 = mysqli_fetch_assoc($res2)){

                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">

                                <?php

                                if($image_name == ""){

                                    echo "<div class = 'error'> No Images Found! </div>";

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

                    // Food not available!
                    echo "<div class = 'error'> No Food Items Found! </div>";

                }



            ?>



            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php
    
    include('front-reusables/footer.php');
    
?> 