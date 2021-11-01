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

> User stories organized by actor.  
> For each actor, a table containing a line for each user story, and for each user story: an identifier, a name, a priority, and a description (following the recommended pattern).

#### 2.1. Actor 1

#### 2.2. Actor 2

#### 2.N. Authenticated user

| Identifier |               Name              | Priority | Description |
|   :---:    |              :---:              |   :---:  |:---    |
|   FR.201   |      Create Auction      |   high   | As an authenticated user, I want to auction a new item|
|   FR.202   |     Follow Auction  |  medium  | As an authenticated, user I want to have a quicker access and receive notifications from an auction
|   FR.203   |     Report Auction  |  low  | As an authenticated user, I want to signal inappropriate content in an auction, so that administrators can review and deal with the problem as they see fit
|   FR.204   | View Followed Auctions |   medium   | As an authenticated user, I want to access my followed auctions
|   FR.205   |          View My Bidding History         |   medium   | As an authenticated user, I want to see all the bids I made, their value and to what auction they refer to
|   FR.206   |          View My Auctions         |   high   | As an authenticated user, I want to access the auctions I own, and all the information attacthed to them
|   FR.207   |          Add Credit to Account        |   medium   |As an authenticated user, I want to be able to transfer money into my account wallet
|   FR.208   |          Bid on Auction        |   high   | As an authenticated user, I want to  bid on an item, by choosing the amount of money to be placed
<center> Table 3: Authenticated user stories </center>

#### 2.N. Bidder
| Identifier |               Name              | Priority | Description |
|   :---:    |              :---:              |   :---:  |:---    |
|   FR.301   |      Rate Seller     |   medium   | As a bidder, I want to classify a seller, by leaving a 1 to 5 rating and/or a comment on their profile|
|   FR.302   |     View Auction Bidding History  |  high  | As a bidder, I want to access all the auctions I've bid on

#### 2.N. Auction Owner
| Identifier |               Name              | Priority | Description |
|   :---:    |              :---:              |   :---:  |:---    |
|   FR.401   |     Edit Auction    |   high   | As an auction owner, I want to change the information of one of my auctions|
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