# EBD: Database Specification Component

> Project vision.

## A4: Conceptual Data Model

> Brief presentation of the artefact goals.

### 1. Class diagram

> UML class diagram containing the classes, associations, multiplicity and roles.  
> For each class, the attributes, associations and constraints are included in the class diagram.

### 2. Additional Business Rules
 
> Business rules can be included in the UML diagram as UML notes or in a table in this section.


---


## A5: Relational Schema, validation and schema refinement

> Brief presentation of the artefact goals.

### 1. Relational Schema

> The Relational Schema includes the relation schemas, attributes, domains, primary keys, foreign keys and other integrity rules: UNIQUE, DEFAULT, NOT NULL, CHECK.  
> Relation schemas are specified in the compact notation:  

| Relation reference | Relation Compact Notation                        |
| ------------------ | ------------------------------------------------ |
| R01                | Table1(__id__, attribute NN)                     |
| R02                | Table2(__id__, attribute → Table1 NN)            |
| R03                | Table3(__id1__, id2 → Table2, attribute UK NN)   |
| R04                | Table4((__id1__, __id2__) → Table3, id3, attribute CK attribute > 0) |

### 2. Domains

> The specification of additional domains can also be made in a compact form, using the notation:  

| Domain Name | Domain Specification           |
| ----------- | ------------------------------ |
| Today	      | DATE DEFAULT CURRENT_DATE      |
|AuctionNotification       |'Opened', 'Closed', 'New Bid', 'New Message', 'Other'|
|AuctionStatus       |'Active', 'Hidden', 'Canceled', 'Closed'|
|AuctionCategory       |'ArtPiece', 'Book', 'Jewlery', 'Decor', 'Other'|


### 3. Schema validation

 To validate the Relational Schema obtained from the Conceptual Model, all functional dependencies are identified and the normalization of all relation schemas is accomplished. 

| **TABLE R01**                | User                            |
| --------------               | ---                             |
| **Keys**                     | { id }, { email }               |
| **Functional Dependencies:** |                                 |
| FD0101                       | id → {email, name}              |
| FD0102                       | email → {id, name}              |
| **NORMAL FORM**              | BCNF                            |


| **TABLE R02**                | Auction                         |
| --------------               | ---                             |
| **Keys**                     | { id }                          |
| **Functional Dependencies:** |                                 |
| FD0201                       | { id } → {title, description, category, start_date, predicted_end, close_date, min_opening_bid, status, seller_id, image_id}|
| **NORMAL FORM**              | BCNF                            |


| **TABLE R03**                | Bid                             |
| --------------               | ---                             |
| **Keys**                     | { id }                          |
| **Functional Dependencies:** |                                 |
| FD0301                       | { id } → {value, date, auction_id, bidder_id}|
| **NORMAL FORM**              | BCNF                            |

| **TABLE R04**                | Admin                           |
| --------------               | ---                             |
| **Keys**                     | { id }                          |
| **Functional Dependencies:** |                                 |
| FD0401                       | { id } → {name, username, email}|
| **NORMAL FORM**              | BCNF                            |

| **TABLE R05**                | Message                         |
| --------------               | ---                             |
| **Keys**                     | { id }                          |
| **Functional Dependencies:** |                                 |
| FD0501                       | { id } → {content, date, user_id, chat_id}|
| **NORMAL FORM**              | BCNF                            |

| **TABLE R07**                | Image                           |
| --------------               | ---                             |
| **Keys**                     | { id }                          |
| **Functional Dependencies:** |                                 |
| FD0701                       | { id } → {content, label}       |
| **NORMAL FORM**              | BCNF                            |

| **TABLE R08**                | AuctionReport                   |
| --------------               | ---                             |
| **Keys**                     | { auction_id, user_id }         |
| **Functional Dependencies:** |                                 |
| FD0901                       | { auction_id, user_id } → {description}|
| ...                          | ...                             |
| **NORMAL FORM**              | BCNF                            |

| **TABLE R09**                | Rating                          |
| --------------               | ---                             |
| **Keys**                     | { id_rated }, { id_rates }      |
| **Functional Dependencies:** |                                 |
| FD1001                       | {id_rated, id_rates} → {value, date, description}|
| **NORMAL FORM**              | BCNF                            |

| **TABLE R10**                | UserFollow                      |
| --------------               | ---                             |
| **Keys**                     | { id_followed }, { id_follower }|
| **Functional Dependencies:** |                                 |
| FD1101                       | id_followed → {id_follower}     |
| FD1102                       | id_follower → {id_followed}     |
| **NORMAL FORM**              | BCNF                            |

| **TABLE R11**                | AuctionFollow                   |
| --------------               | ---                             |
| **Keys**                     | { id_followed }, {id_follower}  |
| **Functional Dependencies:** |                                 |
| FD1201                       | id_followed → {id_follower}     |
| FD1202                       | id_follower → {id_followed}     |
| **NORMAL FORM**              | BCNF                            |

| **TABLE R12**                | UserNotification                |
| --------------               | ---                             |
| **Keys**                     | { id }                          |
| **Functional Dependencies:** |                                 |
| FD1301                       | { id } → {read, time, category} |
| ...                          | ...                             |
| **NORMAL FORM**              | BCNF                            |

| **TABLE R13**                | AuctionNotification             |
| --------------               | ---                             |
| **Keys**                     | { id }                          |
| **Functional Dependencies:** |                                 |
| FD1401                       | { id } → {read, time, category} |
| **NORMAL FORM**              | BCNF                            |

