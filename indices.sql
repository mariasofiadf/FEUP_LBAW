

CREATE INDEX auction_bid_index on bid USING hash(auction_id);


CREATE INDEX user_bid_index on bid USING hash(bidder_id);


CREATE INDEX auction_by_date ON auction USING btree (start_date);