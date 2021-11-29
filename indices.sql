SELECT auction.id, ts_auction(auction.ts_search, plainto_tsquery('english', $search_text))
    FROM auction
            INNER JOIN auction_follow ON auction_follow.id_followed = auction.id AND auction_follow.follower_id = users.id
            INNER JOIN bid ON bid.auction_id = auction.id 
        WHERE
            auction.category IN ($category1, $category2, ...) AND
            auction.status IN ($status1, $status2) AND
            bid.value >= min_opening_bid::money AND
            auction.ts_search @@ plainto_tsquery('english', $text_search)
        ORDER BY ts_auction DESC;

CREATE INDEX auction_search_idx USING GIN (ts_auction);


ALTER TABLE users ADD COLUMN tsvectors TSVECTOR;

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
    BEFORE INSERT OR UPDATE ON users
    FOR EACH ROW
    EXECUTE PROCEDURE u_search_update();

CREATE INDEX users_search_idx USING GIN (tsvectors);

CREATE INDEX auction_bid_index on bid USING hash(auction_id);


CREATE INDEX user_bid_index on bid USING hash(bidder_id);


CREATE INDEX auction_by_date ON auction USING btree (start_date);