As all relations schemas are in the Boyce–Codd Normal Form (BCNF), the relational schema is also in the BCNF and therefore there is no need to be refined using normalisation.




## A6: Indexes, triggers, transactions and database population

> Brief presentation of the artefact goals.

### 1. Database Workload
 
> A study of the predicted system load (database load).
> Estimate of tuples at each relation.

| **Relation reference** | **Relation Name** | **Order of magnitude**        | **Estimated growth** |
| ------------------ | ------------- | ------------------------- | -------- |
| R01                | Table1        | units|dozens|hundreds|etc | order per time |
| R02                | Table2        | units|dozens|hundreds|etc | dozens per month |
| R03                | Table3        | units|dozens|hundreds|etc | hundreds per day |
| R04                | Table4        | units|dozens|hundreds|etc | no growth |


### 2. Proposed Indices

#### 2.1. Performance Indices
 
> Indices proposed to improve performance of the identified queries.

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | Relation where the index is applied    |
| **Attribute**       | Attribute where the index is applied   |
| **Type**            | B-tree, Hash, GiST or GIN              |
| **Cardinality**     | Attribute cardinality: low/medium/high |
| **Clustering**      | Clustering of the index                |
| **Justification**   | Justification for the proposed index   |
| `SQL code`                                                  ||

> Analysis of the impact of the performance indices on specific queries.
> Include the execution plan before and after the use of indices.

| **Query**       | SELECT01                               |
| ---             | ---                                    |
| **Description** | One sentence describing the query goal |
| `SQL code`                                              ||
| **Execution Plan without indices**                      ||
| `Execution plan`                                        ||
| **Execution Plan with indices**                         ||
| `Execution plan`                                        ||


#### 2.2. Full-text Search Indices 

The developed system will provide full-text search features supported by PostgreSQL.

Thus, the fields where full-text search will be available and the associated setup (all necessary configurations, indexes definitions and other relevant details) are here specified.

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | auction, member                        |
| **Attribute**       | {title, description, username, name}   |
| **Type**            | GIN                                    |
| **Clustering**      | No                                     |
| **Justification**   | To better the performance and results on FTS for auctions. Using GIN type because it will be accessed very frequently and rarely updated.|
| `SQL code`
    SELECT auction.id, ts_auction(auction.ts_search, plainto_tsquery('english', $search_text));
    FROM auction
            INNER JOIN auction_follow ON auction_follow.id_followed = auction.id AND auction_follow.follower_id = users.id
            INNER JOIN bid ON bid.auction_id = auction.id 
        WHERE
            auction.category IN ($category1, $category2, ...) AND
            auction.status IN ($status1, $status2) AND
            bid.value >= min_opening_bid::money AND
            auction.ts_search @@ plainto_tsquery('english', $text_search)
        ORDER BY ts_auction DESC;

    CREATE INDEX auction_search_idx USING GIN (ts_auction);||

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | member                                 |
| **Attribute**       | {username, name}                       |
| **Type**            | GIN                                    |
| **Clustering**      | No                                     |
| **Justification**   | To better the performance and results on FTS for users. Using GIN type because it will be accessed very frequently and rarely updated.|
| `SQL code`
    ALTER TABLE users ADD COLUMN tsvectors TSVECTOR;
    CREATE FUNCTION u_search_update() RETURNS TRIGGER AS $$
    BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
            setweight(to_tsvector('english', NEW.username), 'A') ||
            setweight(to_tsvector('english', NEW.name), 'B')
        );
    END IF;
    IF TG_OP = 'UPDATE' THEN
        IF (NEW.username <> OLD.username OR NEW.name <> OLD.name) THEN
            NEW.tsvectors = (
            setweight(to_tsvector('english', NEW.username), 'A') ||
            setweight(to_tsvector('english', NEW.name), 'B')
            );
        END IF;
    END IF;
    RETURN NEW;
    END $$
    LANGUAGE plpgsql;

    CREATE TRIGGER u_search_update
        BEFORE INSERT OR UPDATE ON users
        FOR EACH ROW
        EXECUTE PROCEDURE u_search_update();

    CREATE INDEX users_search_idx USING GIN (tsvectors);||


### 3. Triggers
 
> User-defined functions and trigger procedures that add control structures to the SQL language or perform complex computations, are identified and described to be trusted by the database server. Every kind of function (SQL functions, Stored procedures, Trigger procedures) can take base types, composite types, or combinations of these as arguments (parameters). In addition, every kind of function can return a base type or a composite type. Functions can also be defined to return sets of base or composite values.  

| **Trigger**      | TRIGGER01                              |
| ---              | ---                                    |
| **Description**  | Trigger description, including reference to the business rules involved |
| `SQL code`                                             ||

### 4. Transactions
 
> Transactions needed to assure the integrity of the data.  

| SQL Reference   | Transaction Name                    |
| --------------- | ----------------------------------- |
| Justification   | Justification for the transaction.  |
| Isolation level | Isolation level of the transaction. |
| `Complete SQL Code`                                   ||


## Annex A. SQL Code

> The database scripts are included in this annex to the EBD component.
> 
> The database creation script and the population script should be presented as separate elements.
> The creation script includes the code necessary to build (and rebuild) the database.
> The population script includes an amount of tuples suitable for testing and with plausible values for the fields of the database.
>
> This code should also be included in the group's git repository and links added here.

### A.1. Database schema

### A.2. Database population


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