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

END TRANSACTION;