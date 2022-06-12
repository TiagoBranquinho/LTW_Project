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
                    <?php echo "<input type='hidden' id='quantity' name='quantity" . $dish->id . "'>";?>
                    <h4>0</h4>
                    <?php echo "<input type='hidden' value='" . $dish->id . "' name='element" . $dish->id . "'>";?>
                    <button type="button">+</button>
                </section>
            </article>
<?php };?>