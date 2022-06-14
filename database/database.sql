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
    address          NVARCHAR(70) NOT NULL,
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
    address       NVARCHAR(70) NOT NULL
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
    PRIMARY KEY(orderID, restaurantID, dishID)
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
    datetime     date NOT NULL ,
    score        real NOT NULL CONSTRAINT valid_score CHECK (score <= 5 AND score >=0)
);

CREATE TABLE Comment(
    commentID   integer PRIMARY KEY AUTOINCREMENT,
    reviewID    integer CONSTRAINT fk_comment_review REFERENCES Review(reviewID),
    username    NVARCHAR(120) CONSTRAINT fk_comment_username REFERENCES User (username),
    message     NVARCHAR(500) NOT NULL
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


INSERT INTO Category VALUES('All');
INSERT INTO Category VALUES('Gourmet');
INSERT INTO Category VALUES('Asian');
INSERT INTO Category VALUES('Italian');
INSERT INTO Category VALUES('Fast Food');
INSERT INTO Category VALUES('Cheap');

INSERT INTO DishCategory VALUES("All");
INSERT INTO DishCategory VALUES("Chicken");
INSERT INTO DishCategory VALUES("Vegan");
INSERT INTO DishCategory VALUES("Vegetarian");
INSERT INTO DishCategory VALUES("Sushi");
INSERT INTO DishCategory VALUES("Meat");
INSERT INTO DishCategory VALUES("Fish");

INSERT INTO OrderState VALUES("All");
INSERT INTO OrderState VALUES("Received");
INSERT INTO OrderState VALUES("Preparing");
INSERT INTO OrderState VALUES("Ready");
INSERT INTO OrderState VALUES("Delivered");

INSERT INTO User VALUES('alex', 'b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1', 'email@gmail.com', 'rua sesamo', 91239192);
INSERT INTO Customer VALUES ('alex');

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;