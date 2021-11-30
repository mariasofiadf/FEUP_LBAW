--CREATE

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
    profile_image TEXT, 
    rating INTEGER DEFAULT 0 NOT NULL,
    blocked BOOLEAN DEFAULT FALSE NOT NULL,
    auction_notif BOOLEAN DEFAULT TRUE NOT NULL,
    user_notif BOOLEAN DEFAULT TRUE NOT NULL
);


CREATE TABLE bid(
    bid_id SERIAL PRIMARY KEY
);
CREATE TABLE image(
    img_id SERIAL PRIMARY KEY,
    content TEXT NOT NULL,
    label TEXT
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

CREATE TABLE message(
    msg_id SERIAL PRIMARY KEY,
    msg_content TEXT NOT NULL,
    msg_date DATE NOT NULL, --ck >auction.date
    user_id INTEGER REFERENCES users(user_id) NOT NULL,
    chat_id INTEGER REFERENCES chat(chat_id) NOT NULL
);





CREATE TABLE auction_report(
    description TEXT, 
    auction_id INTEGER REFERENCES auction(auction_id) NOT NULL,
    user_id INTEGER REFERENCES users(user_id) NOT NULL,
    PRIMARY KEY(auction_id, user_id)
);

CREATE TABLE rating(
    id_rated INTEGER REFERENCES users(user_id) NOT NULL,
    id_rates INTEGER REFERENCES users(user_id) NOT NULL CHECK (id_rated != id_rates),
    rate_value INTEGER NOT NULL CHECK (rate_value >= 0 AND rate_value <= 5),  --change name, < 5 ??
    rate_date DATE NOT NULL,    
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
    notif_read BOOLEAN DEFAULT FALSE,  
    --notif_time TIME DEFAULT NOW, --change name
    notif_category user_notification_type NOT NULL  
);

CREATE TABLE auction_notification(
    notif_id SERIAL PRIMARY KEY,
    notified_id INTEGER REFERENCES users(user_id) NOT NULL,
    auction_id INTEGER REFERENCES auction(auction_id) NOT NULL,
    anotif_read BOOLEAN DEFAULT FALSE,
    --anotif_time TIME DEFAULT NOW, --change name
    anotif_category auction_notification_type NOT NULL
);

--INDICES

DROP MATERIALIZED VIEW IF EXISTS fts_view_auctions;

CREATE MATERIALIZED VIEW fts_view_auctions AS
SELECT auction.auction_id, (setweight(to_tsvector('simple', auction.title), 'A')) as ts_auction
FROM auction
    JOIN bid ON bid.auction_id = auction.auction_id
WHERE
    bid.bid_value >= min_opening_bid AND
    auction.category IN ('ArtPiece', 'Book', 'Jewelry', 'Decor', 'Other') AND
    auction.status IN ('Active', 'Hidden', 'Canceled', 'Closed')
ORDER BY auction.auction_id;

DROP FUNCTION IF EXISTS auction_search_update CASCADE;
CREATE FUNCTION auction_search_update() RETURNS TRIGGER AS $$
BEGIN
    REFRESH MATERIALIZED VIEW fts_view_auctions;
    RETURN NULL;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER a_search_update
    AFTER INSERT OR UPDATE ON auction
    FOR EACH ROW
    EXECUTE PROCEDURE auction_search_update();


ALTER TABLE users ADD COLUMN tsvectors TSVECTOR;


DROP FUNCTION IF EXISTS u_search_update CASCADE;
CREATE FUNCTION u_search_update() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
            setweight(to_tsvector('english', NEW.username), 'A') ||
            setweight(to_tsvector('english', NEW.name), 'B')
        );
    END IF;
    IF TG_OP = 'UPDATE' THEN
        IF (NEW.username <> OLD.username OR NEW.name <> OLD.name) THEN
            NEW.tsvectors = (
            setweight(to_tsvector('english', NEW.username), 'A') ||
            setweight(to_tsvector('english', NEW.name), 'B')
            );
        END IF;
    END IF;
    RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER u_search_update
    AFTER INSERT OR UPDATE ON users
    FOR EACH ROW
    EXECUTE PROCEDURE u_search_update();

CREATE INDEX users_search_idx on users USING GIN (tsvectors);

CREATE INDEX auction_bid_index on bid USING hash(auction_id);


CREATE INDEX user_bid_index on bid USING hash(bidder_id);

