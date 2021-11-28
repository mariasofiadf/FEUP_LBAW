INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked) VALUES ('Bruno Silva','bsilva','$2y$10$mp6HMsGu4VcblGpki0HdR.4LwB2qHR8c9oOpU6Jlbt4RTdIQpkG1W','bsilva@hotmail.com',169335936,10000,'bsilva.jpg',4,False);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked) VALUES ('Laura Rocha','lrocha','$2y$10$LnAa8f4AB0f5Ttrrf3yC0eEjpIJkQoek9thQ033t79IZD3GX7cx8S','lrocha@hotmail.com',934004312,2000,'lrocha.jpg',3,False);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked) VALUES ('Carlos Lima','clima','$2y$10$bdRPzv0rSN3HwH/3Gus8y.7MkV1aPDgRgI.S.2Jly037qRoN7orM6','clima@gmail.com',639376003,32000,'clima.jpg',2,False);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked) VALUES ('Diana Sagres','dsagres','$2y$10$Rr3Y4V44M5WT7uVwmjYAdulX2ON5wrUM2pDN6AqafKYKYfYcipaLK','dsagres@yahoo.com.br',948003605,1000,'dsagres.jpg',1,False);
INSERT INTO users (user_id,name,username,password,email,phone_number,credit,profile_image,rating,blocked) VALUES ('Miguel Ferreira','mferreira','$2y$10$nuEhKrKvBTXffcllNcPfkuD52u0ln7k/VqnmB6VpnrKqCVZZ9.Ycy','mferreira@gmail.com',639230752,200,'mferreira.jpg',5,False);

INSERT INTO auction (
    auction_id,
    title,
    description,
    min_opening_bid,
    min_raise,
    start_date, --CK predictedEnd >= startDate
    predicted_end,
    close_date, --CK close_date >= predictedEnd

    status auction_status,
    category auction_category,

    auction_notif BOOLEAN DEFAULT TRUE NOT NULL,
    user_notif BOOLEAN DEFAULT TRUE NOT NULL,
    seller_id INTEGER REFERENCES users(user_id) NOT NULL
);

