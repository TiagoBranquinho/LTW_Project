<?php 
    include_once('templates/common.tpl.php');
    output_header();?>
<main>
<div class="restaurantCategory">
<h1>Restaurants</h1>
<h4>Filter by Category:</h4>
<form>
<select name="restaurantCategory">
    <option disabled selected value><h6>Category</h6></option>
    <option value="1">Fast Food</option>
    <option value="2">Japanese</option>
    <option value="3">Italian</option>
</select>
</form>
</div>
<ul id="restaurants">
    <li>
    <article class="restaurant">
    <section id="name">
    <h3>KFC Circunvelação</h3>
        <h4>Category: Fast Food</h4>
        <h5>Rua do ze</h5>
        </section>
        <section id="images">
        <img src="https://picsum.photos/120/100" alt="logopic">
        <img src="https://picsum.photos/120/100" alt="logopic">
        <img src="https://picsum.photos/120/100" alt="logopic">
        </section>
        <section id="buttons">
        <a>Order Now</a>
        <a>Menu</a>
        </section>
        </article>
    </li>

    <li>
    <article class="restaurant">
    <section id="name">
    <h3>KFC Circunvelação</h3>
        <h4>Category: Fast Food</h4>
        <h5>Rua do ze</h5>
        </section>
        <section id="images">
        <img src="https://picsum.photos/120/100" alt="logopic">
        <img src="https://picsum.photos/120/100" alt="logopic">
        <img src="https://picsum.photos/120/100" alt="logopic">
        </section>
        <section id="buttons">
        <a>Order Now</a>
        <a>Menu</a>
        </section>
        </article>
    </li>

    <li>
    <article class="restaurant">
    <section id="name">
    <h3>KFC Circunvelação</h3>
        <h4>Category: Fast Food</h4>
        <h5>Rua do ze</h5>
        </section>
        <section id="images">
        <img src="https://picsum.photos/120/100" alt="logopic">
        <img src="https://picsum.photos/120/100" alt="logopic">
        <img src="https://picsum.photos/120/100" alt="logopic">
        </section>
        <section id="buttons">
        <a>Order Now</a>
        <a>Menu</a>
        </section>
        </article>
    </li>
</ul>
        
</main>
    <?php output_footer();?>