CREATE INDEX auction_by_date ON auction USING btree (start_date);

CREATE INDEX auction_by_end_date ON auction USING btree (predicted_end);

CREATE INDEX auction_search_idx on auction USING GIN(ts_auction);

--TRIGGERS 

--TRIGGER 01
--An Admin must not have the same username nor email as a User
DROP FUNCTION IF EXISTS admin_diff_user CASCADE;
CREATE FUNCTION admin_diff_user() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF EXISTS (SELECT username FROM users WHERE NEW.username = users.username) THEN
        RAISE EXCEPTION 'An Admin must not have the same username as a User.';
    END IF;
    IF EXISTS (SELECT email FROM users WHERE NEW.email = users.email) THEN
        RAISE EXCEPTION 'An Admin must not have the same email as a User';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS admin_diff_user on admin CASCADE;
CREATE TRIGGER admin_diff_user
    BEFORE INSERT OR UPDATE ON admin 
    FOR EACH ROW 
    EXECUTE PROCEDURE admin_diff_user();

--TRIGGER 02
--A User must not have the same username nor email as an Admin
DROP FUNCTION IF EXISTS user_diff_admin CASCADE;
CREATE FUNCTION user_diff_admin() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM admin WHERE NEW.username = admin.username) THEN
        RAISE EXCEPTION 'A User must not have the same username as an Admin.';
	END IF;
    IF EXISTS (SELECT * FROM admin WHERE NEW.email = admin.email) THEN
        RAISE EXCEPTION 'A User must not have the same email as an Admin';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS user_diff_admin on users CASCADE;
CREATE TRIGGER user_diff_admin
    BEFORE INSERT OR UPDATE ON users 
    FOR EACH ROW 
    EXECUTE PROCEDURE user_diff_admin();

--TRIGGER 03
--A User cannot bid on one of their own auctions
DROP FUNCTION IF EXISTS user_bid CASCADE;
CREATE FUNCTION user_bid() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM auction WHERE NEW.bidder_id = auction.seller_id AND NEW.auction_id = auction.auction_id ) THEN
        RAISE EXCEPTION 'A user cannot bid on their own auction.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS user_bid on bid CASCADE;
CREATE TRIGGER user_bid
    BEFORE INSERT OR UPDATE ON bid 
    FOR EACH ROW 
    EXECUTE PROCEDURE user_bid();

--TRIGGER 04
--When an auction closes, the winning bid is set
DROP FUNCTION IF EXISTS win_bid CASCADE;
CREATE FUNCTION win_bid() RETURNS TRIGGER AS
$BODY$
DECLARE 
	max_bid INTEGER;
    bid_idd INTEGER;
BEGIN
	SELECT max(bid_value) INTO max_bid FROM bid WHERE bid.auction_id = NEW.auction_id;
	SELECT bid_id INTO bid_idd FROM bid WHERE bid.bid_value = max_bid AND bid.auction_id = NEW.auction_id;
    IF (NEW.status = 'Closed') THEN
        NEW.win_bid = bid_idd;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS win_bid on bid CASCADE;
CREATE TRIGGER win_bid
    BEFORE UPDATE ON auction 
    FOR EACH ROW 
    EXECUTE PROCEDURE win_bid();

--TRIGGER 05
--A User bid on an auction must be higher than the current highest 
DROP FUNCTION IF EXISTS min_bid CASCADE;
CREATE FUNCTION min_bid() RETURNS TRIGGER AS
$BODY$
DECLARE 
	max_bid INTEGER;
    min_inc INTEGER;
    min_bid INTEGER;
BEGIN
	SELECT max(bid_value) INTO max_bid FROM bid WHERE bid.auction_id = NEW.auction_id;
    SELECT min_raise INTO min_inc FROM auction WHERE NEW.auction_id = auction.auction_id;
    SELECT min_opening_bid INTO min_bid FROM auction WHERE NEW.auction_id = auction.auction_id;
    IF (min_bid > NEW.bid_value) THEN
        RAISE EXCEPTION 'New bid must be higher than the mininum opening bid';
    END IF;
    IF (max_bid + min_inc > NEW.bid_value) THEN
        RAISE EXCEPTION 'New bid must be higher than all the previous bids plus the minimum raise';
    END IF;
    
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS min_bid on bid CASCADE;
CREATE TRIGGER min_bid
    BEFORE INSERT ON bid 
    FOR EACH ROW 
    EXECUTE PROCEDURE min_bid();


