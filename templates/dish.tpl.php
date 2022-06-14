<?php
include_once ('database/image.class.php');
function output_restaurant_dish($dish){
    $imagePath = Image::getImage(getDatabaseConnection(),$dish->imageID);
    $imagePath = $imagePath->getPath();
    ?>
        <article>
                <section>
                    <?php echo "<h4>" . $dish->name . "</h4>";
                    echo "<h4>Category: " . $dish->category . "</h4>";?>
                    <div class="price">
                        <h4>Price: </h4>
                        <?php echo "<h4 class='value'>" . ($dish->price - $dish->price*($dish->discount)) . "</h4>";?>
                        <!-- TODO: Calculate dish price with discount-->
                    </div>
                    <!-- TODO: Dish Discount appear here -->
                </section>
                <section>
                    <img src="<?php echo $imagePath ?>" alt="logopic">
                </section>
                <section>
                    <button type="button">-</button>
                    <?php echo "<input type='hidden' id='quantity' name='quantity" . $dish->dishID . "'>";?>
                    <h4>0</h4>
                    <?php echo "<input type='hidden' value='" . $dish->dishID . "' name='element" . $dish->dishID . "'>";?>
                    <button type="button">+</button>
                </section>
            </article>
<?php };?>