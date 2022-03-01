<?php
    
    include('front-reusables/menu.php');
    
?>

    <?php 

        // Checking whether the food id was set or not!
        if(isset($_GET['food_id'])){

            // Getting the id of the selected food!
            $food_id = $_GET['food_id']; 

            // Getting the details of the selected food!
            $sql = "SELECT * FROM tbl_food WHERE id = $food_id";

            $res = mysqli_query($conn, $sql);       // Executing the query. 

            $count = mysqli_num_rows($res);         // Counting the rows. 

            // Checking whether data is available or not!

            if($count == 1){

                // Data Available! Comparing with 1 because for any food id there is only 1 row of data corresponding to that food id!

                // Getting data from database! 

                $row = mysqli_fetch_assoc($res); 
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];

            } else {

                // Data Not Available!

                header('location:'.HOMEURL);        // Redirecting to home page! 

            }

        } else {

            // Redirect to homepage. 
            header('location:'.HOMEURL);
        }

    ?>

    <!-- Food Search Section Starts Here -->

    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method = "POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                        <?php

                            // Checking for image availability!
                            if($image_name == ""){

                                // Image not Available!

                                echo "<div class = 'error'>No Image Available! </div>";

                            } else {

                                // Image Available! 
                                // Cutting the php to display the image which is done in html!

                                ?>

                                <img src="<?php echo HOMEURL; ?>images/food/<?php echo $image_name; ?>" alt="Image Of Food" class="img-responsive img-curve">

                                <?php

                            }

                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Md. Saki" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0148xxxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. saki@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Road no, House no, Block, City" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>


            <?php

                // Checking if the submit button was clicked or not!
                if(isset($_POST['submit'])){

                    // Get the details! 

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;

                    $order_date = date("Y-m-d h:i:sa");

                    $status = "Ordered";        // 4 different status. Ordered, On The Way, Delivered, Cancelled! 

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];


                    // Time for Query to save the order in the database!
                    
                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    $res2 = mysqli_query($conn, $sql2);         // Executing the sql2 query. 

                    // Checking if the execution was successful or not!
                    if($res2 == true){

                        // Executed and order saved successfully!

                        $_SESSION['order'] = "<div class='success text-center'> Food Ordered!</div>";
                        header('location:'.HOMEURL);

                    } else {

                        // Failed to execute!

                        $_SESSION['order'] = "<div class='error text-center'> Failed To Order Food!</div>";
                        header('location:'.HOMEURL);

                    }

                } else {


                }

            ?>

        </div>

    </section>
    <!-- Food Search Section Ends Here -->

   <?php
    
    include('front-reusables/footer.php');
    
?>