<?php
    declare(strict_types = 1);

    class Restaurant {
        private string $name;
        private string $category;
        private string $address;

        public function __construct(string $name, string $category, string $address) {
            $this->name = $name;
            $this->category = $category;
            $this->address = $address;
        }

        /**
         * @return int
         */

        public function getRestaurantID(PDO $db, string $name, string $category, string $address): int {
            $restaurantIDStmt = $db->prepare('SELECT restaurantID FROM Restaurant WHERE name = ? AND category = ? AND address = ?');
            $restaurant = $restaurantIDStmt->execute(array(
                $name,$category,$address
            ));

            if($restaurant = $restaurantIDStmt->fetch()) return $restaurant['restaurantID'];

            return -1;
        }
        /**
         * @return string
         */
        public function getName(): string
        {
            return $this->name;
        }

        /**
         * @return string
         */
        public function getCategory(): string
        {
            return $this->category;
        }


        /**
         * @return string
         */
        public function getAddress(): string
        {
            return $this->address;
        }

    }
?>