# ER: Requirements Specification Component

> Project vision.

## A1: Hand Of Midas


The main goal of the Hand of Midas project is to provide a web based service, where its users are able to buy and/or sell a variety of items of rare characteristics, through online auctions, namely art pieces, decór items, books and jewelry. As the name states, this website encourages the community to increase the added value of such items. The market of rare artifacts is not usually easy to enter, you must know how each community works and lose a lot of time searching for the right item or the right seller, and sometimes the auctions can be private or invitation-only. Hand of Midas seeks to create a more democratic process for interested parties, allowing them to bid on and sell in online auctions for exclusive artifacts in an easy, simple way. 

This website can be used by collectors, enthusiasts and sellers to find and sell unique items. The users need to be authenticated in order to bid on an existing auction, put up an item for sale and manage its auction or even follow auctions they are interested in. An Authenticated User has access to a private dashboard, where they are able to see their bidding and selling history. There’s also an Administrator user group with broader permissions so they can manage all auctions and reports but also edit the categories in which the items are divided in. However, any Non-Authenticated User is able to see the active auctions, view other user profiles and search products by category, starting price, auction ending time and others. Visitors are able to login into the system, register themselves into the system and recover their password, if necessary.

The website will have a responsive design, which allows users to access it from a different range of devices such as smartphones, computers and tablets. Its main goal is to provide an easy and enjoyable experience for both bidders or sellers, and especially regarding browsing auctions and products. 

---


## A2: Actors and User stories

This artifact contains the specification of the actors involved and their user stories, serving as agile documentation of the projects requirements. 
An User can be authenticated or just a visitor. Only the authenticated user can interact more profoundly within the site, either by placing bids or putting an item up for auction as its owner. The bidder bids on the auction owner's item and buys it, if his bid is the highest.
The Administrator is someone with special privileges, above all the average users.


### 1. Actors

> For the Online Auctions system, the actors are represented in Figure 1 and described in Table 1.

![Actors](./Actors.jpg)

Figure 1: Hand Of Midas Actors.


| Identifier        | Description |
|      :---         |    :---    |
| User              | Generic user that has access to public information, such as available auctions.|
| Visitor           | Unauthenticated user that can register itself (sign-up) or sign-in in the system to participate in bidding or to create auctions.|
|   Authenticated   | Authenticated user that can search available auctions and manage their list of interests.|
|      Bidder       | Authenticated user that is able to bid in auctions.|
|   Auction owner   | Authenticated user that is able to create auctions of their own.|

Table 1: Hand Of Midas actors description.


### 2. User Stories

> For the Online Auction system, please refer to the user stories presented below:


#### 2.1. User
| Identifier |               Name              | Priority | Description |
|   :---     |              :---               |   :---   |    :---     |
|   US01     |       View active auctions      |   high   | As a User, I must be able to view all active auctions, so that I'm able to find the ones that interest me. |
|   US02     |   Browse auctions by category   |   high   | As a User, I must be able to search auctions by their specific categories. |
|   US03     |         Search auctions         |   high   | As a User, I must be able to search an active auction at any given time. |
|   US04     |   See Home                      |   high   | As a User, I want to access the home page, so that I can see a brief presentation of the website. |
|   US05     |   See About                     |   high   | As a User, I want to access the about page, so that I can see a complete description of the website and its creators. |
|   US06     |   Consult Services              |   high   | As a User, I want to access the services information, so that I can see the website's services.|
|   US07     |   Consult FAQ                   |   high   | As a User, I want to access the FAQ, so that I can get quick answers to common questions.|
|   US08     |   Consult Contacts              |   high   | As a User, I want to access contacts, so that I can come in touch with the platform creators.|
|   US09     |        View/Search user profiles       |  medium  | As a User, I want to be able to search and see other user's profiles. |


Table 2: User user stories.


#### 2.2. Visitor
| Identifier |       Name       | Priority | Description |
|   :---     |       :---       |   :---   |    :---     |
|   US11     |   Login          |   high   | As a Visitor, I want to login into the system, so that I may access information.|
|   US12     |   Registration   |   high   | As a Visitor, I want to be able to register into the system, so that I may access information.|
|   US13     | Recover password |   high   | As a Visitor, I want to be able to recover my password by the registered email, so that I don't lose my account permanently.|