--TRIGGER 06
--When an auction gets a new bid, the close_date gets increased
DROP FUNCTION IF EXISTS extend_auction CASCADE;
CREATE FUNCTION extend_auction() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE auction
    SET close_date = close_date + integer '1' --mudar?
    WHERE auction_id = NEW.auction_id;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS extend_auction on bid CASCADE;
CREATE TRIGGER extend_auction
    BEFORE INSERT ON bid 
    FOR EACH ROW 
    EXECUTE PROCEDURE extend_auction();


--TRIGGER 07
--When User receives rating, their rating is updated
DROP FUNCTION IF EXISTS new_rating CASCADE;
CREATE FUNCTION new_rating() RETURNS TRIGGER AS 
$BODY$
DECLARE
    rate_count INTEGER;
BEGIN
    SELECT COUNT(*) INTO rate_count FROM rating 
    WHERE rating.id_rated = NEW.id_rated;

    UPDATE users
        SET rating = ((users.rating * rate_count)+NEW.rate_value)/(rate_count+1)
        WHERE users.user_id = NEW.id_rated;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS new_rating on bid CASCADE;
CREATE TRIGGER new_rating
    BEFORE INSERT ON rating 
    FOR EACH ROW 
    EXECUTE PROCEDURE new_rating();

--TRIGGER 08
--When a User changes their rating of another User, the rating of the rated user is updated
DROP FUNCTION IF EXISTS update_rating CASCADE;
CREATE FUNCTION update_rating() RETURNS TRIGGER AS 
$BODY$
DECLARE
    rate_count INTEGER;
BEGIN
    SELECT COUNT(*) INTO rate_count FROM rating 
    WHERE rating.id_rated = NEW.id_rated;

    UPDATE users
        SET rating = ((users.rating * rate_count) - OLD.rate_value + NEW.rate_value)/(rate_count)
        WHERE users.user_id = NEW.id_rated;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_rating on bid CASCADE;
CREATE TRIGGER update_rating
    BEFORE UPDATE ON rating 
    FOR EACH ROW 
    EXECUTE PROCEDURE update_rating();


--TRIGGER 09
--When a User removes their rating of another User, the rating of the previously rated user is updated
DROP FUNCTION IF EXISTS delete_rating CASCADE;
CREATE FUNCTION delete_rating() RETURNS TRIGGER AS 
$BODY$
DECLARE
    rate_count INTEGER;
BEGIN
    SELECT COUNT(*) INTO rate_count FROM rating 
    WHERE rating.id_rated = NEW.id_rated;
    IF rate_count > 0 THEN
        UPDATE users
        SET rating = ((users.rating * rate_count) - OLD.rate_value)/(rate_count-1)
        WHERE users.user_id = NEW.id_rated;
    ELSE 
        UPDATE users
        SET rating = 0
        WHERE users.user_id = NEW.id_rated;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS delete_rating on bid CASCADE;
CREATE TRIGGER delete_rating
    AFTER DELETE ON rating 
    FOR EACH ROW 
    EXECUTE PROCEDURE delete_rating();

--TRIGGER 10
--When a User is followed they must get a "Follow" user_notification
DROP FUNCTION IF EXISTS new_follow_notif CASCADE;
CREATE FUNCTION new_follow_notif() RETURNS TRIGGER AS 
$BODY$
BEGIN
    INSERT INTO user_notification(notified_id, notifier_id, notif_category)
    VALUES (NEW.id_followed, NEW.id_follower,'Follow');
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS new_follow_notif on bid CASCADE;
CREATE TRIGGER new_follow_notif
    AFTER INSERT ON user_follow 
    FOR EACH ROW 
    EXECUTE PROCEDURE new_follow_notif();

--TRIGGER 11
--When a User receives a rating they must get a "Rating" user_notification
DROP FUNCTION IF EXISTS new_rating_notif CASCADE;
CREATE FUNCTION new_rating_notif() RETURNS TRIGGER AS 
$BODY$
BEGIN
    INSERT INTO user_notification(notified_id, notifier_id, notif_category)
    VALUES (NEW.id_rated, NEW.id_rates,'Rating');
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS new_rating_notif on bid CASCADE;
CREATE TRIGGER new_rating_notif
    AFTER INSERT ON rating 
    FOR EACH ROW 
    EXECUTE PROCEDURE new_rating_notif();

