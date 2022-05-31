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
    <div class="restaurantDishes">
        <article>
            <section id="name">
                <h4>Streetwise Two</h4>
                <h4>Category: Chicken</h4>
                <h4>Price: 3,99$</h5>
            </section>
            <section>
                <img src="https://picsum.photos/200/160" alt="logopic">
            </section>
            <section>
                <button>-</button>
                <input type="text" value="0">
                <button>+</button>
            </section>
        </article>
        <article>
            <section>
                <h4>Streetwise Two</h4>
                <h4>Category: Chicken</h4>
                <h4>Price: 3,99$</h5>
            </section>
            <section>
                <img src="https://picsum.photos/200/160" alt="logopic">
            </section>
            <section>
                <button>-</button>
                <input type="text" value="0">
                <button>+</button>
            </section>
        </article>
        <article>
            <section id="name">
                <h4>Streetwise Two</h4>
                <h4>Category: Chicken</h4>
                <h4>Price: 3,99$</h5>
            </section>
            <section>
                <img src="https://picsum.photos/200/160" alt="logopic">
            </section>
            <section>
                <button>-</button>
                <input type="text" value="0">
                <button>+</button>
            </section>
        </article>
        <h3>Total:</h3>
        <input type="text" value="12.00$">
    </div>
</main>
<?php output_footer();?>