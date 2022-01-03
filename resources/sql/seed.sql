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
    user_notif BOOLEAN DEFAULT TRUE NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE NOT NULL,
    deleted BOOLEAN DEFAULT FALSE NOT NULL
);


CREATE TABLE bid(
    bid_id SERIAL PRIMARY KEY
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
    win_bid INTEGER REFERENCES bid(bid_id)
);

CREATE TABLE image(
    img_id SERIAL PRIMARY KEY,
    content TEXT NOT NULL,
    label TEXT,
    auction INTEGER REFERENCES auction(auction_id)
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
    notif_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    --notif_time TIME DEFAULT NOW, --change name
    notif_category user_notification_type NOT NULL  
);

CREATE TABLE auction_notification(
    notif_id SERIAL PRIMARY KEY,
    notified_id INTEGER REFERENCES users(user_id) NOT NULL,
    auction_id INTEGER REFERENCES auction(auction_id) NOT NULL,
    anotif_read BOOLEAN DEFAULT FALSE,
    anotif_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
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

--CREATE INDEX auction_search_idx on auction USING GIN(ts_auction);


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

-- images

INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked,auction_notif,user_notif) VALUES (1,'Bruno Silva','bsilva','$2y$10$mp6HMsGu4VcblGpki0HdR.4LwB2qHR8c9oOpU6Jlbt4RTdIQpkG1W','bsilva@hotmail.com',169335936,10000,'bsilva.jpg',4,False,TRUE,TRUE);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked,auction_notif,user_notif) VALUES (2,'Laura Rocha','lrocha','$2y$10$LnAa8f4AB0f5Ttrrf3yC0eEjpIJkQoek9thQ033t79IZD3GX7cx8S','lrocha@hotmail.com',934004312,2000,'lrocha.jpg',3,False,TRUE,TRUE);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked,auction_notif,user_notif) VALUES (3,'Carlos Lima','clima','$2y$10$bdRPzv0rSN3HwH/3Gus8y.7MkV1aPDgRgI.S.2Jly037qRoN7orM6','clima@gmail.com',639376003,32000,'clima.jpg',2,False,TRUE,TRUE);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked,auction_notif,user_notif) VALUES (4,'Diana Sagres','dsagres','$2y$10$Rr3Y4V44M5WT7uVwmjYAdulX2ON5wrUM2pDN6AqafKYKYfYcipaLK','dsagres@yahoo.com.br',948003605,1000,'dsagres.jpg',1,False,TRUE,TRUE);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked,auction_notif,user_notif) VALUES (5,'Miguel Ferreira','mferreira','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','teste@gmail.com',639230752,200,'mferreira.jpg',5,False,TRUE,TRUE);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked,auction_notif,user_notif) VALUES (6,'Prof','prof','$2y$10$TfOaUPoQ6PiB4lqVOEQbJuhKvALYIpg.dpF3j12JtnfllI4vJk/u2','prof@gmail.com',222333444,200,'prof.jpg',5,False,TRUE,TRUE);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked,auction_notif,user_notif, is_admin) VALUES (7,'Admin','admin','$2y$10$TfOaUPoQ6PiB4lqVOEQbJuhKvALYIpg.dpF3j12JtnfllI4vJk/u2','admin@gmail.com',111222333,200,'admin.jpg',5,False,TRUE,TRUE, TRUE);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked,auction_notif,user_notif, is_admin) VALUES (8,'Maria Figueiredo','mariasofia','$2y$10$Yrf1rchGJSdFdfqk9988Xuqy9ycie/audwgA.RmElpE/0sysnEQwm','mary@gmail.com',0,200,'maria.jpg',5,False,TRUE,TRUE, FALSE);



SELECT setval(pg_get_serial_sequence('users', 'user_id'), coalesce(max(user_id)+1, 1), false) FROM users;

