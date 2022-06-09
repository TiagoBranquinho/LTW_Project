<?php 
    session_start();
    include_once('templates/common.tpl.php');
    output_header();
?>
<main id="formPage">
    <h1>Register</h1>

    <div id="checkboxes">
        <span class="checkBox">
            <input type="checkbox" id="option1" name="customer" onclick="register()">
            <label for="option1">Customer</label>
        </span>
        <span class="checkbox">
            <input type="checkbox" id="option2" name="restOwner" onclick="register()">
            <label for="option2">Restaurant Owner</label>
        </span>
    </div>

    <div id="forms">
        <form action="action_registerCustomer.php" id="registerUser" method="POST">
            <fieldset class="register">
                <legend>Customer Data</legend>
                <div class="inputbox">
                <label for="username">Username*:</label>
                <input type="text" name="username" size="25" placeholder="username" id="username" required="true" pattern="^[A-Za-z][A-Za-z0-9_]{2,}$" title="Minimum 3 characters, start with an alphabet and all other characters can be alphabets, numbers or an underscore">
                </div>
                <div class="inputbox">
                <label for="password">Password*:</label>
                <input type="password" name="password" size="25" placeholder="password" id="password" required="true" pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$" title="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number">
                </div>
                <div class="inputbox">
                <label for="email">Email*:</label>
                <input type="email" name="email" size="35" placeholder="email" id="email" required="true">
                </div>
                <div class="inputbox">
                <label for="phoneNumber">Phone Number*:</label>
                <input type="text" name="phoneNumber" size="15" placeholder="phone number" id="phoneNumber" required="true">
                </div>
                <div class="inputbox">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" size="50" placeholder="address">
                </div>
                <button type="submit">Register</button>
            </fieldset>
        </form>

        <form action="action_registerRO.php" id="registerRO" method="POST" enctype="multipart/form-data">
            <fieldset class="register">
                <legend>Restaurant Owner</legend>
                <div class="inputbox">
                    <label for="username">Username*:</label>
                    <input type="text" name="username" placeholder="username" required="true" pattern="^[A-Za-z][A-Za-z0-9_]{2,}$" title="Minimum 3 characters, start with an alphabet and all other characters can be alphabets, numbers or an underscore">
                </div>
                <div class="inputbox">
                    <label for="password">Password*:</label>
                    <input type="password" name="password" placeholder="password" required="true" pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$" title="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number">
                </div>
                <div class="inputbox">
                    <label for="email">Email*:</label>
                    <input type="email" name="email" placeholder="email" required="true">
                </div>
                <div class="inputbox">
                    <label for="phoneNumber">Phone Number*:</label>
                    <input type="text" name="phoneNumber" placeholder="phone number" required="true">
                </div>
                <div class="inputbox">
                    <label for="restaurantName">Restaurant Name*:</label>
                    <input type="text" name="restaurantName" placeholder="Restaurant Name" required="true">
                </div>
                <div class="inputbox">
                    <label for="restaurantCategory">Restaurant Category*:</label>
                    <input type="text" name="restaurantCategory" placeholder="Restaurant Category" required="true" list="categories">
                    <datalist id="categories">
                        <option value="Buffet">
                        <option value="Cafe">
                        <option value="Casual dining">
                        <option value="Fast-food">
                        <option value="Fine dining">
                        <option value="Take-away">
                    </datalist>
                </div>
                <div class="inputbox">
                    <label for="restaurantAddress">Address*:</label>
                    <input type="text" name="restaurantAddress" placeholder="address" size="50" required="true">
                </div>
                <div class="inputbox">
                    <label for="restaurantImage">Restaurant Image: </label>
                    <input type="file" name="restaurantImage" accept="image/png,image/jpeg"/>
                </div>
                <button type="submit">Register</button>
            </fieldset>
        </form>

        <form action="action_registerCustomerAndRO.php" id="registerUserAndRO" method="POST" enctype="multipart/form-data">
            <fieldset class="register">
                <legend>Customer Data</legend>
                <div class="inputbox">
                <label for="username">Username*:</label>
                <input type="text" name="username" size="25" placeholder="username" id="username" required="true" pattern="^[A-Za-z][A-Za-z0-9_]{2,}$" title="Minimum 3 characters, start with an alphabet and all other characters can be alphabets, numbers or an underscore">
                </div>
                <div class="inputbox">
                <label for="password">Password*:</label>
                <input type="password" name="password" size="25" placeholder="password" id="password" required="true" pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$" title="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number">
                </div>
                <div class="inputbox">
                <label for="email">Email*:</label>
                <input type="email" name="email" size="35" placeholder="email" id="email" required="true">
                </div>
                <div class="inputbox">
                <label for="phoneNumber">Phone Number*:</label>
                <input type="text" name="phoneNumber" size="15" placeholder="phone number" id="phoneNumber" required="true">
                </div>
                <div class="inputbox">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" size="50" placeholder="address">
                </div>
            </fieldset>
            <fieldset class="register">
                <legend>Restaurant Data</legend>
                <div class="inputbox">
                    <label for="restaurantName">Restaurant Name*:</label>
                    <input type="text" name="restaurantName" placeholder="Restaurant Name" required="true">
                </div>
                <div class="inputbox">
                    <label for="restaurantCategory">Restaurant Category*:</label>
                    <input type="text" name="restaurantCategory" placeholder="Restaurant Category" required="true" list="categories">
                    <datalist id="categories">
                        <option value="Buffet">
                        <option value="Cafe">
                        <option value="Casual dining">
                        <option value="Fast-food">
                        <option value="Fine dining">
                        <option value="Take-away">
                    </datalist>
                </div>
                <div class="inputbox">
                    <label for="restaurantAddress">Restaurant Address*:</label>
                    <input type="text" name="restaurantAddress" placeholder="address" size="50" required="true">
                </div>
                <div class="inputbox">
                    <label for="restaurantImage">Restaurant Image: </label>
                    <input type="file" name="restaurantImage" accept="image/png,image/jpeg"/>
                </div>
                <button type="submit">Register</button>
            </fieldset>
        </form>
    </div>

</main>
<?php output_footer();?>