SET search_path TO lbaw2123;

--DROP
DROP TYPE IF EXISTS auction_category CASCADE;
DROP TYPE IF EXISTS auction_status CASCADE;
DROP TYPE IF EXISTS auction_notification_type CASCADE;
DROP TYPE IF EXISTS user_notification_type CASCADE;

DROP TABLE IF EXISTS auction CASCADE;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS bid CASCADE;
DROP TABLE IF EXISTS admin CASCADE;
DROP TABLE IF EXISTS message CASCADE;
DROP TABLE IF EXISTS chat CASCADE;
DROP TABLE IF EXISTS auction_report CASCADE;
DROP TABLE IF EXISTS rating CASCADE;
DROP TABLE IF EXISTS user_follow CASCADE;
DROP TABLE IF EXISTS auction_follow CASCADE;
DROP TABLE IF EXISTS user_notification CASCADE;
DROP TABLE IF EXISTS auction_notification CASCADE;
DROP TABLE IF EXISTS image CASCADE;

--TYPES
CREATE TYPE auction_status AS ENUM ('Active', 'Hidden', 'Canceled', 'Closed');
CREATE TYPE auction_category AS ENUM ('ArtPiece', 'Book', 'Jewelry', 'Decor', 'Other');
CREATE TYPE auction_notification_type AS ENUM ('Opened', 'Closed', 'New Bid', 'New Message', 'Other', 'Auction Follow');
CREATE TYPE user_notification_type AS ENUM ('Rating', 'Follow', 'Other');

CREATE TABLE users(
    user_id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    email TEXT UNIQUE,
    phone_number INTEGER UNIQUE,
    credit MONEY DEFAULT 0 NOT NULL CONSTRAINT credit_ck CHECK (credit >= 0::MONEY),
    profile_image TEXT, -- check type (VARBINARY())
    rating INTEGER DEFAULT 0 NOT NULL, --dif
    blocked BOOLEAN DEFAULT FALSE NOT NULL, --BANNED
    auction_notif BOOLEAN DEFAULT TRUE NOT NULL,
    user_notif BOOLEAN DEFAULT TRUE NOT NULL
);


CREATE TABLE bid(
    bid_id SERIAL PRIMARY KEY
);
CREATE TABLE image(--change name
    img_id SERIAL PRIMARY KEY,
    content TEXT NOT NULL,
    label TEXT --NOT NULL??
);

CREATE TABLE auction(
    auction_id SERIAL PRIMARY KEY,
    title TEXT NOT NULL,
    description TEXT,

    min_opening_bid INTEGER NOT NULL CHECK (min_opening_bid > 0),   
    min_raise INTEGER NOT NULL,
    start_date DATE NOT NULL, --CK predictedEnd >= startDate
    predicted_end DATE NOT NULL,
    close_date DATE NOT NULL, --CK close_date >= predictedEnd

    status auction_status NOT NULL,
    category auction_category NOT NULL,
    seller_id INTEGER REFERENCES users(user_id) NOT NULL,
    win_bid INTEGER REFERENCES bid(bid_id),
    auction_image INTEGER REFERENCES image(img_id)
);


DROP TABLE IF EXISTS bid CASCADE;
CREATE TABLE bid(
    bid_id SERIAL PRIMARY KEY,
    bid_value INTEGER NOT NULL CHECK (bid_value > 0),
    bid_date DATE NOT NULL, --ck >auction.date
    --"date" TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    auction_id INTEGER REFERENCES auction(auction_id) NOT NULL,
    bidder_id INTEGER REFERENCES users(user_id) NOT NULL
);

CREATE TABLE admin(
    admin_id SERIAL PRIMARY KEY,
    admin_name TEXT NOT NULL,
    username TEXT NOT NULL UNIQUE,
    admin_password TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE
);

CREATE TABLE chat(
    chat_id SERIAL PRIMARY KEY,
    auction_id INTEGER REFERENCES auction(auction_id) NOT NULL
);

CREATE TABLE message( --change name
    msg_id SERIAL PRIMARY KEY,
    msg_content TEXT NOT NULL,
    msg_date DATE NOT NULL, --ck >auction.date
    --"date" TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    user_id INTEGER REFERENCES users(user_id) NOT NULL,
    chat_id INTEGER REFERENCES chat(chat_id) NOT NULL
);





CREATE TABLE auction_report(
    description TEXT, --change name
    auction_id INTEGER REFERENCES auction(auction_id) NOT NULL,
    user_id INTEGER REFERENCES users(user_id) NOT NULL,
    PRIMARY KEY(auction_id, user_id)
);

CREATE TABLE rating(
    id_rated INTEGER REFERENCES users(user_id) NOT NULL,
    id_rates INTEGER REFERENCES users(user_id) NOT NULL CHECK (id_rated != id_rates),
    rate_value INTEGER NOT NULL CHECK (rate_value >= 0 AND rate_value <= 5),  --change name, < 5 ??
    rate_date DATE NOT NULL,    --change name
    PRIMARY KEY(id_rated, id_rates)
);

CREATE TABLE user_follow(
    id_followed INTEGER REFERENCES users(user_id) NOT NULL,
    id_follower INTEGER REFERENCES users(user_id) NOT NULL CHECK (id_followed != id_follower), 
    PRIMARY KEY(id_followed, id_follower)
);

CREATE TABLE auction_follow(
    id_followed INTEGER REFERENCES auction(auction_id) NOT NULL,
    id_follower INTEGER REFERENCES users(user_id) NOT NULL CHECK (id_followed != id_follower), 
    PRIMARY KEY(id_followed, id_follower)
);


CREATE TABLE user_notification(
    notif_id SERIAL PRIMARY KEY,
    notified_id INTEGER REFERENCES users(user_id) NOT NULL,
    notifier_id INTEGER REFERENCES users(user_id) NOT NULL,
    notif_read BOOLEAN DEFAULT FALSE,  --change name
    --notif_time TIME DEFAULT NOW, --change name
    notif_category user_notification_type NOT NULL  --change name
);

CREATE TABLE auction_notification(
    notif_id SERIAL PRIMARY KEY,
    notified_id INTEGER REFERENCES users(user_id) NOT NULL,
    auction_id INTEGER REFERENCES auction(auction_id) NOT NULL,
    anotif_read BOOLEAN DEFAULT FALSE,  --change name
    --anotif_time TIME DEFAULT NOW, --change name
    anotif_category auction_notification_type NOT NULL  --change name
);