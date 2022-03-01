<?php
    
    include('front-reusables/menu.php');
    
?>

    <!-- Food Search Section Starts Here -->

    <section class="food-search text-center">

        <div class="container">

            <?php

                // Getting the searched keyword.

                $search = mysqli_real_escape_string($conn, $_POST['search']);

                // Also need to pass tha connection. 

                // If we only use $search = $_POST['search'] ; then we will have a big risk of getting our servers and data in danger.

                // And all of that can be done just by the search bar. 

                // So, that's why we used the mysqli_real_escape_string function. It will treat any special characters as normal string!

                // Search about it to know more. 

                // And also search about SQL Injections! 

                // And we have to do this thing for everywhere where there's a chance of this happening! Let's look for the search bars!

                // We can also use this method in all the other fields where we take text input like add-admin or update-food etc.

                // But those are only accessible by the admins. And not everyone. 

                // So we can add this to those as well but for now we won't be doing it! Because it won't be a threat!
                

            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>

    </section>

    <!-- Food Search Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                // Sql query to get food items bases on the searched keyword. 
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count > 0){

                    // Food available. 
                    while($row = mysqli_fetch_assoc($res)){

                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php

                                    if($image_name == ""){

                                        echo "<div class = 'error'> No Images Found!</div>";

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

                                <a href="#" class="btn btn-primary">Order Now</a>

                            </div>

                        </div>

                        <?php

                    }

                } else {

                    // Food not available. 
                    echo "<div class = 'error'> No Food Item Found!</div>";

                }


            ?>

            
            <div class="clearfix"></div>

            

        </div>

    </section>

    <!-- Food Menu Section Ends Here -->


   <?php
    
    include('front-reusables/footer.php');
    
?>