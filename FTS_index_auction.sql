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