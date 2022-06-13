<?php 
    declare (strict_types = 1);
    session_start();
    include_once('templates/common.tpl.php');
    include_once('templates/my_orders.tpl.php');
    output_header();
    output_my_orders_list($_SESSION['username']);
?>
    <ul id="orders">
        <li>
            <article class="order">
                <section>
                    <h2>Restaurant Name</h2>
                </section>
                <section>
                    <div>
                        <h4>Order number #1</h4>
                        <h4>Dishes Ordered: 2</h4>
                        <h4>Price: 2$</h4>
                    </div>
                    <h3>Status: Ordered</h3>
                </section>
            </article>
        </li>
        <li>
            <article class="order">
                <section>
                    <h2>Restaurant Name</h2>
                </section>
                <section>
                    <div>
                        <h4>Order number #1</h4>
                        <h4>Dishes Ordered: 2</h4>
                        <h4>Price: 2$</h4>
                    </div>
                    <h3>Status: Ordered</h3>
                </section>
            </article>
        </li>
        <li>
            <article class="order">
                <section>
                    <h2>Restaurant Name</h2>
                </section>
                <section>
                    <div>
                        <h4>Order number #1</h4>
                        <h4>Dishes Ordered: 2</h4>
                        <h4>Price: 2$</h4>
                    </div>
                    <h3>Status: Ordered</h3>
                </section>
            </article>
        </li>
    </ul>

</main>
<?php output_footer();?>