-- auction
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,seller_id) VALUES (100,'Victorian Chair', '19th century velvet red chair, with wooden details',1000,100,'2021-11-28','2021-11-30','2021-11-30','Active','Decor', 3);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,seller_id) VALUES (101,'18th Century Coffee Table', 'Coffee table from the 18th Century in wood with top made of stone',850,150,'2021-12-01','2021-12-07','2021-12-08','Active','Decor', 5);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,seller_id) VALUES (102,'Egyptian Necklace', 'Old Kingdom (circa 2670–2195 B.C.) necklace made of gold',11000,500,'2022-01-01','2022-01-03','2022-01-04','Active','Jewelry', 3);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,seller_id) VALUES (103,'Sherlock Holmes Original 1976 Collection', '15 books with hard cover and golden incrusted letters',550,50,'2022-01-12','2022-01-15','2022-01-16','Active','Book', 4);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,seller_id) VALUES (104,'Agatha Christie Collections 1960-1969 and 1970-1979', 'Agatha Christie Best Sellers from the 60s and 70s',1000,100,'2022-01-13','2022-01-15','2022-01-16','Active','Book', 4);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,seller_id) VALUES (105,'Impressionist Lake Painting by Vlaminck', 'Small unknown painting by Maurice Vlaminck from 1896',540000,1000,'2022-01-18','2022-01-19','2022-01-20','Active','ArtPiece', 3);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,seller_id) VALUES (106,'Real Degas', 'From 1999',770000,10000,'2022-01-20','2022-01-29','2022-01-30','Canceled','ArtPiece', 1);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,seller_id) VALUES (107,'LBAW Secrets', 'From 2021',500,100,'2022-01-20','2022-01-29','2022-01-30','Active','Book', 6);
SELECT setval(pg_get_serial_sequence('auction', 'auction_id'), coalesce(max(auction_id)+1, 1), false) FROM auction;

-- bid

INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (200,1100,'2021-11-28',100,2);
INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (201,1200,'2021-11-28',100,1);
INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (202,1300,'2021-11-28',100,4);
INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (203,1000,'2021-12-02',101,3);
INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (204,1150,'2021-12-03',101,4);
SELECT setval(pg_get_serial_sequence('bid', 'bid_id'), coalesce(max(bid_id)+1, 1), false) FROM bid;

--admin

-- INSERT INTO admin(admin_id,admin_name,username,admin_password,email) VALUES (0101,'group07','theadmin07','$2y$10$zGewf6.Cq2kJnQKWidswRuI.kXUAWaRlxbZcdv6am3FfgkzhRmMru','up201806102@fe.up.pt');


-- chat(chat_id,auction_id)

-- INSERT INTO chat (chat_id,auction_id) VALUES (300,100);
-- INSERT INTO chat (chat_id,auction_id) VALUES (301,101);
-- INSERT INTO chat (chat_id,auction_id) VALUES (302,102);
-- INSERT INTO chat (chat_id,auction_id) VALUES (303,103);
-- INSERT INTO chat (chat_id,auction_id) VALUES (304,104);
-- INSERT INTO chat (chat_id,auction_id) VALUES (305,105);


--message(msg_id,msg_content,msg_date,user_id,chat_id)

-- Victorian Chair, '2021-11-28','2021-11-30','2021-11-30', seller 3, chat id 30
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (400, 'Hello, who is the artisan?', '2021-11-28', 1, 300);
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (401, 'Hello, who is the artisan?', '2021-11-29', 2, 300);
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (402, 'Hello, who is the artisan?', '2021-11-30', 4, 300);
-- --'18th Century Coffee Table','2021-12-01','2021-12-07','2021-12-08' seller 5, chat id 31
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (403, 'How much does it weight?', '2021-12-02', 1,301);
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (404, 'It weights around 30kg', '2021-12-03', 5, 301);
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (405, 'Is it built in modules?', '2021-12-04', 2, 301);
-- --'Egyptian Necklace','2022-01-01','2022-01-03','2022-01-04',seller id 3, chat id 33
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (406, 'How much does it weight?', '2022-01-01', 4, 302);
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (407, 'It weights around 350g', '2022-01-02', 3, 302);
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (408, 'What type is the gem in the centre?', '2022-01-02', 4, 302);
-- --'Sherlock Holmes Original 1976 Collection','2022-01-12','2022-01-15','2022-01-16', 4
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (409, 'What is the state of the books?', '2022-01-12', 5, 303);
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (410, 'Apart from the collection box, the books have tiny scratches', '2022-01-14', 4, 303);
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (411, 'Is there anything written inside?', '2022-01-15', 2, 303);
-- -- 'Agatha Christie Collections 1960-1969 and 1970-1979','2022-01-13','2022-01-15','2022-01-16',seller id 4);
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (412, 'What is the state of the books?', '2022-01-13', 1, 304);
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (413, 'Apart from the collection box, the books have tiny scratches', '2022-01-13', 4, 304);
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (414, 'Is there anything written inside?', '2022-01-14', 2, 304);
-- -- 'Impressionist Lake Painting by Vlaminck','2022-01-18','2022-01-19','2022-01-20',seller id 3);
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (415, 'Does it have Certificate of Authenticity?', '2022-01-18', 5, 305);
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (416, 'When was the Certificate made?', '2022-01-18', 1, 305);
-- INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (417, 'The Certificate of Authenticity is from 2015.', '2022-01-19', 3, 305);


-- auction_report(description, auction_id, user_id)

