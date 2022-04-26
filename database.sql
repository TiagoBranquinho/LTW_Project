PRAGMA foreign_keys = on;
BEGIN TRANSACTION;

.mode columns
.headers on

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Image;
DROP TABLE IF EXISTS FavouriteRestaurant;

CREATE TABLE User
(
  username         text PRIMARY KEY ,
  password         text NOT NULL ,
  email            text NOT NULL ,
  address          text NOT NULL ,
  phoneNumber      int NOT NULL ,
  restaurantOwner  numeric NOT NULL ,
  customer         numeric NOT NULL
);

CREATE TABLE Restaurant
(
  restaurantID  int PRIMARY KEY ,
  name          text NOT NULL ,
  imageID       int CONSTRAINT fk_restaurant_image REFERENCES Image (imageID) ,
  category      text NOT NULL ,
  address       text NOT NULL
);

CREATE TABLE Orders
(
  orderID       int PRIMARY KEY ,
  state         text NOT NULL ,
  restaurantID  int CONSTRAINT fk_order_restaurant REFERENCES Restaurant (restaurantID) ,
  dishID        int CONSTRAINT fk_order_dish REFERENCES Dish (dishID) ,
  username      text CONSTRAINT fk_order_username REFERENCES User (username)
);

CREATE TABLE Dish
(
  dishID        int PRIMARY KEY ,
  name          text NOT NULL ,
  imageID       int CONSTRAINT fk_dish_image REFERENCES Image (imageID) ,
  restaurantID  int CONSTRAINT fk_dish_restaurant REFERENCES Restaurant (restaurantID) ,
  price         real NOT NULL ,
  category      text NOT NULL ,
  discount      real NOT NULL CONSTRAINT valid_discount CHECK (discount <=1 AND discount >=0)
);

CREATE TABLE Review
(
  reviewID     int PRIMARY KEY ,
  restaurantID int CONSTRAINT fk_review_restaurant REFERENCES Restaurant (restaurantID),
  username     text CONSTRAINT fk_review_username REFERENCES User (username) ,
  imageID      int CONSTRAINT fk_revie_image REFERENCES Image (imageID) ,
  title        text NOT NULL ,
  message      text NOT NULL ,
  datetime     date NOT NULL ,
  score        int NOT NULL
);

CREATE TABLE Image
(
  imageID  int PRIMARY KEY ,
  path     text NOT NULL
);

CREATE TABLE FavouriteRestaurant
(
  restaurantID  int CONSTRAINT fk_favRest_restaurant REFERENCES Restaurant (restaurantID) ,
  username      text CONSTRAINT fq_favRest_username REFERENCES User (username) ,
  PRIMARY KEY (restaurantID, username)
);

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