Table 3: Visitor stories.


#### 2.3. Administrator
| Identifier |               Name              | Priority | Description |
|   :---     |              :---               |   :---   |    :---     |
|   US21     |      Administrator accounts     |   high   | There must be accounts with special privileges in the system. |
|   US22     |     Administer user accounts    |   high   | As an Admin, I must to be able to search, view, edit and create user accounts.|
|   US23     | Block and unblock user accounts |   high   | As an Admin, I must have the ability to block and unblock accounts, so that I can manage the type of users on the website.|
|   US24     |          Manage auction         |   high   | As an Admin, I must be able to view, edit and supervise any auction occurring at any time, so that I can make sure things run smoothly.|
|   US25     |          Cancel auction         |   high   | As an Admin, I must be able to cancel any auction, so that I can manage the type of auctions occurring on the website.|
|   US26     |       Delete user account       |   low    | As an Admin, I want to be able to delete accounts at will, so that I can remove unwanted users from the website.|

Table 4: Administrator user stories. 


#### 2.4. Authenticated user

| Identifier |               Name              | Priority | Description |
|   :---     |              :---               |   :---   |:---    |
|   US31     |      View/Edit Profile          |   high   | As an authenticated user, I want to be able to view and edit my own profile, so that I can present myself in a way that I identify with. |
|   US32     |      Create Auction             |   high   | As an authenticated user, I want to auction a new item, so that other users can bid on it and eventually buy it. |
|   US32     |      Edit/Delete Auction        |   high   | As an authenticated user, I want to be able to edit and/or delete any of my auctions, so that I can decide exactly what my auctions say and if I want them on the platform.|
|   US32     |      Edit/Delete Comment          |   high   | As an authenticated user, I want to be able to edit and/or delete any of my post on other user's auctions, so that my comments are not permanent.|
|   US33     |          View My Auctions       |   high   | As an authenticated user, I want to access the auctions I own, and all the information attached to them. |
|   US34     |          Bid on Auction         |   high   | As an authenticated user, I want to  bid on an item, by choosing the amount of money to be placed. |
|   US35     |         Logout                  |   high   | As an authenticated user, I want to logout of the system.|
|   US36     |     Follow Auction              |  medium  | As an authenticated user, I want to follow an auction, so that I have a quicker access to the auctions I'm most interested in.|
|   US37     | View Followed Auctions          |  medium  | As an authenticated user, I want to access my followed auctions, so that I can unfollowed them, or visit them more easily.|
|   US38     |     View My Bidding History     |  medium  | As an authenticated user, I want to see all the bids I made, so that I can see their value and to what auction they refer to.|
|   US39     |          Add Credit to Account  |  medium  | As an authenticated user, I want to be able to transfer money into my account wallet, so that I can place bids on auctions
|   US310     |     Report Auction              |    low   | As an authenticated user, I want to signal inappropriate content in an auction, so that administrators can review and deal with the problem as they see fit.|

Table 5: Authenticated user stories.


#### 2.5. Bidder
| Identifier |               Name             | Priority | Description |
|   :---     |              :---              |   :---   |:---    |
|   US41     |  View Auction Bidding History  |  high    | As a bidder, I want to access all the bids placed on an auction, so that I can keep track of everyone who has placed bids (add more TODO)|
|   US42     |      Rate Seller               |   medium | As a bidder, I want to classify a seller, by leaving a 1 to 5 rating and/or a comment on their profile, so that other users have a better idea of that seller's reliability.|

Table 6: Bidder user stories.


#### 2.6. Auction Owner
| Identifier |               Name              | Priority | Description |
|   :---     |              :---               |   :---   |:---    |
|   US51     |     Edit Auction                |   high   | As an auction owner, I want to change the information of one of my auctions, so that it's up-to-date.|
|   US52     |     Cancel Auction              |   high   | As an auction owner, I want to completely remove an auction from the platform, so no one is able to see it.|
|   US53     |     Manage Auction Status       |  medium  | (Not Sure)

