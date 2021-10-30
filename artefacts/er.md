# ER: Requirements Specification Component

> Project vision.

## A1: Project Name

> Goals, business context and environment.  
> Motivation.  
> Main features.  
> User profiles.


---


## A2: Actors and User stories

> Brief presentation of the artefact goals.


### 1. Actors

> Diagram identifying actors and their relationships.  
> Table identifying actors, including a brief description.


### 2. User Stories

> User stories organized by actor.  
> For each actor, a table containing a line for each user story, and for each user story: an identifier, a name, a priority, and a description (following the recommended pattern).

#### 2.1. Actor 1

#### 2.2. Actor 2

#### 2.N. Actor N


### 3. Supplementary Requirements

#### 3.1. Business rules

| Identifier | Name                         | Description   |
| :---       | :---                         | :---          |
| BR011      | Private Data Storage         | Upon account deletion (FR.014) shared user data is kept but is made anonymous |
| BR101      | Independent Accounts         | Administrator accounts are independent of the user accounts, i.e. they cannot create or participate in auctions. |
| BR102      | Auction Cancellation         | An auction can only be canceled if there are no bids. |
| BR103      | Valid Bidding                | A user cannot bid if his bid is the current highest. |
| BR104      | Auction (Deadline) Extension | When a bid is made in the last 15 minutes of the auction, the auction deadline is extended by 30 minutes. |

Table TODO: Hand Of Midas business rules.


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

Table TODO: Hand Of Midas technical requirements.


#### 3.3. Restrictions

A restriction on the design limits the degree of freedom in the search for a solution

| Identifier | Name          | Description   |
| :---       | :---          | :---          |
| C01        | ??????????? TODO   |               |

Table TODO: Hand Of Midas project restrictions.

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