-- INSERT INTO auction_report (description, auction_id, user_id) VALUES ('', 106, 5);


-- rating (id_rated,id_rates,rate_value,rate_date)

-- INSERT INTO rating (id_rated,id_rates,rate_value,rate_date) VALUES (3, 1, 2, '2021-12-20');
-- INSERT INTO rating (id_rated,id_rates,rate_value,rate_date) VALUES (3, 2, 4, '2021-12-21');
-- INSERT INTO rating (id_rated,id_rates,rate_value,rate_date) VALUES (3, 4, 5, '2021-12-21');
-- INSERT INTO rating (id_rated,id_rates,rate_value,rate_date) VALUES (3, 5, 3, '2021-12-22');
-- INSERT INTO rating (id_rated,id_rates,rate_value,rate_date) VALUES (4, 2, 5, '2021-12-22');
-- INSERT INTO rating (id_rated,id_rates,rate_value,rate_date) VALUES (4, 3, 3, '2021-12-26');
-- INSERT INTO rating (id_rated,id_rates,rate_value,rate_date) VALUES (5, 4, 4, '2021-12-27');


-- user_follow (id_followed,id_follower)

-- INSERT INTO user_follow (id_followed,id_follower) VALUES (2,1);
-- INSERT INTO user_follow (id_followed,id_follower) VALUES (2,3);
-- INSERT INTO user_follow (id_followed,id_follower) VALUES (2,4);
-- INSERT INTO user_follow (id_followed,id_follower) VALUES (2,5);
-- INSERT INTO user_follow (id_followed,id_follower) VALUES (3,2);
-- INSERT INTO user_follow (id_followed,id_follower) VALUES (3,4);
-- INSERT INTO user_follow (id_followed,id_follower) VALUES (4,5);
-- INSERT INTO user_follow (id_followed,id_follower) VALUES (5,4);



-- -- auction_follow(id_followed,id_follower)

-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (100,2);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (100,4);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (100,5);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (100,1);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (101,1);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (101,2);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (101,3);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (101,4);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (102,1);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (102,2);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (102,4);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (102,5);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (103,5);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (103,3);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (103,2);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (104,5);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (104,1);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (104,2);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (104,3);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (105,2);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (105,3);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (105,4);
-- INSERT INTO auction_follow (id_followed,id_follower) VALUES (105,1);



-- -- user_notification(notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category)

-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (601, 3, 1, TRUE, '12/12/2021 07:02:49 AM', 'Rating');
-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (602, 3, 2, TRUE, '12/12/2021 08:12:38 AM', 'Rating');
-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (603, 3, 4, TRUE, '12/12/2021 10:22:47 PM', 'Rating');
-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (604, 3, 5, TRUE, '12/12/2021 11:32:26 AM', 'Rating');
-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (605, 4, 2, TRUE, '12/12/2021 04:42:45 PM', 'Rating');
-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (606, 4, 3, TRUE, '12/26/2021 02:52:14 AM', 'Rating');
-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (607, 5, 4, TRUE, '12/27/2021 03:12:53 AM', 'Rating');
-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (608, 2, 1, TRUE, '12/09/2021 07:02:49 AM','Follow');
-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (609, 2, 3, TRUE, '12/10/2021 10:22:47 PM','Follow');
-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (610, 2, 4, TRUE, '12/11/2021 11:32:26 AM','Follow');
-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (611, 2, 5, TRUE, '12/12/2021 07:02:49 AM','Follow');
-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (612, 3, 2, TRUE, '12/13/2021 03:12:53 AM','Follow');
-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (613, 3, 4, TRUE, '12/14/2021 02:52:14 AM','Follow');
-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (614, 4, 5, TRUE, '12/15/2021 04:42:45 PM','Follow');
-- INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (615, 5, 4, TRUE, '12/16/2021 04:02:05 PM','Follow');



-- -- auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category)

-- INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (701, 2, 100, TRUE, '12/28/2021 07:02:49 AM', 'New Bid');
-- INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (702, 1, 100, TRUE, '12/28/2021 03:12:53 AM', 'New Bid');
-- INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (703, 4, 100, TRUE, '12/28/2021 02:52:14 AM', 'New Bid');
-- INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (704, 3, 101, TRUE, '12/02/2021 04:42:45 PM', 'New Bid');
-- INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (705, 4, 101, TRUE, '12/03/2021 04:02:05 PM', 'New Bid');
-- INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (706, 3, 105, TRUE, '12/27/2021 03:12:53 AM','New Message');
-- INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (707, 3, 105, TRUE, '12/09/2021 07:02:49 AM','New Message');
-- INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (708, 3, 105, TRUE, '12/10/2021 10:22:47 PM','New Message');