Table 7: Auction owner user stories.

### 3. Supplementary Requirements

#### 3.1. Business rules

| Identifier | Name                           | Description   |
| :---       | :---                           | :---          |
| BR01       | Private Data Storage           | Upon account deletion, shared user data is kept but is made anonymous |
| BR02       | Independent Accounts           | Administrator accounts are independent of the user accounts, i.e. they cannot create or participate in auctions. |
| BR03       | Auction Cancellation           | An auction can only be canceled if there are no bids. |
| BR04       | Valid Bidding                  | A user cannot bid if his bid is the current highest. |
| BR05       | Auction (Deadline) Extension   | When a bid is made in the last 15 minutes of the auction, the auction deadline is extended by 30 minutes. |
| BR06       |Vote/comment/review own auctions| A user cannot vote, comment nor review their own auctions.|
| BR07       |Auction Dates| The sale date must be greater than the auction start date.|

Table 8: Hand Of Midas business rules.


#### 3.2. Technical requirements

| Identifier | Name          | Description   |
| :---       | :---          | :---          |
| TR01       | Availability  | The system must be available at all times. |
| TR02       | Accessibility | The system must ensure that everyone can access the pages, regardless of whether they have any handicap or not, or the Web browser they use. |
| TR03       | Usability     | The system should be simple and easy to use. The Hand Of Midas system is designed to be used by collectors and enthusiasts with or without technical experience, so good usability is an important requirement.  |
| TR04       | Performance   | The system should have response times shorter than 2s to ensure the user's attention. |
| TR05       | Web application    | The system should be implemented as a web application with dynamic pages (HTML5, JavaScript, CSS3 and PHP). It is critical that the Hand Of Midas system is easily accessible from anywhere without the need to install specific applications or software, adopting standard web technologies. |
| TR06       | Security      | The system shall protect information from unauthorized access through the use of an authentication and verification system. |
| TR07       | Robustness    | The system must be prepared to handle and continue operating when runtime errors occur. |
| TR08       | Scalability   | The system must be prepared to deal with the growth in the number of users and their actions. |
| TR09       | Ethics   | The system must respect the ethical principles in software development (for example, personal user details, or usage data, should not be collected nor shared without full acknowledgement and authorization from its owner). |

Table 9: Hand Of Midas technical requirements.


#### 3.3. Restrictions

A restriction on the design limits the degree of freedom in the search for a solution

| Identifier | Name                  | Description   |
| :---       | :---                  | :---          |
| C01        | Deadline              | The project should be ready to be delivered by the end of the first half of the month of January, limiting creativity and the site's usability.|
| C02        | Technological Barrier | The project must be developed under a strict technology stack.|
| C03        | Vertical prototype    | The project's vertical prototype must be based on the example provided.|

Table 10: Hand Of Midas project restrictions.

---


## A3: Information Architecture

 The Information Architecture artefact presents a brief overview of the information architecture of the system to be developed. It has the following goals: 

* Help to identify and describe the user requirements, and raise new ones; 
* Preview and empirically test the user interface of the product to be developed; 
* Enable quick and multiple iterations on the design of the user interface. 

It includes two elements: 
 	
1. Overview of the information architecture from the viewpoint of the users (sitemap)
2. Description and prioritization of the functionally and content of, at least two, main individual screens (wireframes):
   * Homepage
   * Auction Details



### 1. Sitemap

The User will be able to view categories and tags by using the Homepage search bar.

![Sitemap](./Sitemap.png)

Figure 2: Hand Of Midas Sitemap.


### 2. Wireframes

> Wireframes for, at least, two main pages of the web application.
> Do not include trivial use cases.

![Homepage](./Homepage.png)

Figure 3: Hand Of Midas Homepage.

#### UIxx: Page Name

#### UIxx: Page Name


---


## Revision history

Changes made to the first submission:
1. Item 1
1. ...

***
GROUP21gg, DD/MM/2021

* Group member 1 name, email (Editor)
* Group member 2 name, email
* ...
