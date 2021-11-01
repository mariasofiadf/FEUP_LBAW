# ER: Requirements Specification Component

> Project vision.

## A1: Project Name

> Goals, business context and environment.  
> Motivation.  
> Main features.  
> User profiles.


---


## A2: Actors and User stories

> This artifact contains the specification of the actors involved and their user stories. This serves as agile documentation of the projects requirements.


### 1. Actors

> For the Online Auctions system, the actors are represented in Figure 1 and described in Table 1.

![plot](./figure1.png)
<center> Figure 1: Online Auction Actors. </center>




| Identifier        | Description |
|      :---:        |    :---:    |
| User              | Generic user that has access to public information, such as available auctions.|
| Non-authenticated | Unauthenticated user that can register itself or sign-in the system to participate in bidding or creating an auction.|
|   Authenticated   | Authenticated user that can search available auctions and manage his list of interests.|
|      Bidder       | Authenticated user able to bid in one or more auctions.|
|   Auction owner   | Authenticated user who is able to create an auction of his own.|

<center> Table 1: Online Auction actors description </center>




### 2. User Stories

> For the Online Auction system, please refer to the user stories presented below:


#### 2.1. User
| Identifier |               Name              | Priority | Description |
|   :---     |              :---               |   :---   |    :---     |
|   FR.101   |       View active auctions      |   high   | As a User, I must be able to view all active auctions, so that I'm able to find the ones that interest me. |
|   FR.102   |        View user profiles       |  medium  | As a User, I want to be able to see other user's profiles. |
|   FR.103   |   Browse auctions by category   |   high   | As a User, I must be able to search auctions by their specific categories. |
|   FR.104   |         Search auctions         |   high   | As a User, I must be able to search an active auction at any given time. |
|   FR.031   |        Exact match search       |  medium  | As a User, I must be able to do an exact match search. |
|   FR.032   |         Full-text search        |   high   | As a User, I must be able to do a full-text search. |
|   FR.033   | Search over multiple attributes |  medium  | As a User, I must be able to have attributes to help with my search. |
|   FR.034   |          Search filters         |   high   | As a User, I must have category filters to efficiently help with his search. |
|     |         See Home          |   high   | As a User, I want to access the home page, so that I can see a brief presentation of the website. |
|     |         See About         |   high   | As a User, I want to access the about page, so that I can see a complete description of the website and its creators. |
|     |         Consult Services  |   high   | As a User, I want to access the services information, so that I can see the website's services.|
|     |         Consult FAQ       |   high   | As a User, I want to access the FAQ, so that I can get quick answers to common questions.|
|     |         Consult Contacts      |   high   | As a User, I want to access contacts, so that I can come in touch with the platform creators.|

Table 2: User user stories


#### 2.2. Non-Authenticated
| Identifier |       Name       | Priority | Description |
|   :---     |       :---       |   :---   |    :---     |
|   FR.011   |   Login/Logout   |   high   | As an Unauthenticated user, I want to login into the system, so that I may access information.|
|   FR.012   |   Registration   |   high   | As an Unauthenticated user, I want to be able to register into the system, so that I may access information.|
|   FR.013   | Recover password |  high  | As an Unauthenticated user, I want to be able to recover my password by the registered email, so that I don't lose my account permanently.|

Table 3: Non-authenticated user stories.


#### 2.3. Administrator
| Identifier |               Name              | Priority | Description |
|   :---     |              :---               |   :---   |    :---     |
|   FR.041   |      Administrator accounts TIRAR DAQUI (TODO)   |   high   | There must be accounts with special privileges in the system. |
|   FR.042   |     Administer user accounts    |  high  | As an Admin, I must to be able to search, view, edit and create user accounts.|
|   FR.043   | Block and unblock user accounts |   high   | As an Admin, I must have the ability to block and unblock accounts, so that I can manage the type of users on the website.|
|   FR.044   |       Delete user account       |   low    | As an Admin, I want to be able to delete accounts at will, so that I can remove unwanted users from the website.|
|   FR.601   |          Manage auction         |   high   | As an Admin, I must be able to view, edit and supervise any auction occurring at any time, so that I can make sure things run smoothly.
|   FR.602   |          Cancel auction         |   high   | As an Admin, I must be able to cancel any auction, so that I can manage the type of auctions occurring on the website.

Table 4: Administrator user stories.


#### 2.N. Authenticated user

| Identifier |               Name              | Priority | Description |
|   :---:    |              :---:              |   :---:  |:---    |
|   FR.201   |      Create Auction      |   high   | As an authenticated user, I want to auction a new item, so that other users can bid on it and eventually buy it|
|   FR.202   |     Follow Auction  |  medium  | As an authenticated user, I want to follow an auction, so that I have a quicker access to the auctions I'm most interested in
|   FR.203   |     Report Auction  |  low  | As an authenticated user, I want to signal inappropriate content in an auction, so that administrators can review and deal with the problem as they see fit
|   FR.204   | View Followed Auctions |   medium   | As an authenticated user, I want to access my followed auctions, so that I can unfollowed them, or visit them more easily
|   FR.205   |          View My Bidding History         |   medium   | As an authenticated user, I want to see all the bids I made, so that I can see their value and to what auction they refer to
|   FR.206   |          View My Auctions         |   high   | As an authenticated user, I want to access the auctions I own, and all the information attacthed to them
|   FR.207   |          Add Credit to Account        |   medium   |As an authenticated user, I want to be able to transfer money into my account wallet, so that I can place bids on auctions
|   FR.208   |          Bid on Auction        |   high   | As an authenticated user, I want to  bid on an item, by choosing the amount of money to be placed
<center> Table 3: Authenticated user stories </center>

#### 2.N. Bidder
| Identifier |               Name              | Priority | Description |
|   :---:    |              :---:              |   :---:  |:---    |
|   FR.301   |      Rate Seller     |   medium   | As a bidder, I want to classify a seller, by leaving a 1 to 5 rating and/or a comment on their profile, so that other users have a better idea of that seller's reliability|
|   FR.302   |     View Auction Bidding History  |  high  | As a bidder, I want to access all the auctions I've bid on, so that I can keep track of all the items I've lost and won, and also auctions I'm still in the run for

#### 2.N. Auction Owner
| Identifier |               Name              | Priority | Description |
|   :---:    |              :---:              |   :---:  |:---    |
|   FR.401   |     Edit Auction    |   high   | As an auction owner, I want to change the information of one of my auctions, so that it's up-to-date|
|   FR.402   |     Manage Auction Status |  medium  | (Not Sure)
|   FR.403   |     Cancel Auction  |  high  | As an auction owner, I want to completly remove an auction from the platform, so no one is able to see it

### 3. Supplementary Requirements

> Section including business rules, technical requirements, and restrictions.  
> For each subsection, a table containing identifiers, names, and descriptions for each requirement.

#### 3.1. Business rules

#### 3.2. Technical requirements

#### 3.3. Restrictions


---


## A3: Information Architecture

> Brief presentation of the artefact goals.


### 1. Sitemap

> Sitemap presenting the overall structure of the web application.  
> Each page must be identified in the sitemap.  
> Multiple instances of the same page (e.g. student profile in SIGARRA) are presented as page stacks.


### 2. Wireframes

> Wireframes for, at least, two main pages of the web application.
> Do not include trivial use cases.


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