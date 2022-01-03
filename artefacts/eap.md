# EAP: Architecture Specification and Prototype

## A7: High-level architecture. Privileges. Web resources specification

This artefact documents the architecture of the web application to be developed, indicating the catalogue of resources, the properties of each resource, and the format of JSON responses. This specification adheres to the OpenAPI standard using YAML.

### 1. Overview

Identification and brief description of the modules that will be part of the application.

| Module                           | Description |
| - | ---|
| **M01: Authentication**          | Web resources connected with authentication. Includes the features: login/logout, registration.                                                                                                                                                                                                                |
| **M02: Auction**                 | Web resources connected with autions. Includes the following system features: bid at an auction, auction listing and search, view, follow and report auctions, view auction's bidding history. Also includes creation, edition and cancelacion of an auction, as well as the management of the auction status. |
| **M03: User**                    | Web resources associated with user. Includes the following system features: user listing and search, view user profile, edit profile, review user and follow user.                                                                                                                                             |
| **M04: Administration**          | Web resources associated with user and auction management, includes the following system features: restrict and ban users, delete user accounts, manage and delete auctions, change user information, and view system access details for each user.                                                            |
| **M05: Static pages and others** | Web resources associated with general content of the website. Web resources with static content are associated with this module: About and FAQ.                                                                                                                                                                |

### 2. Permissions

Permissions used by each module, necessary to access its data and features.

|     |               |                                                            |
| :-- | :------------ | ---------------------------------------------------------- |
| PUB | Public        | Users without privileges                                   |
| USR | User          | Authenticated users                                        |
| OWN | Owner         | Users that own information (e.g. own auction, own account) |
| ADM | Administrator | System administrators                                      |

### 3. OpenAPI Specification

OpenAPI specification in YAML format to describe the web application's web resources.

