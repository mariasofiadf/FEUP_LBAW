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
    IF EXISTS (SELECT * FROM users WHERE NEW.username = admin.username) THEN
        RAISE EXCEPTION 'A User must not have the same username as an Admin.';
	END IF;
    IF EXISTS (SELECT * FROM users WHERE NEW.email = admin.email) THEN
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
    IF EXISTS (SELECT * FROM auction WHERE NEW.bidder_id = auction.seller_id AND NEW.auction_id = auction.id ) THEN
        RAISE EXCEPTION 'A member cannot bid on their own auction.';
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
--When an auction gets a new bid, last_bid is updated
DROP FUNCTION IF EXISTS last_bid CASCADE;
CREATE FUNCTION last_bid() RETURNS TRIGGER AS 
$BODY$
BEGIN
    UPDATE auction
        SET last_bid = NEW.id
        WHERE auction.id = NEW.auction_id;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS last_bid on bid CASCADE;
CREATE TRIGGER last_bid
    AFTER INSERT OR UPDATE ON bid 
    FOR EACH ROW 
    EXECUTE PROCEDURE last_bid();

--TRIGGER 05
--When an auction closes, the winning bid is set
DROP FUNCTION IF EXISTS win_bid CASCADE;
CREATE FUNCTION win_bid() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF (NEW.auction_status = 'Closed') THEN
        UPDATE auction
            SET win_bid = auction.last_bid
            WHERE NEW.id = auction.id;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS win_bid on bid CASCADE;
CREATE TRIGGER win_bid
    AFTER UPDATE ON auction 
    FOR EACH ROW 
    EXECUTE PROCEDURE win_bid();


--TRIGGER 05
--When User received rating, their rating is updated
DROP FUNCTION IF EXISTS update_rating CASCADE;
CREATE FUNCTION update_rating() RETURNS TRIGGER AS 
$BODY$
DECLARE
    rate_count INTEGER;
BEGIN
    SELECT COUNT(*) INTO rate_count FROM rating 
    WHERE rating.id_rated = NEW.id_rated;

    UPDATE users
        SET rating = ((users.rating * rate_count)+NEW.rate_value)/(rate_count+1)
        WHERE users.id = NEW.id_rated;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_rating on bid CASCADE;
CREATE TRIGGER update_rating
    BEFORE INSERT ON rating 
    FOR EACH ROW 
    EXECUTE PROCEDURE update_rating();