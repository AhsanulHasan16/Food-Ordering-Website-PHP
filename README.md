# Food-Ordering-Website-PHP
This is my very first big project in raw PHP. It's a food ordering website. Has all the advantages and features you would expect from a food ordering website. There's also an admin panel, who are there to manage the website. 
Has login system. No normal customers can see the admin panel. 

# Technologies Used in this project:

1. HTML5
2. CSS
3. Raw PHP 

# Security Features

Though I couldn't implement a lot of security in the project because I am a fresher. But still there are some security features I implemented in this project. 

1. Passwords are all encrypted with md5 hashing before being stored in the database. 
2. Protected from SQL Injections. 


# Database

In this project, I have used MySQL as the database. And to connect the project with my database and query the database, I used mysqli method. Set up the database in my PC as localhost with the help of XAMPP. 

# Deployment

There will be some final polishing and brushing before I deploy it. It will be deployed very soon. 


# Contents 

The **menu.php** and **footer.php** are templates for the other pages located in the **Reusables** folder inside the admin folder. Every pages include them. So wrote once and included in every one of the pages. These pages will be viewed by the admins who are logged in the system. That's why they are in the admin folder. Menu and footer will be different for the front website. 

1. The **admin** folder contains all the contents of the pages which will be there when an admin logs in the system.
2. **index.php** is the homepage for the admins. 
3. All the **add-... .php** files are for the add buttons on the admin, category and foods page. 
4. **...-management.php** files are executing the managing operations done by the admins. 
5. **delete-... .php** files are for the delete buttons on the admin, category and foods page. 
6. **login-check.php** - Check if the admin is logged in the system or not. 
7. **login.php** - The login page for the admins. 
8. **logout.php** - The logout button in the admin pages. 
9. **update-... .php** files are for the update buttons on the admin, category and the foods page. 
10. **change-password.php** - For an admin to change the password. 
11. **Config** folder holds all the initializations and the configurations needed for this project. 
12. **css** folder holds all the CSS codes needed for this project. 
13. **images** folder holds the images of the foods which will be uploaded and displayed on the website. 
14. **index.php** (outside the admin folder) - Homepage of the website. 
15. **categories.php** - The category page of the website. 
16. **category-foods.php** - For the page which will show a list of all the foods based on a category selected. 
17. **food-search.php** - For the search bar. This page will list all the foods based on the searched keyword. 
18. **foods.php** - For the foods page. 
19. **order.php** - For the order page. 
20. **Front-reusables** folder consists of **footer.php** and **menu.php** which are different. These will be on the main front website for the customer view. 

# Contact 
Email - ahsanul2051@gmail.com



