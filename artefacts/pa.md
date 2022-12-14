# PA: Product and Presentation

This project consists in an auction website for antiques, that being works of art, books, furniture, jewelry and more.

## A9: Product

The majority of auctions, taken in person, causes a huge number of inconviniences, such as the weight of the objects to carry or its carefull manouvre, such as to not accidentally make it loose its value. As such, just being present carries a number of extra costs that could be absolutely avoidable or mitigated

That is the focus behind our product. Our platform presents an easy and conveninet way of bidding or auctioning off valuable articles, in absolute confort.

Our platforms design is rather intuitive, whereby the average user will see no problem utilising it, making their experience that much more enjoyable.


### 1. Installation

Link to the source code's final version: https://git.fe.up.pt/lbaw/lbaw2122/lbaw2123/-/tree/PA

```sh
docker run -it -p 8000:80 -e DB_DATABASE="lbaw2123" -e DB_SCHEMA="lbaw2123" -e 
DB_USERNAME="lbaw2123" -e DB_PASSWORD="JdNtVVVe" git.fe.up.pt:5050/lbaw/lbaw2122/lbaw2123
```

### 2. Usage

URL to the product: http://lbaw2123.lbaw.fe.up.pt  

#### 2.1. Administration Credentials 

| Email | Password |
| -------- | -------- |
| admin@gmail.com    | JdNtVVVe |

#### 2.2. User Credentials

| Type          | Email  | Password |
| ------------- | --------- | -------- |
| bidder/auction owner |  prof@gmail.com    | JdNtVVVe |


\pagebreak
### 3. Application Help

Help and error messages are displayed upon form submission in various areas of the website. These messages clarify to the user what was wrong or missing with their input.

Some examples of this are the Login form, the Registration Form and Auction Creation.

![RegisterError](images/register_validate_server.png){ height=150px }

Image 1. Example of a message from register error.

### 4. Input Validationdocsta is always validated both client-side and server-side. This acts as double safety for user input.
Some examples of where this validation occurs are login, register, auction creation, bid on action.
Client side validation usually checks for required fields and correct data types (number, text, file extension, etc) while server side validation checks those same conditions and also checks for contextual validity.

Here are some examples of Client-Side validation messages:

![BidError](images/bid_error.png){ height=150px }<br>

Image 2. Example of a bid that is too low.

![RegisterVal1](images/register_client_val.png){ height=150px }<br>

Image 3. Example of invalid email

\pagebreak

And here's an example of Server-Side validation messages:

![RegisterVal1](images/register_validate_server.png){ height=150px }<br>

Image 4. Example of invalid register


### 5. Check Accessibility and Usability


Accessibility: https://git.fe.up.pt/lbaw/lbaw2122/lbaw2123/-/blob/main/artefacts/docs/Checklist%20de%20Acessibilidade%20-%20SAPO%20UX.pdf

Usability: https://git.fe.up.pt/lbaw/lbaw2122/lbaw2123/-/blob/main/artefacts/docs/Checklist%20de%20Usabilidade%20-%20SAPO%20UX.pdf

### 6. HTML & CSS Validation

Results for HTML and CSS validation.

#### HTML Validation
[About](docs/aboutValHTML.pdf)<br>
[Auction Bid](docs/auctionbidValHTML.pdf)<br>
[Auction Complaint](docs/actionCompValHTML.pdf)<br>
[Create Auction](docs/createActValHTML.pdf)<br>
[Auction Page](docs/auctionFullValHTML.pdf)<br>
[Auction Notification](docs/auctionNotification.blade.phpVal.pdf)<br>
[Auction Preview](docs/auctionPreview.blade.phpVal.pdf)<br>
[Auctions](docs/auctions.blade.phpVal.pdf)<br>
[Bids](docs/bids.blade.phpVal.pdf)<br>
[Contacts](docs/contacts.blade.phpVal.pdf)<br>
[Error or Successs](docs/errorsuccess.blade.phpVal.pdf)<br>
[FAQ](docs/faq.blade.phpVal.pdf)<br>
[File Upload](docs/file-upload.blade.phpVal.pdf)<br>
[Header](docs/header.blade.phpVal.pdf)<br>
[Rating](docs/rating.blade.phpVal.pdf)<br>
[reportAuction](docs/reportAuction.blade.phpVal.pdf)<br>
[Auctions Search](docs/searchAuctions.blade.phpVal.pdf)<br>
[Users Search](docs/searchUsers.blade.phpVal.pdf)<br>
[User Profile](docs/user.blade.phpVal.pdf)<br>
[User Bid](docs/userBid.blade.phpVal.pdf)<br>
[Edit User](docs/userEdit.blade.phpVal.pdf)<br>
[User Notification](docs/userNotification.blade.phpVal.pdf)<br>
[All Users](docs/users.blade.phpVal.pdf)<br>
[Users Auctions](docs/usersAuctions.blade.phpVal.pdf)<br>
[Warnings](docs/warnings.blade.phpVal.pdf)

#### CSS Validation

[General Style](docs/appCSSValidator.pdf)<br>
[Profile](docs/profileCSSValidator.pdf)

### 7. Revisions to the Project


Added new routes that were not on the openAPI (A7).<br>

Some changes were made to the initial sql schema:

- Added Boolean `deleted` to User table
- Default image for User
- Boolean `time_increment` added to Auction table
- Notification tables
- Some triggers
- Added attribute 'is_admin' to User table to check if a certain user is an Admin


### 8. Implementation Details

#### 8.1. Libraries Used

No libraries were used.


\pagebreak

#### 8.2 User Stories

