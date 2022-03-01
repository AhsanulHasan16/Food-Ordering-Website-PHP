<?php
    
    include('front-reusables/menu.php');
    
?>



    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

            // Will display all the active categories here. In the home page both featured and active have to be yes to be displayed. 
             
            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";           

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count > 0){

                // Category available!
                while($row = mysqli_fetch_assoc($res)){

                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                    <a href="<?php echo HOMEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php

                                if($image_name == ""){

                                    // No image available!
                                    echo "<div class = 'error'> Image Not Found! </div>";

                                } else {

                                    // Image available! 
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

                // Category not available!
                echo "<div class = 'error'> Category Not Found! </div>";
            }


            ?>
            

            <div class="clearfix"></div>

        </div>

    </section>

    <!-- Categories Section Ends Here -->


    <?php
    
    include('front-reusables/footer.php');
    
?>