--TRIGGER 12
--When a User follows an Auction, it's owner gets a notification
DROP FUNCTION IF EXISTS new_auction_follow_notif CASCADE;
CREATE FUNCTION new_auction_follow_notif() RETURNS TRIGGER AS 
$BODY$
DECLARE
    seller_id INTEGER;
BEGIN
    SELECT auction.seller_id INTO seller_id FROM auction 
    WHERE auction.auction_id = NEW.id_followed;
    INSERT INTO auction_notification(notified_id, auction_id, anotif_category)
    VALUES (seller_id, NEW.id_followed,'Auction Follow');
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS new_auction_follow_notif on bid CASCADE;
CREATE TRIGGER new_auction_follow_notif
    AFTER INSERT ON auction_follow 
    FOR EACH ROW 
    EXECUTE PROCEDURE new_auction_follow_notif();

--TRIGGER 13
--When an auction is created, all of the creater's followers get notified
DROP FUNCTION IF EXISTS new_auction_notif CASCADE;
CREATE FUNCTION new_auction_notif() RETURNS TRIGGER AS 
$BODY$
DECLARE
    rec RECORD;
BEGIN
    FOR rec IN SELECT id_follower FROM user_follow
    WHERE id_followed = NEW.seller_id
    LOOP
        INSERT INTO auction_notification(notified_id, auction_id, anotif_category)
        VALUES(rec.id_follower,NEW.auction_id,'Opened');
    END LOOP;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS new_auction_notif on bid CASCADE;
CREATE TRIGGER new_auction_notif
    AFTER INSERT ON auction 
    FOR EACH ROW 
    EXECUTE PROCEDURE new_auction_notif();

--TRIGGER 14
--When an auction is closed, all of the creater's followers get notified
DROP FUNCTION IF EXISTS auction_closed_notif CASCADE;
CREATE FUNCTION auction_closed_notif() RETURNS TRIGGER AS 
$BODY$
DECLARE
    rec RECORD;
BEGIN
    FOR rec IN SELECT id_follower FROM user_follow
    WHERE id_followed = NEW.seller_id
    LOOP
        IF NEW.status = 'Closed' AND OLD.status = 'Active' THEN
            INSERT INTO auction_notification(notified_id, auction_id, anotif_category)
            VALUES(rec.id_follower,NEW.auction_id,'Closed');
        END IF;
    END LOOP;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS auction_closed_notif on bid CASCADE;
CREATE TRIGGER auction_closed_notif
    AFTER UPDATE ON auction 
    FOR EACH ROW 
    EXECUTE PROCEDURE auction_closed_notif();

--TRIGGER 15
--When an auction's chat gets new message, all of that auction's followers get notified
DROP FUNCTION IF EXISTS new_message_notif CASCADE;
CREATE FUNCTION new_message_notif() RETURNS TRIGGER AS 
$BODY$
DECLARE
    rec RECORD;
    auction_id INTEGER;
BEGIN
    SELECT chat.auction_id INTO auction_id FROM chat WHERE chat.chat_id = NEW.chat_id;
    FOR rec IN SELECT id_follower FROM auction_follow
    WHERE id_followed = auction_id
    LOOP
        INSERT INTO auction_notification(notified_id, auction_id, anotif_category)
        VALUES(rec.id_follower,auction_id,'New Message');
    END LOOP;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS new_message_notif on bid CASCADE;
CREATE TRIGGER new_message_notif
    AFTER INSERT ON message 
    FOR EACH ROW 
    EXECUTE PROCEDURE new_message_notif();

--TRIGGER 16
--When an auction gets a new bid, all of that auction's bidders get notified
DROP FUNCTION IF EXISTS new_bid_notif CASCADE;
CREATE FUNCTION new_bid_notif() RETURNS TRIGGER AS 
$BODY$
DECLARE
    rec RECORD;
BEGIN
    FOR rec IN SELECT bidder_id FROM bid
    WHERE bid.auction_id = NEW.auction_id 
    LOOP
        INSERT INTO auction_notification(notified_id, auction_id, anotif_category)
        VALUES(rec.bidder_id,NEW.auction_id,'New Bid');
    END LOOP;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS new_bid_notif on bid CASCADE;
CREATE TRIGGER new_bid_notif
    AFTER INSERT ON bid 
    FOR EACH ROW 
    EXECUTE PROCEDURE new_bid_notif();
