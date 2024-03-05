-- Create USER table
CREATE TABLE [USER] (
    UserID int PRIMARY KEY,
    Username varchar(255),
    Email varchar(255),
    Password varchar(255),
    Role varchar(255)
);

-- Create PURCHASE table
CREATE TABLE PURCHASE (
    PurchaseID int PRIMARY KEY,
    UserID int,
    PurchaseDate datetime,
    FOREIGN KEY (UserID) REFERENCES [USER](UserID)
);

-- Create PURCHASE_ITEM table
CREATE TABLE PURCHASE_ITEM (
    PurchaseID int,
    BookID int,
    PRIMARY KEY (PurchaseID, BookID),
    FOREIGN KEY (PurchaseID) REFERENCES PURCHASE(PurchaseID),
    FOREIGN KEY (BookID) REFERENCES BOOK(BookID)
);

-- Create BOOK table
CREATE TABLE BOOK (
    BookID int PRIMARY KEY,
    Title varchar(255),
    ISBN varchar(255),
    Genre varchar(255),
    Price decimal(5,2),
    AuthorID int,
    PublisherID int,
    FOREIGN KEY (AuthorID) REFERENCES AUTHOR(AuthorID),
    FOREIGN KEY (PublisherID) REFERENCES PUBLISHER(PublisherID)
);

-- Create REVIEW table
CREATE TABLE REVIEW (
    ReviewID int PRIMARY KEY,
    UserID int,
    BookID int,
    Rating int,
    Comment text,
    FOREIGN KEY (UserID) REFERENCES [USER](UserID),
    FOREIGN KEY (BookID) REFERENCES BOOK(BookID)
);

-- Create AUTHOR table
CREATE TABLE AUTHOR (
    AuthorID int PRIMARY KEY,
    Name varchar(255),
    Biography text
);

-- Create PUBLISHER table
CREATE TABLE PUBLISHER (
    PublisherID int PRIMARY KEY,
    Name varchar(255),
    Address varchar(255)
);


-- Inserting data into USERS table
INSERT INTO USERS (UserID, Username, Email, Password, Role) VALUES
(1, 'johndoe', 'john.doe@example.com', 'hashed_password', 'customer'),
(2, 'janedoe', 'jane.doe@example.com', 'hashed_password', 'customer');

-- Inserting data into AUTHOR table
INSERT INTO AUTHOR (AuthorID, Name, Biography) VALUES
(1, 'Ernest Hemingway', 'An American novelist and short-story writer.'),
(2, 'Virginia Woolf', 'An English writer, considered one of the most important modernist 20th-century authors.');

-- Inserting data into PUBLISHER table
INSERT INTO PUBLISHER (PublisherID, Name, Address) VALUES
(1, 'Penguin Books', '123 Penguin Road, Booktown'),
(2, 'HarperCollins', '456 Harper Street, Readville');

-- Inserting data into BOOK table
INSERT INTO BOOK (BookID, Title, ISBN, Genre, Price, AuthorID, PublisherID) VALUES
(1, 'The Old Man and the Sea', '1234567890', 'Fiction', 9.99, 1, 1),
(2, 'To the Lighthouse', '2345678901', 'Fiction', 12.99, 2, 2);

-- Inserting data into PURCHASE table
INSERT INTO PURCHASE (PurchaseID, UserID, PurchaseDate) VALUES
(1, 1, '2024-02-28 10:00:00'),
(2, 2, '2024-02-28 11:00:00');

-- Inserting data into PURCHASE_ITEM table
INSERT INTO PURCHASE_ITEM (PurchaseID, BookID) VALUES
(1, 1),
(2, 2);

-- Inserting data into REVIEW table
INSERT INTO REVIEW (ReviewID, UserID, BookID, Rating, Comment) VALUES
(1, 1, 1, 5, 'A timeless classic!'),
(2, 2, 2, 4, 'A very interesting read.');