[OpenAPI Link](https://git.fe.up.pt/lbaw/lbaw2122/lbaw2123/-/blob/main/openapi.yaml).

```yaml
openapi: 3.0.0

info:
    version: "1.0"
    title: "Hand Of Midas"
    description: "Web Resources Specification (A7) for Hand Of Midas"

servers:
    - url: http://lbaw2123.lbaw.fe.up.pt
      description: Deployment Server

tags:
    - name: "M01: Authentication"
    - name: "M02: Auction"
    - name: "M03: User"
    - name: "M04: Administration"
    - name: "M05: Static Pages and others"

paths:
    #M01: Authentication
    /login:
        get:
            operationId: R101
            summary: "R101: Login form"
            description: "Provide login form. Access: PUB"
            tags:
                - "M01: Authentication"
            responses:
                "200":
                    description: "Ok. Show Log-in UI"
        post:
            operationId: R102
            summary: "R102: Login Action"
            description: "Processes the login form submission. Access: PUB"
            tags:
                - "M01: Authentication"

            requestBody:
                required: true
                content:
                    application/x-www-form-urlencoded:
                        schema:
                            type: object
                            properties:
                                email: # <!--- form field name
                                    type: string
                                password: # <!--- form field name
                                    type: string
                            required:
                                - email
                                - password

            responses:
                "302":
                    description: "Redirect after processing the login credentials."
                    headers:
                        Location:
                            schema:
                                type: string
                            examples:
                                302Success:
                                    description: "Successful authentication. Redirect to Home Page"
                                    value: "/users/{id}/dashboard"
                                302Error:
                                    description: "Failed authentication. Redirect to login form."
                                    value: "/login"

    /logout:
        post:
            operationId: R103
            summary: "R103: Logout Action"
            description: "Logout the current authenticated user. Access: USR, ADM"
            tags:
                - "M01: Authentication"
            responses:
                "302":
                    description: "Redirect after processing logout."
                    headers:
                        Location:
                            schema:
                                type: string
                            examples:
                                302Success:
                                    description: "Successful logout. Redirect to Home Page."
                                    value: "/"

    /register:
        get:
            operationId: R104
            summary: "R104: Register Form"
            description: "Provide new user registration form. Access: PUB"
            tags:
                - "M01: Authentication"
            responses:
                "200":
                    description: "Ok. Show Sign-Up UI"

        post:
            operationId: R105
            summary: "R105: Register Action"
            description: "Processes the new user registration form submission. Access: PUB"
            tags:
                - "M01: Authentication"

            requestBody:
                required: true
                content:
                    application/x-www-form-urlencoded:
                        schema:
                            type: object
                            properties:
                                name:
                                    type: string
                                email:
                                    type: string
                                username:
                                    type: string
                                password:
                                    type: string
                                phone_number:
                                    type: phone
                                profile_image:
                                    type: string
                                    format: binary
                            required:
                                - email
                                - username
                                - password

            responses:
                "302":
                    description: "Redirect after processing the new user information."
                    headers:
                        Location:
                            schema:
                                type: string
                            examples:
                                302Success:
                                    description: "Successful authentication. Redirect to Home Page."
                                    value: "/users/{id}"
                                302Failure:
                                    description: "Failed authentication. Redirect to login form."
                                    value: "/register"

    #M02: Auction
    /create:
        get:
            operationId: R201
            summary: "R201: Create auction form"
            description: "Provide a new auction registration form. Access: USR"
            tags:
                - "M02: Auction"
            responses:
                "200":
                    description: "Ok. Show Auction Creation UI"
        post:
            operationId: R202
            summary: "R202: Create auction"
            description: "Processes the Auction Creation form submission. Access: USR"
            tags:
                - "M02: Auction"

            requestBody:
                required: true
                content:
                    application/x-www-form-urlencoded:
                        schema:
                            type: object
                            properties:
                                title:
                                    type: string
                                description:
                                    type: string
                                min_opening_bid:
                                    type: number
                                    format: money
                                min_raise:
                                    type: number
                                    format: money
                                start_date:
                                    type: string
                                    format: date
                                predicted_end:
                                    type: string
                                    format: date
                                close_date:
                                    type: string
                                    format: date
                                auction_status:
                                    type: string
                                    enum: [active, hidden, canceled, closed]
                                auction_category:
                                    type: string
                                    enum:
                                        [art_piece, book, jewelry, decor, other]
                                auction_image:
                                    type: array
                                    items:
                                        type: string
                                        format: binary
                            required:
                                - title
                                - min_opening_bid
                                - min_raise
                                - start_date
                                - predicted_end
                                - close_date
                                - auction_status
                                - auction_category

            respo--------------------------------nses:
                "302":
                    description: "Redirect after processing the auction creation form."
                    headers:
                        Location:
                            schema:
                                type: string
                            examples:
                                302Success:
                                    description: "Successful auction creation. Redirect to auction page."
                                    value: "/auction/{id}"
                                302Error:
                                    description: "Auction creation failed. Redirect to auction creation form."
                                    value: "/auction/create_auction"

    /auctions/{id}/edit:
        get:
            operationId: R203
            summary: "R203: Edit auction form."
            description: "Provide edit auction form. Access: USR"
            tags:
                - "M02: Auction"
            parameters:
                - in: path
                  name: id
                  schema:
                      type: integer
                  required: true
            responses:
                "200":
                    description: "Ok. Show edit auction UI"

        post:
            operationId: R204
            summary: "R204: Edit auction"
            description: "Processes the edit auction form submission. Access: OWN"
            tags:
                - "M02: Auction"
            parameters:
                - in: path
                  name: id
                  schema:
                      type: integer
                  required: true
            requestBody:
                required: true
                content:
                    application/x-www-form-urlencoded:
                        schema:
                            type: object
                            properties:
                                title:
                                    type: string
                                description:
                                    type: string
                                min_opening_bid:
                                    type: number
                                    format: money
                                min_raise:
                                    type: number
                                    format: money
                                start_date:
                                    type: string
                                    format: date
                                predicted_end:
                                    type: string
                                    format: date
                                close_date:
                                    type: string
                                    format: date
                                auction_status:
                                    type: string
                                    enum: [active, hidden, canceled, closed]
                                auction_category:
                                    type: string
                                    enum:
                                        [art_piece, book, jewelry, decor, other]
                                auction_image:
                                    type: array
                                    items:
                                        type: string
                                        format: binary
                            required:
                                - title
                                - min_opening_bid
                                - min_raise
                                - start_date
                                - predicted_end
                                - close_date
                                - auction_status
                                - auction_category

            responses:
                "302":
                    description: "Redirect after processing the edit auction form."
                    headers:
                        Location:
                            schema:
                                type: string
                            examples:
                                302Success:
                                    description: "Auction successfully edited. Redirect to auction page."
                                    value: "/auction/{id}"
                                302Failure:
                                    description: "Auction couldn't be edited. Redirect to auction page."
                                    value: "/auction/{id}"

    /auctions/{id}/delete:
        delete:
            operationId: R205
            summary: "R205: Delete an auction"
            description: "Set specified auction as 'Canceled'. Access: OWN, ADM"
            tags:
                - "M02: Auction"
            parameters:
                - in: path
                  name: id
                  schema:
                      type: integer
                  required: true
            responses:
                "200":
                    description: "Ok."

    /auctions/{id}:
        get:
            operationId: R206
            summary: "R206: View auction page"
            description: "Show auction page. Access: PUB"
            tags:
                - "M02: Auction"
            parameters:
                - in: path
                  name: id
                  schema:
                      type: integer
                  required: true
            responses:
                "200":
                    description: "Ok. Show Auction Page UI"

    /auctions/{id}/bid:
        post:
            operationId: R208
            summary: "R208: Auction bid"
            description: "R303: Bid on auction. Access: USR"
            tags:
                - "M02: Auction"

            parameters:
                - in: path
                  name: id
                  schema:
                      type: integer
                  required: true

            requestBody:
                required: true
                content:
                    application/x-www-form-urlencoded:
                        schema:
                            type: object
                            properties:
                                bid_value:
                                    type: integer
                                    format: money
                                bidder_id:
                                    type: integer
                            required:
                                - bid_value
                                - bidder_id
            responses:
                "302":
                    description: "Redirect after processing the bid."
                    headers:
                        Location:
                            schema:
                                type: string
                            examples:
                                302Success:
                                    description: "Auction bid successful. Redirect to auction page."
                                    value: "/auction/{id}"
                                302Failure:
                                    description: "Couldn't bid on auction. Redirect to auction page."
                                    value: "/auction/{id}"

    /auctions/{id}/report:
        get:
            operationId: R209
            summary: "R209: Report auction form."
            description: "Provide report auction form. Access: USR"
            tags:
                - "M02: Auction"
            parameters:
                - in: path
                  name: id
                  schema:
                      type: integer
                  required: true
            responses:
                "200":
                    description: "Ok. Ok. Show Auction Report Page UI"

        post:
            operationId: R210
            summary: "R210: Report Auction"
            description: "Processes the report auction form submission. Access: USR"
            tags:
                - "M02: Auction"

            requestBody:
                required: true
                content:
                    application/x-www-form-urlencoded:
                        schema:
                            type: object
                            properties:
                                description:
                                    type: string
                            required:
                                - description

            parameters:
                - in: path
                  name: id
                  schema:
                      type: integer
                  required: true

            responses:
                "302":
                    description: "Redirect after processing the report information."
                    headers:
                        Location:
                            schema:
                                type: string
                            examples:
                                302Success:
                                    description: "Auction report successful. Redirect to auction page."
                                    value: "/auction/{id}"
                                302Failure:
                                    description: "Couldn't report auction. Redirect to report auction form."
                                    value: "/auction/{id}"

    /auctions/{id}/follow:
        post:
            operationId: R211
            summary: "R211: Follow Auction"
            description: "Follow Auction. Access: USR"
            tags:
                - "M02: Auction"

            parameters:
                - in: path
                  name: id
                  schema:
                      type: integer
                  required: true

            responses:
                "302":
                    description: "Redirect after processing auction follow"
                    headers:
                        Location:
                            schema:
                                type: string
                            examples:
                                302Success:
                                    description: "Auction successfully followed. Redirect to auction page."
                                    value: "/auction/{id}"
                                302Failure:
                                    description: "Auction follow failed. Redirect to auction page."
                                    value: "/auction/{id}"

        delete:
            operationId: R212
            summary: "R212: Unfollow Auction"
            description: "Unfollow Auction. Access: USR"
            tags:
                - "M02: Auction"

            parameters:
                - in: path
                  name: id
                  schema:
                      type: integer
                  required: true

            responses:
                "302":
                    description: "Redirect after processing auction unfollow"
                    headers:
                        Location:
                            schema:
                                type: string
                            examples:
                                302Success:
                                    description: "Auction successfully unfollowed. Redirect to auction page."
                                    value: "/auction/{id}"
                                302Failure:
                                    description: "Auction unfollow failed. Redirect to auction page."
                                    value: "/auction/{id}"

    /auctions:
        get:
            operationId: R213
            summary: "R213: Auctions page"
            description: "Displays auctions. Access: PUB."
            tags:
                - "M02: Auction"
            responses:
                "200":
                    description: "Ok. Show Auctions page UI"

    /auctions/search:
        post:
            operationId: R213
            summary: "R213: Search auctions"
            description: "Searches for auctions. Access: PUB."

            tags:
                - "M02: Auction"

            parameters:
                - in: query
                  name: query
                  description: String to use for full-text search
                  schema:
                      type: string
                  required: false
                - in: query
                  name: category
                  description: Auction category
                  schema:
                      type: string
                      enum: [art_piece, book, jewelry, decor, other]
                  required: false
                - in: query
                  name: status
                  description: Auction status
                  schema:
                      type: string
                      enum: [active, hidden, canceled, closed]
                  required: false
                - in: query
                  name: min_bid
                  description: Minimum value for current bid of auction.
                  schema:
                      type: number
                      format: money
                  required: false
                - in: query
                  name: max_bid
                  description: Maximum value for current bid of auction.
                  schema:
                      type: number
                      format: money
                  required: false
                - in: query
                  name: owner
                  description: Boolean with the owner flag value
                  schema:
                      type: boolean
                  required: false
                - in: query
                  name: classification
                  description: Integer corresponding to the work classification
                  schema:
                      type: integer
                  required: false

            responses:
                "200":
                    description: Success
                    content:
                        application/json:
                            schema:
                                type: array
                                items:
                                    type: object
                                properties:
                                    id:
                                        type: integer
                                    title:
                                        type: string
                                    current_bid:
                                        type: number
                                        format: money
                                    start_date:
                                        type: string
                                        format: date
                                    close_date:
                                        type: string
                                        format: date
                                    auction_status:
                                        type: string
                                        enum: [active, hidden, canceled, closed]
                                    auction_category:
                                        type: string
                                        enum:
                                            [
                                                art_piece,
                                                book,
                                                jewelry,
                                                decor,
                                                other,
                                            ]
                                    auction_image:
                                        type: array
                                        items:
                                            type: string
                                            format: binary

    /:
        get:
            operationId: R501
            summary: "R501: Redirect to auctions page"
            description: "Redirect to auctions page. Access: PUB"
            tags:
                - "M05: Static Pages and others"
            responses:
                "200":
                    description: "Ok.Redirect to /auctions "

    /contact_us:
        get:
            operationId: R502
            summary: "R502: Display Contact Us page"
            description: "Display Contact Us page. Access: PUB"
            tags:
                - "M05: Static Pages and others"
            responses:
                "200":
                    description: "Ok. Show contact us page UI"

    /faq:
        get:
            operationId: R502
            summary: "R502: Display FAQ page"
            description: "Display FAQ page. Access: PUB"
            tags:
                - "M05: Static Pages and others"
            responses:
                "200":
                    description: "Ok. Show FAQ page UI"

    /services:
        get:
            operationId: R503
            summary: "R503: Display Services page"
            description: "Display Services page. Access: PUB"
            tags:
                - "M05: Static Pages and others"
            responses:
                "200":
                    description: "Ok. Show Services page UI"

    /about:
        get:
            operationId: R504
            summary: "R504: Display About page"
            description: "Display about page. Access: PUB"
            tags:
                - "M05: Static Pages and others"
            responses:
                "200":
                    description: "Ok. Show About page UI"
    #M03: User
    /users/{id}:
        get:
            operationId: R301
            summary: "R301: User profile"
            description: "Show user profile. Access: PUB"
            tags:
                - "M03: User"
            parameters:
                - in: path
                  name: id
                  schema:
                      type: Integer
                  required: true
            responses:
                "200":
                    description: "Ok. Show User Profile UI"

    /users/{id}/follow:
        post:
            operationId: R302
            summary: "R302: Follow user"
            description: "Follow another user. Access: USR"
            tags:
                - "M03: User"
            parameters:
                - in: path
                  name: id
                  schema:
                      type: integer
                  required: true
            responses:
                "200":
                    description: "Ok. Success"
        delete:
            operationId: R303
            summary: "R303: Unfollow user"
            description: "Unfollow another user. Access: USR"
            tags:
                - "M03: User"
            parameters:
                - in: path
                  name: id
                  schema:
                      type: integer
                  required: true
            responses:
                "200":
                    description: "Ok. Success"

    /users/{id}/rate:
        post:
            operationId: R304
            summary: "R304: Rate user"
            description: "Rate a user. Access: USR"
            tags:
                - "M03: User"
            parameters:
                - in: path
                  name: id
                  schema:
                      type: integer
                  required: true
            requestBody:
                required: true
                content:
                    application/x-www-form-urlencoded:
                        schema:
                            type: object
                            properties:
                                rate_value:
                                    type: integer
                            required:
                                - rate_value
            responses:
                "200":
                    description: "Ok. Success"

    /users/{id}/edit:
        get:
            operationId: R305
            summary: "R305: Provide profile edit form"
            description: "Provide profile edit form. Access: OWN"
            tags:
                - "M03: User"
            parameters:
                - in: path
                  name: id
                  schema:
                  type: Integer
                  required: true
            responses:
                "200":
                    description: "Ok. Show Profile Edit UI"

        post:
            operationId: R306
            summary: "R306: Edit Profile Action"
            description: "Processes the edit user profile form submission. Access: OWN"
            tags:
                - "M03: User"

            requestBody:
                required: true
                content:
                    application/x-www-form-urlencoded:
                        schema:
                            type: object
                            properties:
                                name:
                                    type: string
                                email:
                                    type: string
                                username:
                                    type: string
                                password:
                                    type: string
                                phone_number:
                                    type: phone
                                profile_image:
                                    type: string
                                    format: binary
                            required:
                                - email
                                - username
                                - password

    /users/{id}/delete:
        delete:
            operationId: R307
            summary: "R307: Delete a user account"
            description: "Remove unwanted user from the website. Access: OWN, ADM"
            tags:
                - "M03: User"
            parameters:
                - in: path
                  name: id
                  schema:
                      type: integer
                  required: true
            responses:
                "200":
                    description: "Ok."

    /users:
        get:
            operationId: R308
            summary: "R308: Users page"
            description: "Lists users. Access: PUB"
            tags:
                - "M03: User"
            parameters:
                - in: path
                  name: id
                  schema:
                      type: Integer
                  required: true
            responses:
                "200":
                    description: "Ok. Show Users page UI"

    #M04: Administration

    /admin/reported_auctions:
        get:
            operationId: R402
            summary: "R402: View all reported auctions"
            description: "Displays reported auctions. Access: ADM"
            tags:
                - "M04: Administration"
            responses:
                "200":
                    description: "Success"
                    content:
                        application/json:
                            schema:
                                type: array
                                items:
                                    type: object
                                    properties:
                                        id:
                                            type: integer
                                        title:
                                            type: string
```

---

## A8: Vertical prototype

The Vertical Prototype includes the implementation of the features marked as necessary in the common and theme requirements documents. This artefact aims to validate the architecture presented, also serving to gain familiarity with the technologies used in the project.

The implementation is based on the [LBAW Framework](https://git.fe.up.pt/lbaw/template-laravel) and include work on all layers of the architecture of the solution to implement: user interface, business logic and data access. The prototype includes the implementation of pages of visualization, insertion, edition and removal of information; the control of permissions in the access to the implemented pages.

### 1. Implemented Features

#### 1.1. Implemented User Stories

User stories that were implemented in the prototype.

| User Story reference | Name                            | Priority | Description |
| - | --- | - |------- |
| US01                 | View active auctions            | high     | As a User, I must be able to view all active auctions, so that I'm able to find the ones that interest me.                                                                  |
| US03                 | Search auctions                 | high     | As a User, I must be able to search an active auction, so that I can access a chosen auction at any given time.                                                             |
| US09                 | View/Search user profiles       | medium   | As a User, I want to be able to search and see other user's profiles, so that i can access information that might interest me.                                              |
| US11                 | Login                           | high     | As a Visitor, I want to login into the system, so that I may access more information.                                                                                       |
| US12                 | Registration                    | high     | As a Visitor, I want to be able to register into the system, so that I may access information.                                                                              |
| US21                 | Administer user accounts        | high     | As an Admin, I must to be able to search, view, edit and create user accounts.                                                                                              |
| US22                 | Block and unblock user accounts | high     | As an Admin, I must have the ability to block and unblock accounts, so that I can manage the type of users on the website.                                                  | { width=250px } |
| US23                 | Manage auction                  | high     | As an Admin, I must be able to view, edit and supervise any auction occurring at any time, so that I can make sure things run smoothly.                                     |
| US24                 | Cancel auction                  | high     | As an Admin, I must be able to cancel any auction, so that I can manage the type of auctions occurring on the website.                                                      |
| US25                 | Delete user account             | low      | As an Admin, I want to be able to delete accounts at will, so that I can remove unwanted users from the website.                                                            |
| US31                 | View/Edit Profile               | high     | As an authenticated user, I want to be able to view and edit my own profile, so that I can present myself in a way that I identify with.                                    |
| US32                 | Create Auction                  | high     | As an authenticated user, I want to auction a new item, so that other users can bid on it and eventually buy it.                                                            |
| US32                 | Edit/Delete Auction             | high     | As an authenticated user, I want to be able to edit and/or delete any of my auctions, so that I can decide exactly what my auctions say and if I want them on the platform. |
| US33                 | View My Auctions                | high     | As an authenticated user, I want to access the auctions I own, and all the information attached to them, so that it's easier to run those auctions.                         |
| US34                 | Bid on Auction                  | high     | As an authenticated user, I want to choose the amount of money to be placed, so that I can bid on an item.                                                                  |
| US35                 | Logout                          | high     | As an authenticated user, I want to logout of the system, so that the next person using the browser doesn't see my info.                                                    |
| US38                 | View My Bidding History         | medium   | As an authenticated user, I want to see all the bids I made, so that I can see their value and to what auction they refer to.                                               |

#### 1.2. Implemented Web Resources

Web resources that were implemented in the prototype.

Module M01: Authentication

| Web Resource Reference | URL            |
| ---------------------- | -------------- |
| R101: Login Form       | GET /login         |
| R102: Login Action     | POST /login    |
| R103: Logout           | GET /logout        |
| R104: Register Form    | GET /register      |
| R105: Register Action  | POST/register |

Module M02: Auction

| Web Resource Reference    | URL                      |
| ------------------------- | ------------------------ |
| R201: Create auction form | GET /create                  |
| R202: Create auction      | POST /create              |
| R203: Edit auction form   | GET /auctions/{id}/edit      |
| R204: Edit auction        | POST /auctions/{id}/edit |
| R205: Delete an auction   | GET /auctions/{id}/delete    |
| R206: View an auction     | GET /auctions/{id}'          |
| R208: Auction bid         | GET /auctions/{id}/bid'      |
| R213: View all auctions   | GET /auctions                |
| R214: Search auctions     | GET /search                  |

Module M03: User

| Web Resource Reference      | URL               |
| --------------------------- | ----------------- |
| R301: View user profile     | GET /users/{id}       |
| R205: Profile edit form     | GET /profile/edit     |
| R206: Profile edit Action   | POST /profile/edit |
| R207: Delete a user account | GET /users/{id}/del   |
| R208: Users page            | GET /users            |
| R209: Search users          | GET /search_users     |
| R210: View bids made        | GET /mybids           |

---

### 2. Prototype

The prototype is available at http://lbaw2123.lbaw.fe.up.pt

The code is available at https://git.fe.up.pt/lbaw/lbaw2122/lbaw2123

User credentials necessary to test all features:<br>

Normal user Account:

-   email: prof@gmail.com<br>
-   password: JdNtVVVe<br>

Admin Account:

-   email: admin@gmail.com<br>
-   password: JdNtVVVe<br>

***
1. GROUP2123, 04/01/2022:
* Afonso Duarte de Carvalho Monteiro up201907284
* Ana Rita Antunes Ramada up201904565
* Deborah Marques Lago up201806102
* Maria Sofia Diogo Figueiredo up201904675 (Editor)