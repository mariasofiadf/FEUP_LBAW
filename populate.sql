-- images
INSERT INTO images (img_id,content,label) VALUES (500,'victorianchair.jpg','chair');
INSERT INTO images (img_id,content,label) VALUES (501,'coffeetable.jpg','coffeetable');
INSERT INTO images (img_id,content,label) VALUES (502,'egyptiannecklace.jpg','egyptiannecklace');
INSERT INTO images (img_id,content,label) VALUES (503,'sherlockholmes.jpg','sherlockholmes');
INSERT INTO images (img_id,content,label) VALUES (504,'agathachristie.jpg','agathachristie');
INSERT INTO images (img_id,content,label) VALUES (505,'impressionistpainting.jpg','impressionistpainting');
INSERT INTO images (img_id,content,label) VALUES (506,'','');

-- users
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked,auction_notif,user_notif) VALUES (1,'Bruno Silva','bsilva','$2y$10$mp6HMsGu4VcblGpki0HdR.4LwB2qHR8c9oOpU6Jlbt4RTdIQpkG1W','bsilva@hotmail.com',169335936,10000,'bsilva.jpg',4,False,TRUE,TRUE);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked,auction_notif,user_notif) VALUES (2,'Laura Rocha','lrocha','$2y$10$LnAa8f4AB0f5Ttrrf3yC0eEjpIJkQoek9thQ033t79IZD3GX7cx8S','lrocha@hotmail.com',934004312,2000,'lrocha.jpg',3,False,TRUE,TRUE);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked,auction_notif,user_notif) VALUES (3,'Carlos Lima','clima','$2y$10$bdRPzv0rSN3HwH/3Gus8y.7MkV1aPDgRgI.S.2Jly037qRoN7orM6','clima@gmail.com',639376003,32000,'clima.jpg',2,False,TRUE,TRUE);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked,auction_notif,user_notif) VALUES (4,'Diana Sagres','dsagres','$2y$10$Rr3Y4V44M5WT7uVwmjYAdulX2ON5wrUM2pDN6AqafKYKYfYcipaLK','dsagres@yahoo.com.br',948003605,1000,'dsagres.jpg',1,False,TRUE,TRUE);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked,auction_notif,user_notif) VALUES (5,'Miguel Ferreira','mferreira','$2y$10$nuEhKrKvBTXffcllNcPfkuD52u0ln7k/VqnmB6VpnrKqCVZZ9.Ycy','mferreira@gmail.com',639230752,200,'mferreira.jpg',5,False,TRUE,TRUE);


-- auction
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,auction_image,seller_id) VALUES (100,'Victorian Chair', '19th century velvet red chair, with wooden details',1000,100,'2021-11-28','2021-11-30','2021-11-30','Active','Decor', 500, 3);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,auction_image,seller_id) VALUES (101,'18th Century Coffee Table', 'Coffee table from the 18th Century in wood with top made of stone',850,150,'2021-12-01','2021-12-07','2021-12-08','Active','Decor', 501, 5);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,auction_image,seller_id) VALUES (102,'Egyptian Necklace', 'Old Kingdom (circa 2670–2195 B.C.) necklace made of gold',11000,500,'2022-01-01','2022-01-03','2022-01-04','Active','Jewelry', 502, 3);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,auction_image,seller_id) VALUES (103,'Sherlock Holmes Original 1976 Collection', '15 books with hard cover and golden incrusted letters',550,50,'2022-01-12','2022-01-15','2022-01-16','Active','Book', 503, 4);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,auction_image,seller_id) VALUES (104,'Agatha Christie Collections 1960-1969 and 1970-1979', 'Agatha Christie Best Sellers from the 60s and 70s',1000,100,'2022-01-13','2022-01-15','2022-01-16','Active','Book', 504, 4);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,auction_image,seller_id) VALUES (105,'Impressionist Lake Painting by Vlaminck', 'Small unknown painting by Maurice Vlaminck from 1896',540000,1000,'2022-01-18','2022-01-19','2022-01-20','Active','ArtPiece', 505, 3);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,auction_image,seller_id) VALUES (106,'Real Degas', 'From 1999',770000,10000,'2022-01-20','2022-01-29','2022-01-30','Canceled','ArtPiece', 506, 1);

