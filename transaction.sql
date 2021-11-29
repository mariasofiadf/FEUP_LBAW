--BEGIN TRANSACTION;
--SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;
--
---- update bidder credit
--UPDATE users SET credit = credit - $bid_value WHERE id = $bidder_id;
--
---- insert bid
--INSERT INTO bid (bid_value,bid_date,auction_id,bidder_id)
--VALUES ($bid_value, $bid_date,$auction_id, $bidder_id );
--
--COMMIT;
--

BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;

-- get bid history
SELECT member.username as username, bid.bid_value as value, bid.bid_date as "date"
	FROM bid 
	INNER JOIN users
	ON users.user_id = bid.bidder_id AND bid.auction_id = $auction_id
	ORDER BY value DESC;

-- get highest bid
SELECT bid.bid_value as value
	FROM bid
	WHERE auction.auction_id = bid.auction_id
	ORDER BY value DESC LIMIT 1;

COMMIT;