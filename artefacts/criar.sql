SET search_path TO lbaw2123;

--User Notification
DROP TABLE IF EXISTS Auction CASCADE;
DROP TABLE IF EXISTS users CASCADE;

CREATE TABLE users(
    userID SERIAL PRIMARY KEY,
    email text not null UNIQUE, 
    name text NOT NULL,
    username text NOT NULL,
    password TEXT NOT NULL,
    --phoneNumber payementinfo bankAccount
    img TEXT,
    is_admin BOOLEAN NOT NULL,
    rate INTEGER
    --ClientID INTEGER NOT NULL REFERENCES Client(ClientID)
);

CREATE TABLE Auction(
    auctionID SERIAL PRIMARY KEY,
    startDate DATE NOT NULL, --CHECK predictedEnd >= startDate
    predictedEnd DATE NOT NULL, 
    StartPrice INTEGER NOT NULL-- CK startPrice > 0
    --status enum ('Active', 'Hidden', 'Canceled', 'Closed') NOT NULL
);

SELECT * FROM Auction;