-- bid

INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (200,1100,'2021-11-28',100,2);
INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (201,1200,'2021-11-28',100,1);
INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (202,1300,'2021-11-28',100,4);
INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (203,1000,'2021-12-02',101,3);
INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (204,1150,'2021-12-03',101,4);


-- chat(chat_id,auction_id)

INSERT INTO chat (chat_id,auction_id) VALUES (300,100);
INSERT INTO chat (chat_id,auction_id) VALUES (301,101);
INSERT INTO chat (chat_id,auction_id) VALUES (302,102);
INSERT INTO chat (chat_id,auction_id) VALUES (303,103);
INSERT INTO chat (chat_id,auction_id) VALUES (304,104);
INSERT INTO chat (chat_id,auction_id) VALUES (305,105);


--message(msg_id,msg_content,msg_date,user_id,chat_id)

-- Victorian Chair, '2021-11-28','2021-11-30','2021-11-30', seller 3, chat id 30
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (400, 'Hello, who is the artisan?', '2021-11-28', 1, 300);
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (401, 'Hello, who is the artisan?', '2021-11-29', 2, 300);
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (402, 'Hello, who is the artisan?', '2021-11-30', 4, 300);
--'18th Century Coffee Table','2021-12-01','2021-12-07','2021-12-08' seller 5, chat id 31
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (403, 'How much does it weight?', '2021-12-02', 1,301);
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (404, 'It weights around 30kg', '2021-12-03', 5, 301);
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (405, 'Is it built in modules?', '2021-12-04', 2, 301);
--'Egyptian Necklace','2022-01-01','2022-01-03','2022-01-04',seller id 3, chat id 33
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (406, 'How much does it weight?', '2022-01-01', 4, 302);
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (407, 'It weights around 350g', '2022-01-02', 3, 302);
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (408, 'What type is the gem in the centre?', '2022-01-02', 4, 302);
--'Sherlock Holmes Original 1976 Collection','2022-01-12','2022-01-15','2022-01-16', 4
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (409, 'What is the state of the books?', '2022-01-12', 5, 303);
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (410, 'Apart from the collection box, the books have tiny scratches', '2022-01-14', 4, 303);
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (411, 'Is there anything written inside?', '2022-01-15', 2, 303);
-- 'Agatha Christie Collections 1960-1969 and 1970-1979','2022-01-13','2022-01-15','2022-01-16',seller id 4);
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (412, 'What is the state of the books?', '2022-01-13', 1, 304);
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (413, 'Apart from the collection box, the books have tiny scratches', '2022-01-13', 4, 304);
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (414, 'Is there anything written inside?', '2022-01-14', 2, 304);
-- 'Impressionist Lake Painting by Vlaminck','2022-01-18','2022-01-19','2022-01-20',seller id 3);
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (415, 'Does it have Certificate of Authenticity?', '2022-01-18', 5, 305);
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (416, 'When was the Certificate made?', '2022-01-18', 1, 305);
INSERT INTO message (msg_id,msg_content,msg_date,user_id,chat_id) VALUES (417, 'The Certificate of Authenticity is from 2015.', '2022-01-19', 3, 305);


-- auction_report(description, auction_id, user_id)

INSERT INTO auction_report (description, auction_id, user_id) VALUES ('', 106, 5);


-- rating (id_rated,id_rates,rate_value,rate_date)

INSERT INTO rating (id_rated,id_rates,rate_value,rate_date) VALUES (3, 1, 2, '2021-12-20');
INSERT INTO rating (id_rated,id_rates,rate_value,rate_date) VALUES (3, 2, 4, '2021-12-21');
INSERT INTO rating (id_rated,id_rates,rate_value,rate_date) VALUES (3, 4, 5, '2021-12-21');
INSERT INTO rating (id_rated,id_rates,rate_value,rate_date) VALUES (3, 5, 3, '2021-12-22');
INSERT INTO rating (id_rated,id_rates,rate_value,rate_date) VALUES (4, 2, 5, '2021-12-22');
INSERT INTO rating (id_rated,id_rates,rate_value,rate_date) VALUES (4, 3, 3, '2021-12-26');
INSERT INTO rating (id_rated,id_rates,rate_value,rate_date) VALUES (5, 4, 4, '2021-12-27');


