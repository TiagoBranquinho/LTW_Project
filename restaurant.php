<?php 
    include_once('templates/common.tpl.php');
    output_header();?>
<main>
    <h1>KFC Circunvelação</h1>
    <div class="restaurantHeader">
    <div>
    <h4>Category: Fast Food</h4>
    <h4>R. Mte. Guilherme Camarinha 73, 4200-532, Porto</h4>
    <h3>Rating: 4.2</h3>
    </div>
    <img src="https://picsum.photos/400/300" alt="logopic">
    </div>
    <div class="restaurantFilter">
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
    <form class="restaurantDishes" action="action_order.php" method="POST">
        <article>
            <section>
                <h4>Streetwise Two</h4>
                <h4>Category: Chicken</h4>
                <div class="price">
                    <h4>Price: </h4>
                    <h4 class="value">3.99</h4>
                </div>
            </section>
            <section>
                <img src="https://picsum.photos/200/160" alt="logopic">
            </section>
            <section>
                <button type="button">-</button>
                <h4>0</h4>
                <input type="hidden">
                <button type="button">+</button>
            </section>
        </article>
        <article>
            <section>
                <h4>Streetwise Two</h4>
                <h4>Category: Chicken</h4>
                <div class="price">
                    <h4>Price: </h4>
                    <h4 class="value">3.99</h4>
                </div>
            </section>
            <section>
                <img src="https://picsum.photos/200/160" alt="logopic">
            </section>
            <section>
                <button type="button">-</button>
                <h4>0</h4>
                <input type="hidden">
                <button type="button">+</button>
            </section>
        </article>
        <article>
            <section>
                <h4>Streetwise Two</h4>
                <h4>Category: Chicken</h4>
                <div class="price">
                    <h4>Price: </h4>
                    <h4 class="value">3.99</h4>
                </div>
            </section>
            <section>
                <img src="https://picsum.photos/200/160" alt="logopic">
            </section>
            <section>
                <button type="button">-</button>
                <h4>0</h4>
                <input type="hidden">
                <button type="button">+</button>
            </section>
        </article>
        <div>
            <div class="price">
                <h3>Total: </h3>
                <h3 class="value">00.00</h3>
            </div>
            <button type="submit">Checkout</button>
        </div>
</form>
</main>
<?php output_footer();?>