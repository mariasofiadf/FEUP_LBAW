-- images
INSERT INTO image (img_id,content,label) VALUES (50,'victorianchair.jpg','chair');
INSERT INTO image (img_id,content,label) VALUES (51,'coffeetable.jpg','coffeetable');
INSERT INTO image (img_id,content,label) VALUES (52,'egyptiannecklace.jpg','egyptiannecklace');
INSERT INTO image (img_id,content,label) VALUES (53,'sherlockholmes.jpg','sherlockholmes');
INSERT INTO image (img_id,content,label) VALUES (54,'agathachristie.jpg','agathachristie');
INSERT INTO image (img_id,content,label) VALUES (55,'impressionistpainting.jpg','impressionistpainting');

-- users
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked) VALUES (1,'Bruno Silva','bsilva','$2y$10$mp6HMsGu4VcblGpki0HdR.4LwB2qHR8c9oOpU6Jlbt4RTdIQpkG1W','bsilva@hotmail.com',169335936,10000,'bsilva.jpg',4,False);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked) VALUES (2,'Laura Rocha','lrocha','$2y$10$LnAa8f4AB0f5Ttrrf3yC0eEjpIJkQoek9thQ033t79IZD3GX7cx8S','lrocha@hotmail.com',934004312,2000,'lrocha.jpg',3,False);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked) VALUES (3,'Carlos Lima','clima','$2y$10$bdRPzv0rSN3HwH/3Gus8y.7MkV1aPDgRgI.S.2Jly037qRoN7orM6','clima@gmail.com',639376003,32000,'clima.jpg',2,False);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked) VALUES (4,'Diana Sagres','dsagres','$2y$10$Rr3Y4V44M5WT7uVwmjYAdulX2ON5wrUM2pDN6AqafKYKYfYcipaLK','dsagres@yahoo.com.br',948003605,1000,'dsagres.jpg',1,False);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked) VALUES (5,'Miguel Ferreira','mferreira','$2y$10$nuEhKrKvBTXffcllNcPfkuD52u0ln7k/VqnmB6VpnrKqCVZZ9.Ycy','mferreira@gmail.com',639230752,200,'mferreira.jpg',5,False);


-- auction
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,auction_notif,user_notif,auction_image,seller_id) VALUES (10,'Victorian Chair', '19th century velvet red chair, with wooden details',1000,100,'2021-11-28','2021-11-30','2021-11-30','Active','Decor',TRUE,TRUE, 50, 3);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,auction_notif,user_notif,auction_image,seller_id) VALUES (11,'18th Century Coffee Table', 'Coffee table from the 18th Century in wood with top made of stone',850,150,'2021-12-01','2021-12-07','2021-12-08','Active','Decor',TRUE,TRUE, 51, 5);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,auction_notif,user_notif,auction_image,seller_id) VALUES (12,'Egyptian Necklace', 'Old Kingdom (circa 2670–2195 B.C.) necklace made of gold',11000,500,'2022-01-01','2022-01-03','2022-01-04','Active','Jewelry',TRUE,TRUE, 52, 3);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,auction_notif,user_notif,auction_image,seller_id) VALUES (13,'Sherlock Holmes Original 1976 Collection', '15 books with hard cover and golden incrusted letters',550,50,'2022-01-12','2022-01-15','2022-01-16','Active','Book',TRUE,TRUE, 53, 4);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,auction_notif,user_notif,auction_image,seller_id) VALUES (14,'Agatha Christie Collections 1960-1969 and 1970-1979', 'Agatha Christie Best Sellers from the 60s and 70s',1000,100,'2022-01-13','2022-01-15','2022-01-16','Active','Book',TRUE,TRUE, 54, 4);
INSERT INTO auction (auction_id,title,description,min_opening_bid,min_raise,start_date,predicted_end,close_date,status,category,auction_notif,user_notif,auction_image,seller_id) VALUES (15,'Impressionist Lake Painting by Vlaminck', 'Small unknown painting by Maurice Vlaminck from 1896',540000,1000,'2022-01-18','2022-01-19','2022-01-20','Active','ArtPiece',TRUE,TRUE, 55, 3);

-- bid

INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (20,1100,'2021-11-28',10,2);
INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (21,1200,'2021-11-28',10,1);
INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (22,1300,'2021-11-28',10,4);
INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (23,1000,'2021-12-02',11,3);
INSERT INTO bid (bid_id,bid_value,bid_date,auction_id,bidder_id) VALUES (24,1150,'2021-12-03',11,4);




