# EAP: Architecture Specification and Prototype

## A7: High-level architecture. Privileges. Web resources specification

This artefact documents the  architecture of the web application to be developed, indicating the catalogue of resources, the properties of each resource, and the format of JSON responses. This specification adheres to the OpenAPI standard using YAML.

### 1. Overview

Identification and brief description of the modules that will be part of the application.

| Module | Description           |
| ----------- | ------------------------------ |
|**M01: Authentication**|   Web resources connected with authentication. Includes the features: login/logout, registration.|
|**M02: Auction**      | Web resources connected with autions. Includes the following system features: bid at an auction, auction listing and search, view, follow and report auctions, view auction's bidding history. Also includes creation, edition and cancelacion of an auction, as well as the management of the auction status. |
|**M03: User**      | 	Web resources associated with user. Includes the following system features: user listing and search, view user profile, edit profile, review user and follow user.|
|**M04: Administration**      |Web resources associated with user and auction management, includes the following system features: restrict and ban users, delete user accounts, manage and delete auctions, change user information, and view system access details for each user.|
|**M05: Static pages and others**      | 	Web resources associated with general content of the website. Web resources with static content are associated with this module: About and FAQ.|

### 2. Permissions

Permissions used by each module, necessary to access its data and features.

|       |  |      |
| :---        |    :---   |          --- |
| PUB      | Public       |  Users without privileges   |
| USR   | User        | 	Authenticated users       |
| OWN         | Owner       |  Users that own information (e.g. own auction, own account)  |
| ADM   | Administrator        | System administrators     |

### 3. OpenAPI Specification

OpenAPI specification in YAML format to describe the web application's web resources.

[OpenAPI Link](https://git.fe.up.pt/lbaw/lbaw2122/lbaw2123/-/blob/main/openapi.yaml).

```yaml
openapi: 3.0.0

...
```

---


## A8: Vertical prototype

> Brief presentation of the artefact goals.

### 1. Implemented Features

#### 1.1. Implemented User Stories

> Identify the user stories that were implemented in the prototype.  

| User Story reference | Name                   | Priority                   | Description                   |
| -------------------- | ---------------------- | -------------------------- | ----------------------------- |
|   US01     |       View active auctions      |   high   | As a User, I must be able to view all active auctions, so that I'm able to find the ones that interest me. |
|   US03    |         Search auctions         |   high   | As a User, I must be able to search an active auction, so that I can access a chosen auction at any given time. |
|   US09     |        View/Search user profiles       |  medium  | As a User, I want to be able to search and see other user's profiles, so that i can access information that might interest me. |
|   US11     |   Login          |   high   | As a Visitor, I want to login into the system, so that I may access more information.|
|   US12     |   Registration   |   high   | As a Visitor, I want to be able to register into the system, so that I may access information.|
|   US21     |     Administer user accounts    |   high   | As an Admin, I must to be able to search, view, edit and create user accounts.|
|   US22     | Block and unblock user accounts |   high   | As an Admin, I must have the ability to block and unblock accounts, so that I can manage the type of users on the website.|{ width=250px }
|   US23     |          Manage auction         |   high   | As an Admin, I must be able to view, edit and supervise any auction occurring at any time, so that I can make sure things run smoothly.|
|   US24     |          Cancel auction         |   high   | As an Admin, I must be able to cancel any auction, so that I can manage the type of auctions occurring on the website.|
|   US25     |       Delete user account       |   low    | As an Admin, I want to be able to delete accounts at will, so that I can remove unwanted users from the website.|
|   US31     |      View/Edit Profile          |   high   | As an authenticated user, I want to be able to view and edit my own profile, so that I can present myself in a way that I identify with. |
|   US32     |      Create Auction             |   high   | As an authenticated user, I want to auction a new item, so that other users can bid on it and eventually buy it. |
|   US32     |      Edit/Delete Auction        |   high   | As an authenticated user, I want to be able to edit and/or delete any of my auctions, so that I can decide exactly what my auctions say and if I want them on the platform.|
|   US33     |          View My Auctions       |   high   | As an authenticated user, I want to access the auctions I own, and all the information attached to them, so that it's easier to run those auctions. |
|   US34     |          Bid on Auction         |   high   | As an authenticated user, I want to choose the amount of money to be placed, so that I can bid on an item. |
|   US35     |         Logout                  |   high   | As an authenticated user, I want to logout of the system, so that the next person using the browser doesn't see my info.|



...

#### 1.2. Implemented Web Resources

> Identify the web resources that were implemented in the prototype.  

> Module M01: Module Name  

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R01: Web resource name | URL to access the web resource |

...

> Module M02: Module Name  

...

### 2. Prototype

[Prototype](http://lbaw2123.lbaw.fe.up.pt)

[Source Code](https://git.fe.up.pt/lbaw/lbaw2122/lbaw2123)

User credentials necessary to test all features:<br>
Normal user Account:
- email: prof@gmail.com<br>
- password: 1234<br>

Admin Account:
- email: admin@gmail.com<br>
- password: 1234<br>
- 
---


## Revision history

Changes made to the first submission:
1. Item 1
1. ..

***
GROUP21gg, DD/MM/2021
 
* Group member 1 name, email (Editor)
* Group member 2 name, email
* ...