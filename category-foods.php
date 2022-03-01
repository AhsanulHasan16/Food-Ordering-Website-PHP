<?php
    
    include('front-reusables/menu.php');
    
?>

<?php
    
    // Checking if category_id is passed or not. 

    if(isset($_GET['category_id'])){

        $category_id = $_GET['category_id']; 

        // Now getting category title based on the id. 

        $sql = "SELECT title FROM tbl_category WHERE id = $category_id";

        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);            // Getting the value from the database after executing the query. 

        $category_title = $row['title'];            // Getting the title. 



    } else {

        // Did not set id so redirecting to home page. 
        header('location:'.HOMEURL);

    }

?>

    <!-- Food Search Section Starts Here -->

    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>

    <!-- Food Search Section Ends Here -->



    <!-- Food Menu Section Starts Here -->

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                // This query is to get foods based on the selected category. 

                $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";

                $res2 = mysqli_query($conn, $sql2); 

                $count2 = mysqli_num_rows($res2);

                if($count2 > 0){

                    while($row2 = mysqli_fetch_assoc($res2)){

                        $id = $row2['id'];                // Getting the id here to use later for Order Now button! Otherwise, id undefined!
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

                    // Food not available. 
                    echo "<div class = 'error'> No Food Items Available Under This Category! </div>";

                }

            ?>



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Food Menu Section Ends Here -->

    <?php
    
    include('front-reusables/footer.php');
    
?>