-- user_follow (id_followed,id_follower)

INSERT INTO user_follow (id_followed,id_follower) VALUES (2,1);
INSERT INTO user_follow (id_followed,id_follower) VALUES (2,3);
INSERT INTO user_follow (id_followed,id_follower) VALUES (2,4);
INSERT INTO user_follow (id_followed,id_follower) VALUES (2,5);
INSERT INTO user_follow (id_followed,id_follower) VALUES (3,2);
INSERT INTO user_follow (id_followed,id_follower) VALUES (3,4);
INSERT INTO user_follow (id_followed,id_follower) VALUES (4,5);
INSERT INTO user_follow (id_followed,id_follower) VALUES (5,4);



-- auction_follow(id_followed,id_follower)

INSERT INTO auction_follow (id_followed,id_follower) VALUES (100,2);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (100,4);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (100,5);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (100,1);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (101,1);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (101,2);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (101,3);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (101,4);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (102,1);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (102,2);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (102,4);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (102,5);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (103,5);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (103,3);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (103,2);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (104,5);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (104,1);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (104,2);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (104,3);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (105,2);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (105,3);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (105,4);
INSERT INTO auction_follow (id_followed,id_follower) VALUES (105,1);



-- user_notification(notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category)

INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (601, 3, 1, TRUE, '12/12/2021 07:02:49 AM', 'Rating');
INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (602, 3, 2, TRUE, '12/12/2021 08:12:38 AM', 'Rating');
INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (603, 3, 4, TRUE, '12/12/2021 10:22:47 PM', 'Rating');
INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (604, 3, 5, TRUE, '12/12/2021 11:32:26 AM', 'Rating');
INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (605, 4, 2, TRUE, '12/12/2021 04:42:45 PM', 'Rating');
INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (606, 4, 3, TRUE, '12/26/2021 02:52:14 AM', 'Rating');
INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (607, 5, 4, TRUE, '12/27/2021 03:12:53 AM', 'Rating');
INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (608, 2, 1, TRUE, '12/09/2021 07:02:49 AM','Follow');
INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (609, 2, 3, TRUE, '12/10/2021 10:22:47 PM','Follow');
INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (610, 2, 4, TRUE, '12/11/2021 11:32:26 AM','Follow');
INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (611, 2, 5, TRUE, '12/12/2021 07:02:49 AM','Follow');
INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (612, 3, 2, TRUE, '12/13/2021 03:12:53 AM','Follow');
INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (613, 3, 4, TRUE, '12/14/2021 02:52:14 AM','Follow');
INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (614, 4, 5, TRUE, '12/15/2021 04:42:45 PM','Follow');
INSERT INTO user_notification (notif_id,notified_id,notifier_id,notif_read,notif_time,notif_category) VALUES (615, 5, 4, TRUE, '12/16/2021 04:02:05 PM','Follow');



-- auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category)

INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (701, 2, 100, TRUE, '12/28/2021 07:02:49 AM', 'New Bid');
INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (702, 1, 100, TRUE, '12/28/2021 03:12:53 AM', 'New Bid');
INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (703, 4, 100, TRUE, '12/28/2021 02:52:14 AM', 'New Bid');
INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (704, 3, 101, TRUE, '12/02/2021 04:42:45 PM', 'New Bid');
INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (705, 4, 101, TRUE, '12/03/2021 04:02:05 PM', 'New Bid');
INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (706, 3, 105, TRUE, '12/27/2021 03:12:53 AM','New Message');
INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (707, 3, 105, TRUE, '12/09/2021 07:02:49 AM','New Message');
INSERT INTO auction_notification (notif_id,notified_id,auction_id,anotif_read,anotif_time,anotif_category) VALUES (708, 3, 105, TRUE, '12/10/2021 10:22:47 PM','New Message');







