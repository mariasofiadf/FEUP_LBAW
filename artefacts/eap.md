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
| OWN         | Owner       |  Users that own information (e.g. own auction, own auction)  |
| ADM   | Administrator        | System administrators     |

### 3. OpenAPI Specification



OpenAPI specification in YAML format to describe the web application's web resources.

Link to the `.yaml` file in the group's repository.

Link to the Swagger generated documentation (e.g. `https://app.swaggerhub.com/apis-docs/...`).

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
| US01                 | Name of the user story | Priority of the user story | Description of the user story |

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

> URL of the prototype plus user credentials necessary to test all features.  
> Link to the prototype source code in the group's git repository.  


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