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
DROP TABLE IF EXISTS Category;


CREATE TABLE User
(
  username         NVARCHAR(120) PRIMARY KEY ,
  password         text NOT NULL ,
  email            NVARCHAR(60) NOT NULL ,
  address          NVARCHAR(70) NOT NULL ,
  phoneNumber      NVARCHAR(24) NOT NULL ,
  restaurantOwner  numeric NOT NULL ,
  customer         numeric NOT NULL
);

CREATE TABLE Restaurant
(
  restaurantID  integer PRIMARY KEY ,
  name          NVARCHAR(150) NOT NULL ,
  imageID       integer CONSTRAINT fk_restaurant_image REFERENCES Image (imageID) ,
  category      NVARCHAR(50) NOT NULL CONSTRAINT fk_restaurant_category REFERENCES Category (kind) ,
  address       NVARCHAR(70) NOT NULL
);

CREATE TABLE Orders
(
  orderID       integer ,
  state         NVARCHAR(50) NOT NULL ,
  restaurantID  integer CONSTRAINT fk_order_restaurant REFERENCES Restaurant (restaurantID) ,
  dishID        integer CONSTRAINT fk_order_dish REFERENCES Dish (dishID) ,
  quantity      integer NOT NULL,
  username      NVARCHAR(120) CONSTRAINT fk_order_username REFERENCES User (username),
  PRIMARY KEY(orderID, restaurantID)
);

CREATE TABLE Dish
(
  dishID        integer PRIMARY KEY ,
  name          NVARCHAR(70) NOT NULL ,
  imageID       integer CONSTRAINT fk_dish_image REFERENCES Image (imageID) ,
  restaurantID  integer CONSTRAINT fk_dish_restaurant REFERENCES Restaurant (restaurantID) ,
  price         real NOT NULL ,
  category      NVARCHAR(50) NOT NULL ,
  discount      real NOT NULL CONSTRAINT valid_discount CHECK (discount <=1 AND discount >=0)
);

CREATE TABLE Review
(
  reviewID     integer PRIMARY KEY ,
  restaurantID integer CONSTRAINT fk_review_restaurant REFERENCES Restaurant (restaurantID),
  username     NVARCHAR(120) CONSTRAINT fk_review_username REFERENCES User (username) ,
  imageID      integer CONSTRAINT fk_revie_image REFERENCES Image (imageID) ,
  title        NVARCHAR(60) NOT NULL ,
  message      NVARCHAR(500) NOT NULL ,
  datetime     date NOT NULL ,
  score        real NOT NULL CONSTRAINT valid_score CHECK (score <= 5 AND score >=0)
);

CREATE TABLE Image
(
  imageID  integer PRIMARY KEY ,
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


INSERT INTO User VALUES("alex", "9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684", "email", "rua sesamo", "91239192", false, true);

INSERT INTO Image VALUES("1", "aa");

INSERT INTO Image VALUES("2", "bb");

INSERT INTO Category VALUES("Gourmet");
INSERT INTO Category VALUES("Asian");
INSERT INTO Category VALUES("Italian");
INSERT INTO Category VALUES("Fast Food");
INSERT INTO Category VALUES("Cheap");

INSERT INTO Restaurant VALUES("1", "KFC", "1", "Fast Food", "Rua do Porto, Porto");
INSERT INTO Restaurant VALUES("2", "McDonalds", "2", "Fast Food", "Campus 2 andar, Porto");
INSERT INTO Restaurant VALUES("3", "Sabor Gaúcho", "2", "Cheap", "Campus, 2 andar, Porto");
INSERT INTO Restaurant VALUES("4", "Cantina da Feup", "2", "Gourmet", "Feup, Porto");


COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
