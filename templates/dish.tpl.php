<?php
function output_restaurant_dish(Dish $dish){;?>
        <article>
                <section>
                    <?php echo "<h4>" . $dish->name . "</h4>";
                    echo "<h4>Category: " . $dish->category . "</h4>";?>
                    <div class="price">
                        <h4>Price: </h4>
                        <?php echo "<h4 class='value'>" . $dish->price . "</h4>";?>
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
<?php };?>