| US Identifier | Name    | Module | Priority                       | Team Members               | State  |
| --             | ---------                   | ---      | --             | -------- | --- |
|  US01          | View active auctions        | Module 2 | High           | **Maria Figueiredo**, Rita Ramada  |   100%  | 
|  US02          | Browse auctions by category | Module 2 | High           | **Rita Ramada**  |   100%  | 
|  US03          | Search Auctions             | Module 2 | High           | **Rita Ramada**  |   50%  | 
|  US04          | See Home                    | Module 5 | High           |                  |   0%  | 
|  US05          | See About                   | Module 5 | High           | **Deborah Lago**, Afonso Monteiro  |   100%  | 
|  US06          | Consult Services            | Module 5 | High           | **Deborah Lago**, Afonso Monteiro  |   100%  | 
|  US07          | Consult FAQ                 | Module 5 | High           | **Deborah Lago**, Afonso Monteiro  |   100%  | 
|  US08          | Consult Contacts            | Module 5 | High           | **Deborah Lago**, Afonso Monteiro  |   100%  | 
|  US09          | View/Search user profiles   | Module 3 | Medium         | **Rita Ramada**  |   75%  | 
|  US11          | Login                       | Module 1 | High           | **Maria Figueiredo**  |   100%  | 
|  US12          | Register                    | Module 1 | High           | **Maria Figueiredo**, Rita Ramada  |   100%  | 
|  US13          | Recover password            | Module 1 | High           |   |   0%  | 
|  US21          | Administer user accounts    | Module 4 | High           | **Maria Figueiredo**, Afonso Monteiro |   100%  | 
|  US22          | Block and unblock user accounts | Module 4 | High       |  |   0%  | 
|  US23          | Manage Auction              | Module 4 | High           | **Maria Figueiredo** |   50%  | 
|  US24          | Cancel Auction              | Module 4 | High           | **Maria Figueiredo** |   100%  | 
|  US25          | Delete user account         | Module 4 | High           | **Maria Figueiredo**  |   100%  | 
|  US26          | Notifications               | Module 4 | Medium         | **Maria Figueiredo**  |   100%  | 
|  US31          | View/Edit Profile           | Module 3 | High           | **Rita Ramada**, Maria Figueiredo  |   100%  | 
|  US32          | Create Auction              | Module 2 | High           | **Maria Figueiredo**, Rita Ramada  |   100%  | 
|  US33          | Edit/Delete Auction         | Module 2 | High           | **Maria Figueiredo**, Rita Ramada  |   100%  | 
|  US34          | Edit/Delete Comment         | Module 2 | High           |   |   0%  | 
|  US35          | View My Auctions            | Module 2 | High           | **Maria Figueiredo**, Rita Ramada  |   100%  | 
|  US36          | Bid on Auction              | Module 2 | High           | **Maria Figueiredo**  |   100%  | 
|  US37          | Logout                      | Module 1 | High           | **Maria Figueiredo**  |   100%  | 
|  US38          | Follow Auction              | Module 1 | Medium         | **Deborah Lago**, Maria Figueiredo  |   100%  | 
|  US39          | View Followed Auctions      | Module 1 | Medium         |   |   0%  | 
|  US310         | View My Bidding History     | Module 3 | Medium           | **Maria Figueiredo**, Rita Ramada |   100%  | 
|  US311         | Add Credit to Account       | Module 3 | Medium           |   |   0%  | 
|  US310         | Report Auction              | Module 2 | Low           | **Afonso Monteiro**, Maria Figueiredo  |   80%  | 
|  US41          | View Auction Bidding History| Module 2 | High           | **Maria Figueiredo**, Rita Ramada  |   100%  | 
|  US42          | Rate Seller                 | Module 3 | Medium         | **Rita Ramada**, Maria Figueiredo  |   100%  | 
|  US51          | Edit Auction                | Module 2 | High           | **Maria Figueiredo**, Rita Ramada  |   100%  | 
|  US52          | Cancel Auction              | Module 2 | High           | **Maria Figueiredo**  |   100%  | 
|  US53          | Manage Auction Status       | Module 2 | Medium         | **Maria Figueiredo**  |   100%  | 

---


## A10: Presentation

### 1. Product presentation

Hand of Midas is a web based service, where you can easily host an online auction and also bid on and buy a variety of items of rare characteristics, namely art pieces, dec??r items, books and jewelry. It seeks to create a more democratic process for interested parties, allowing them to bid on and sell in online auctions for exclusive artifacts in an easy and simple way. The main page is where you can see all the auctions that were created by the users. If you click in any of them, it will redirect you to the auction details, that include the minimum raise you need respect when making a bid and also which bid has been the highest made so far and by whom. To make your own bid, you will need to be authenticated.
Similar to the auctions page, if you click in any of the users, you will be redirected to that user's profile. There you can find the user's informations including all the auctions created by him/her. Also, if authenticated, you can rate him/her with 1 to 5 stars. In both of those pages you can find a search bar in which you can write reference words to nail down the results. When searching for auctions, you can also combine the keywords with one of the auction categories or even search just by a category. As the name states, this website encourages the community to increase the added value of rare items, but in a much more dynamic and simple way than in an onsite auction session. 

http://lbaw2123.lbaw.fe.up.pt  

### 2. Video presentation

![ScreenshotVideo](images/video.png){ height=150px }<br>

Here you can find our video:
https://drive.google.com/file/d/1--0llLzJbbfIQO6PEMLen4VM0mcQ4wva/view?usp=sharing



---


## Revision history

Changes made to the first submission in 7. Revisions to the Project

***

GROUP2123, 28/01/2022:

* Afonso Duarte de Carvalho Monteiro up201907284
* Ana Rita Antunes Ramada up201904565
* Deborah Marques Lago up201806102
* Maria Sofia Diogo Figueiredo up201904675 (Editor)
