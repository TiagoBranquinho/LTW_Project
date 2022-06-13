PRAGMA foreign_keys = on;
BEGIN TRANSACTION;

.mode columns
.headers on

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Customer;
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS RestaurantOwner;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Image;
DROP TABLE IF EXISTS FavouriteRestaurant;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS DishCategory;
DROP TABLE IF EXISTS OrderState;


CREATE TABLE User
(
    username         NVARCHAR(120) PRIMARY KEY ,
    password         text NOT NULL ,
    email            NVARCHAR(60) NOT NULL ,
    address          NVARCHAR(70) NOT NULL UNIQUE,
    phoneNumber      NVARCHAR(24) NOT NULL
);

CREATE TABLE Customer
(
    username NVARCHAR(120) REFERENCES User (username)
);

CREATE TABLE Restaurant
(
    restaurantID  integer PRIMARY KEY AUTOINCREMENT ,
    imageID       integer CONSTRAINT fk_restaurant_image REFERENCES Image (imageID) ,
    name          NVARCHAR(150) NOT NULL ,
    category      NVARCHAR(50) NOT NULL CONSTRAINT fk_restaurant_category REFERENCES Category (kind) ,
    address       NVARCHAR(70) NOT NULL UNIQUE
);

CREATE TABLE RestaurantOwner
(
    username NVARCHAR(120) REFERENCES User (username),
    restaurantID integer REFERENCES Restaurant (restaurantID)
);

CREATE TABLE Orders
(
    orderID       integer,
    state         NVARCHAR(50) NOT NULL CONSTRAINT fk_order_state REFERENCES OrderState (kind),
    restaurantID  integer CONSTRAINT fk_order_restaurant REFERENCES Restaurant (restaurantID) ,
    dishID        integer CONSTRAINT fk_order_dish REFERENCES Dish (dishID) ,
    quantity      integer NOT NULL,
    username      NVARCHAR(120) CONSTRAINT fk_order_username REFERENCES User (username),
    PRIMARY KEY(orderID, restaurantID)
);

CREATE TABLE Dish
(
    dishID        integer PRIMARY KEY AUTOINCREMENT,
    name          NVARCHAR(70) NOT NULL,
    imageID       integer CONSTRAINT fk_dish_image REFERENCES Image (imageID),
    restaurantID  integer CONSTRAINT fk_dish_restaurant REFERENCES Restaurant (restaurantID),
    price         real NOT NULL,
    category      NVARCHAR(50) NOT NULL,
    discount      real NOT NULL CONSTRAINT valid_discount CHECK (discount <=1 AND discount >=0)
);

CREATE TABLE Review
(
    reviewID     integer PRIMARY KEY AUTOINCREMENT,
    restaurantID integer CONSTRAINT fk_review_restaurant REFERENCES Restaurant (restaurantID),
    username     NVARCHAR(120) CONSTRAINT fk_review_username REFERENCES User (username) ,
    imageID      integer CONSTRAINT fk_review_image REFERENCES Image (imageID) ,
    title        NVARCHAR(60) NOT NULL ,
    message      NVARCHAR(500) NOT NULL ,
    datetime     date NOT NULL ,
    score        real NOT NULL CONSTRAINT valid_score CHECK (score <= 5 AND score >=0)
);

CREATE TABLE Image
(
    imageID  integer PRIMARY KEY AUTOINCREMENT,
    path     NVARCHAR(150) NOT NULL
);

CREATE TABLE FavouriteRestaurant
(
    restaurantID  integer CONSTRAINT fk_favRest_restaurant REFERENCES Restaurant (restaurantID) ,
    username      NVARCHAR(120) CONSTRAINT fq_favRest_username REFERENCES User (username) ,
    PRIMARY KEY (restaurantID, username)
);

CREATE TABLE Category
(
    kind  NVARCHAR(50) PRIMARY KEY
);

CREATE TABLE DishCategory
(
  kind  NVARCHAR(50) PRIMARY KEY
);

CREATE TABLE OrderState
(
  kind  NVARCHAR(50) PRIMARY KEY
);

INSERT INTO User VALUES('alex', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'email', 'rua sesamo', 91239192);

INSERT INTO Image(path) VALUES('aa');
INSERT INTO Image(path) VALUES('bb');

INSERT INTO Category VALUES("All");
INSERT INTO Category VALUES('Gourmet');
INSERT INTO Category VALUES('Asian');
INSERT INTO Category VALUES('Italian');
INSERT INTO Category VALUES('Fast Food');
INSERT INTO Category VALUES('Cheap');

INSERT INTO Restaurant VALUES(1, 1, 'KFC', 'Fast Food', 'Rua do Porto, Porto');
INSERT INTO Restaurant VALUES(2, 2, 'McDonalds', 'Fast Food', 'Campus 2 andar, Porto');
INSERT INTO Restaurant VALUES(3, 2, 'Sabor Gaúcho', 'Cheap', 'Campus, 2 andar, Porto');
INSERT INTO Restaurant VALUES(4, 2,'Cantina da Feup', 'Gourmet', 'Feup, Porto');

INSERT INTO DishCategory VALUES("All");
INSERT INTO DishCategory VALUES("Chicken");
INSERT INTO DishCategory VALUES("Vegan");
INSERT INTO DishCategory VALUES("Vegetarian");
INSERT INTO DishCategory VALUES("Sushi");
INSERT INTO DishCategory VALUES("Meat");
INSERT INTO DishCategory VALUES("Fish");

INSERT INTO Dish VALUES("1", "Frango Frito", "1", "1", "7.99", "Chicken", "0");
INSERT INTO Dish VALUES("2", "Asas de Frango", "1", "1", "6.99", "Chicken", "0");
INSERT INTO Dish VALUES("3", "Maminha", "1", "3", "5.99", "Meat", "0");
INSERT INTO Dish VALUES("4", "Frango Assado", "1", "3", "3.99", "Chicken", "0");

INSERT INTO OrderState VALUES("All");
INSERT INTO OrderState VALUES("Received");
INSERT INTO OrderState VALUES("Preparing");
INSERT INTO OrderState VALUES("Ready");
INSERT INTO OrderState VALUES("Delivered");



COMMIT TRANSACTION;
PRAGMA foreign_keys = on;