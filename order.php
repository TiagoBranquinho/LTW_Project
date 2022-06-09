<?php 
    include_once('templates/common.tpl.php');
    output_header();
?>
<main>
    <div class="order">
        <div class="orderinfo">
            <h1>KFC CIRCUNVELAÇÃO</h1>
            <h4>Rua de LTW, casa do Restivo</h4>
            <h4>Order number: #1</h4>
            <h4>25/08/2022 16:37</h4>
        </div>
        <div class="ordercheckout">
        <h4>Your order</h4>
        <h4>Total: 15 paus</h4>
        <div class="dishes">
            <article>
                <section>
                    <h2>Streetwise two</h2>
                    <h4>Price: 3,99$</h3>
                    <h4>Category: Chicken</h3>
                </section>
                <section>
                    <img src="https://picsum.photos/120/100" alt="logopic">
                </section>
                <section>
                    <h4>Quantity: 2</h3>
                </section>
            </article>
            <article>
                <section>
                    <h2>Streetwise two</h2>
                    <h4>Price: 3,99$</h3>
                    <h4>Category: Chicken</h3>
                </section>
                <section>
                    <img src="https://picsum.photos/120/100" alt="logopic">
                </section>
                <section>
                    <h4>Quantity: 2</h3>
                </section>
            </article>
            <article>
                <section>
                    <h2>Streetwise two</h2>
                    <h4>Price: 3,99$</h3>
                    <h4>Category: Chicken</h3>
                </section>
                <section>
                    <img src="https://picsum.photos/120/100" alt="logopic">
                </section>
                <section>
                    <h4>Quantity: 2</h3>
                </section>
            </article>
        </div>
        <h4>Payment Method: Monetary</h4>
        <h4>Status: Ordered</h4>
        <a href="my_orders.php">Back to My Orders</a>
    </div>
</main>
<?php output_footer();?>