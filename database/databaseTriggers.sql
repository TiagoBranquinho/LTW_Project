DROP TRIGGER IF EXISTS DeleteCustomer;

CREATE TRIGGER DeleteCustomer
    AFTER DELETE
    ON User
    BEGIN
        DELETE FROM Customer WHERE Customer.username == old.username AND old.username NOT IN (SELECT username FROM RestaurantOwner);
    END;

DROP TRIGGER IF EXISTS DeleteRestaurantOwner;

CREATE TRIGGER DeleteRestaurantOwner
    AFTER DELETE
    ON User
BEGIN
    DELETE FROM RestaurantOwner WHERE RestaurantOwner.username == old.username AND old.username NOT IN (SELECT username FROM Customer);
END;

CREATE TRIGGER DeleteCustomerAndRestaurantOwner
    AFTER DELETE
    ON User
BEGIN
    DELETE FROM RestaurantOwner
    WHERE RestaurantOwner.username == old.username
    AND old.username IN
    (SELECT username
     FROM Customer
     WHERE username IN
           (SELECT username
            FROM RestaurantOwner));
END;