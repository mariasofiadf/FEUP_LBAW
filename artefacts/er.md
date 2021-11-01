# ER: Requirements Specification Component

> Project vision.

## A1: Hand Of Midas

> Goals, business context and environment.  
> Motivation.  
> Main features.  
> User profiles.


---


## A2: Actors and User stories

> This artifact contains the specification of the actors involved and their user stories. This serves as agile documentation of the projects requirements.


### 1. Actors

> For the Online Auctions system, the actors are represented in Figure 1 and described in Table 1.

![plot](./Actors.jpg)

Figure 1: Hand Of Midas Actors.


| Identifier        | Description |
|      :---        |    :---    |
| User              | Generic user that has access to public information, such as available auctions.|
| Non-authenticated | Unauthenticated user that can register itself (sign-up) or sign-in in the system to participate in bidding or to create auctions.|
|   Authenticated   | Authenticated user that can search available auctions and manage their list of interests.|
|      Bidder       | Authenticated user that is able to bid in auctions.|
|   Auction owner   | Authenticated user that is able to create auctions of their own.|

Table 1: Hand Of Midas actors description.


### 2. User Stories

> For the Online Auction system, please refer to the user stories presented below:


#### 2.1. User
| Identifier |               Name              | Priority | Description |
|   :---     |              :---               |   :---   |    :---     |
|   FR.101   |       View active auctions      |   high   | As a User, I must be able to view all active auctions, so that I'm able to find the ones that interest me. |
|   FR.102   |        View user profiles       |  medium  | As a User, I want to be able to see other user's profiles. |
|   FR.103   |   Browse auctions by category   |   high   | As a User, I must be able to search auctions by their specific categories. |
|   FR.104   |         Search auctions         |   high   | As a User, I must be able to search an active auction at any given time. |
|     |         See Home          |   high   | As a User, I want to access the home page, so that I can see a brief presentation of the website. |
|     |         See About         |   high   | As a User, I want to access the about page, so that I can see a complete description of the website and its creators. |
|     |         Consult Services  |   high   | As a User, I want to access the services information, so that I can see the website's services.|
|     |         Consult FAQ       |   high   | As a User, I want to access the FAQ, so that I can get quick answers to common questions.|
|     |         Consult Contacts      |   high   | As a User, I want to access contacts, so that I can come in touch with the platform creators.|

Table 2: User user stories.


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
|   FR.601   |          Manage auction         |   high   | As an Admin, I must be able to view, edit and supervise any auction occurring at any time, so that I can make sure things run smoothly.|
|   FR.602   |          Cancel auction         |   high   | As an Admin, I must be able to cancel any auction, so that I can manage the type of auctions occurring on the website.|

Table 4: Administrator user stories. 


#### 2.4. Authenticated user

| Identifier |               Name              | Priority | Description |
|   :---     |              :---               |   :---   |:---    |
|   FR.201   |      Create Auction      |   high   | As an authenticated user, I want to auction a new item, so that other users can bid on it and eventually buy it. |
|   FR.202   |     Follow Auction  |  medium  | As an authenticated user, I want to follow an auction, so that I have a quicker access to the auctions I'm most interested in.|
|   FR.203   |     Report Auction  |  low  | As an authenticated user, I want to signal inappropriate content in an auction, so that administrators can review and deal with the problem as they see fit.|
|   FR.204   | View Followed Auctions |   medium   | As an authenticated user, I want to access my followed auctions, so that I can unfollowed them, or visit them more easily.|
|   FR.205   |          View My Bidding History         |   medium   | As an authenticated user, I want to see all the bids I made, so that I can see their value and to what auction they refer to.|
|   FR.206   |          View My Auctions         |   high   | As an authenticated user, I want to access the auctions I own, and all the information attacthed to them
|   FR.207   |          Add Credit to Account        |   medium   |As an authenticated user, I want to be able to transfer money into my account wallet, so that I can place bids on auctions
|   FR.208   |          Bid on Auction        |   high   | As an authenticated user, I want to  bid on an item, by choosing the amount of money to be placed

Table 5: Authenticated user stories.


#### 2.5. Bidder
| Identifier |               Name              | Priority | Description |
|   :---     |              :---               |   :---   |:---    |
|   FR.301   |      Rate Seller     |   medium   | As a bidder, I want to classify a seller, by leaving a 1 to 5 rating and/or a comment on their profile, so that other users have a better idea of that seller's reliability.|
|   FR.302   |     View Auction Bidding History  |  high  | As a bidder, I want to access all the auctions I've bid on, so that I can keep track of all the items I've lost and won, and also auctions I'm still in the run for.|

Table 5: Bidder user stories.


#### 2.6. Auction Owner
| Identifier |               Name              | Priority | Description |
|   :---     |              :---               |   :---   |:---    |
|   FR.401   |     Edit Auction    |   high   | As an auction owner, I want to change the information of one of my auctions, so that it's up-to-date.|
|   FR.402   |     Manage Auction Status |  medium  | (Not Sure)
|   FR.403   |     Cancel Auction  |  high  | As an auction owner, I want to completly remove an auction from the platform, so no one is able to see it.|

Table 5: Auction owner user stories.

### 3. Supplementary Requirements

#### 3.1. Business rules

| Identifier | Name                         | Description   |
| :---       | :---                         | :---          |
| BR011      | Private Data Storage         | Upon account deletion (FR.014) shared user data is kept but is made anonymous |
| BR101      | Independent Accounts         | Administrator accounts are independent of the user accounts, i.e. they cannot create or participate in auctions. |
| BR102      | Auction Cancellation         | An auction can only be canceled if there are no bids. |
| BR103      | Valid Bidding                | A user cannot bid if his bid is the current highest. |
| BR104      | Auction (Deadline) Extension | When a bid is made in the last 15 minutes of the auction, the auction deadline is extended by 30 minutes. |

Table 6: Hand Of Midas business rules.


#### 3.2. Technical requirements

| Identifier | Name          | Description   |
| :---       | :---          | :---          |
| TR01       | Availability  | The system must be available at all times. |
| TR02       | Accessibility | The system must ensure that everyone can access the pages, regardless of whether they have any handicap or not, or the Web browser they use. |
| TR03       | Usability     | The system should be simple and easy to use. The Hand Of Midas system is designed to be used by collectors and enthusiasts with or without technical experience, so good usability is an important requirement.  |
| TR04       | Performance   | The system should have response times shorter than 2s to ensure the user's attention. |
| TR05       | Web application    | The system should be implemented as a web application with dynamic pages (HTML5, JavaScript, CSS3 and PHP). It is critical that the Hand Of Midas system is easily accessible from anywhere without the need to install specific applications or software, adopting standard web technologies. |
| TR05       | Security    | The system shall protect information from unauthorized access through the use of an authentication and verification system. |
| TR03       | Robustness    | The system must be prepared to handle and continue operating when runtime errors occur. |
| TR04       | Scalability   | The system must be prepared to deal with the growth in the number of users and their actions. |
| TR04       | Ethics   | The system must respect the ethical principles in software development (for example, personal user details, or usage data, should not be collected nor shared without full acknowledgement and authorization from its owner). |

Table 7: Hand Of Midas technical requirements.


#### 3.3. Restrictions

A restriction on the design limits the degree of freedom in the search for a solution

| Identifier | Name          | Description   |
| :---       | :---          | :---          |
| C01        | ??????????? TODO   |               |

Table 8: Hand Of Midas project restrictions.

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
