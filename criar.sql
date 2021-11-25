SET search_path TO lbaw2123;

--DROP
DROP TABLE IF EXISTS auction CASCADE;
DROP TABLE IF EXISTS users CASCADE;

--TYPES
CREATE TYPE auction_status AS ENUM ('Active', 'Hidden', 'Canceled', 'Closed');
CREATE TYPE auction_category AS ENUM ('ArtPiece', 'Book', 'Jewlery', 'Decor', 'Other');
CREATE TYPE auction_notification AS ENUM ('Opened', 'Closed', 'New Bid', 'New Message', 'Other');
CREATE TYPE user_notification AS ENUM ('Rating', 'Follow'. 'Other');

CREATE TABLE users(
    user_id SERIAL PRIMARY KEY,
    name text NOT NULL,
    username text NOT NULL UNIQUE,
    password TEXT NOT NULL,
    email text not null UNIQUE,
    phone_number INTEGER null UNIQUE,
    credit MONEY NOT NULL CONSTRAINT credit_ck CHECK (credit >= 0::MONEY),
    --ClientID INTEGER NOT NULL REFERENCES Client(ClientID)
);

CREATE TABLE auction(
    auction_id SERIAL PRIMARY KEY,
    min_opening_bid INTEGER NOT NULL, -- CK startPrice > 0
    min_raise INTEGER NOT NULL,

    start_date DATE NOT NULL, --CHECK predictedEnd >= startDate
    predicted_end DATE NOT NULL, 
    close_date DATE NOT NULL,

    status auction_status NOT NULL,
    category auction_category NOT NULL,

    auction_notif BOOLEAN DEFAULT TRUE NOT NULL,
    user_notif BOOLEAN DEFAULT TRUE NOT NULL
);

SELECT * FROM Auction;

