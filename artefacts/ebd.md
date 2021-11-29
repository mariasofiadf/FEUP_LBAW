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
| Priority    | ENUM ('High', 'Medium', 'Low') |

### 3. Schema validation

> To validate the Relational Schema obtained from the Conceptual Model, all functional dependencies are identified and the normalization of all relation schemas is accomplished. Should it be necessary, in case the scheme is not in the Boyce–Codd Normal Form (BCNF), the relational schema is refined using normalization.  

| **TABLE R01**   | User               |
| --------------  | ---                |
| **Keys**        | { id }, { email }  |
| **Functional Dependencies:** |       |
| FD0101          | id → {email, name} |
| FD0102          | email → {id, name} |
| ...             | ...                |
| **NORMAL FORM** | BCNF               |

> If necessary, description of the changes necessary to convert the schema to BCNF.  
> Justification of the BCNF.  


---


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

> The system being developed must provide full-text search features supported by PostgreSQL. Thus, it is necessary to specify the fields where full-text search will be available and the associated setup, namely all necessary configurations, indexes definitions and other relevant details.  

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | Relation where the index is applied    |
| **Attribute**       | Attribute where the index is applied   |
| **Type**            | B-tree, Hash, GiST or GIN              |
| **Clustering**      | Clustering of the index                |
| **Justification**   | Justification for the proposed index   |
| `SQL code`                                                  ||


### 3. Triggers
 
> User-defined functions and trigger procedures that add control structures to the SQL language or perform complex computations, are identified and described to be trusted by the database server. Every kind of function (SQL functions, Stored procedures, Trigger procedures) can take base types, composite types, or combinations of these as arguments (parameters). In addition, every kind of function can return a base type or a composite type. Functions can also be defined to return sets of base or composite values.  

| **Trigger**      | TRIGGER01                              |
| ---              | ---                                    |
| **Description**  | An Admin must not have the same username or email as a User |

    DROP FUNCTION IF EXISTS admin_diff_user CASCADE;
    CREATE FUNCTION admin_diff_user() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
        IF EXISTS (SELECT username FROM users WHERE NEW.username = users.username) THEN
            RAISE EXCEPTION 'An Admin must not have the same username as a User.';
        END IF;
        IF EXISTS (SELECT email FROM users WHERE NEW.email = users.email) THEN
            RAISE EXCEPTION 'An Admin must not have the same email as a User';
        END IF;
        RETURN NEW;
    END
    $BODY$
    LANGUAGE plpgsql;

    DROP TRIGGER IF EXISTS admin_diff_user on admin CASCADE;
    CREATE TRIGGER admin_diff_user
        BEFORE INSERT OR UPDATE ON admin 
        FOR EACH ROW 
        EXECUTE PROCEDURE admin_diff_user();

| **Trigger**      | TRIGGER02                              |
| ---              | ---                                    |
| **Description**  | A User must not have the same username nor email as an Admin |

    DROP FUNCTION IF EXISTS user_diff_admin CASCADE;
    CREATE FUNCTION user_diff_admin() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
        IF EXISTS (SELECT * FROM users WHERE NEW.username = admin.username) THEN
            RAISE EXCEPTION 'A User must not have the same username as an Admin.';
        END IF;
        IF EXISTS (SELECT * FROM users WHERE NEW.email = admin.email) THEN
            RAISE EXCEPTION 'A User must not have the same email as an Admin';
        END IF;
        RETURN NEW;
    END
    $BODY$
    LANGUAGE plpgsql;

    DROP TRIGGER IF EXISTS user_diff_admin on users CASCADE;
    CREATE TRIGGER user_diff_admin
        BEFORE INSERT OR UPDATE ON users 
        FOR EACH ROW 
        EXECUTE PROCEDURE user_diff_admin();

| **Trigger**      | TRIGGER03                              |
| ---              | ---                                    |
| **Description**  | A User cannot bid on one of their own auctions |

    DROP FUNCTION IF EXISTS user_bid CASCADE;
    CREATE FUNCTION user_bid() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
        IF EXISTS (SELECT * FROM auction WHERE NEW.bidder_id = auction.seller_id AND NEW.auction_id = auction.id ) THEN
            RAISE EXCEPTION 'A member cannot bid on their own auction.';
        END IF;
        RETURN NEW;
    END
    $BODY$
    LANGUAGE plpgsql;

    DROP TRIGGER IF EXISTS user_bid on bid CASCADE;
    CREATE TRIGGER user_bid
        BEFORE INSERT OR UPDATE ON bid 
        FOR EACH ROW 
        EXECUTE PROCEDURE user_bid();

| **Trigger**      | TRIGGER04                              |
| ---              | ---                                    |
| **Description**  | When an auction closes, the winning bid is set |

    DROP FUNCTION IF EXISTS win_bid CASCADE;
    CREATE FUNCTION win_bid() RETURNS TRIGGER AS
    $BODY$
    DECLARE 
        max_bid INTEGER;
    BEGIN
        SELECT max(bid_value) INTO max_bid FROM bid WHERE bid.auction_id = NEW.id;
        IF (NEW.auction_status = 'Closed') THEN
            UPDATE auction
                SET win_bid = max_bid
                WHERE NEW.id = auction.id;
        END IF;
        RETURN NEW;
    END
    $BODY$
    LANGUAGE plpgsql;

    DROP TRIGGER IF EXISTS win_bid on bid CASCADE;
    CREATE TRIGGER win_bid
        AFTER UPDATE ON auction 
        FOR EACH ROW 
        EXECUTE PROCEDURE win_bid();

| **Trigger**      | TRIGGER05                              |
| ---              | ---                                    |
| **Description**  | A User bid on an auction must be higher than the current highest |

    DROP FUNCTION IF EXISTS min_bid CASCADE;
    CREATE FUNCTION min_bid() RETURNS TRIGGER AS
    $BODY$
    DECLARE 
        max_bid INTEGER;
        min_inc INTEGER;
    BEGIN
        SELECT max(bid_value) INTO max_bid FROM bid WHERE bid.auction_id = NEW.auction_id;
        SELECT min_raise INTO min_inc FROM auction WHERE NEW.auction_id = auction.id;
        IF (max_bid + min_raise > NEW.bid_value) THEN
            RAISE EXCEPTION 'New bid must be higher than all the previous bids plus the minimum raise';
        END IF;
        RETURN NEW;
    END
    $BODY$
    LANGUAGE plpgsql;

    DROP TRIGGER IF EXISTS min_bid on bid CASCADE;
    CREATE TRIGGER min_bid
        BEFORE UPDATE ON bid 
        FOR EACH ROW 
        EXECUTE PROCEDURE min_bid();


| **Trigger**      | TRIGGER06                              |
| ---              | ---                                    |
| **Description**  | When an auction gets a new bid, the close_date gets increased |

    DROP FUNCTION IF EXISTS extend_auction CASCADE;
    CREATE FUNCTION extend_auction() RETURNS TRIGGER AS
    $BODY$
    BEGIN
        UPDATE auction
        SET close_date = close_date + 1 --mudar?
        WHERE NEW.auction_id = auction.id;
        RETURN NEW;
    END
    $BODY$
    LANGUAGE plpgsql;

    DROP TRIGGER IF EXISTS extend_auction on bid CASCADE;
    CREATE TRIGGER extend_auction
        BEFORE UPDATE ON bid 
        FOR EACH ROW 
        EXECUTE PROCEDURE extend_auction();

| **Trigger**      | TRIGGER07                              |
| ---              | ---                                    |
| **Description**  | When User receives rating, their rating is updated |

    DROP FUNCTION IF EXISTS new_rating CASCADE;
    CREATE FUNCTION new_rating() RETURNS TRIGGER AS 
    $BODY$
    DECLARE
        rate_count INTEGER;
    BEGIN
        SELECT COUNT(*) INTO rate_count FROM rating 
        WHERE rating.id_rated = NEW.id_rated;

        UPDATE users
            SET rating = ((users.rating * rate_count)+NEW.rate_value)/(rate_count+1)
            WHERE users.id = NEW.id_rated;
        RETURN NEW;
    END
    $BODY$
    LANGUAGE plpgsql;

    DROP TRIGGER IF EXISTS new_rating on bid CASCADE;
    CREATE TRIGGER new_rating
        BEFORE INSERT ON rating 
        FOR EACH ROW 
        EXECUTE PROCEDURE new_rating();


| **Trigger**      | TRIGGER08                              |
| ---              | ---                                    |
| **Description**  | When a User changes their rating of another User, the rating of the rated user is updated |

    DROP FUNCTION IF EXISTS update_rating CASCADE;
    CREATE FUNCTION update_rating() RETURNS TRIGGER AS 
    $BODY$
    DECLARE
        rate_count INTEGER;
    BEGIN
        SELECT COUNT(*) INTO rate_count FROM rating 
        WHERE rating.id_rated = NEW.id_rated;

        UPDATE users
            SET rating = ((users.rating * rate_count) - OLD.rate_value + NEW.rate_value)/(rate_count)
            WHERE users.id = NEW.id_rated;
        RETURN NEW;
    END
    $BODY$
    LANGUAGE plpgsql;

    DROP TRIGGER IF EXISTS update_rating on bid CASCADE;
    CREATE TRIGGER update_rating
        BEFORE UPDATE ON rating 
        FOR EACH ROW 
        EXECUTE PROCEDURE update_rating();

| **Trigger**      | TRIGGER09                              |
| ---              | ---                                    |
| **Description**  | When a User removes their rating of another User, the rating of the previously rated user is updated |

    DROP FUNCTION IF EXISTS delete_rating CASCADE;
    CREATE FUNCTION delete_rating() RETURNS TRIGGER AS 
    $BODY$
    DECLARE
        rate_count INTEGER;
    BEGIN
        SELECT COUNT(*) INTO rate_count FROM rating 
        WHERE rating.id_rated = NEW.id_rated;

        UPDATE users
            SET rating = ((users.rating * rate_count) - OLD.rate_value)/(rate_count-1)
            WHERE users.id = NEW.id_rated;
        RETURN NEW;
    END
    $BODY$
    LANGUAGE plpgsql;

    DROP TRIGGER IF EXISTS delete_rating on bid CASCADE;
    CREATE TRIGGER delete_rating
        BEFORE DELETE ON rating 
        FOR EACH ROW 
        EXECUTE PROCEDURE delete_rating();

| **Trigger**      | TRIGGER10                              |
| ---              | ---                                    |
| **Description**  | When a User is followed they must get a "Follow" user_notification |

    DROP FUNCTION IF EXISTS new_follow_notif CASCADE;
    CREATE FUNCTION new_follow_notif() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
        INSERT INTO user_notification(notified_id, notifier_id, notif_category)
        VALUES (NEW.id_folllowed, NEW.id_folllower,'Follow');
    END
    $BODY$
    LANGUAGE plpgsql;

    DROP TRIGGER IF EXISTS new_follow_notif on bid CASCADE;
    CREATE TRIGGER new_follow_notif
        AFTER INSERT ON user_follow 
        FOR EACH ROW 
        EXECUTE PROCEDURE new_follow_notif();

| **Trigger**      | TRIGGER11                              |
| ---              | ---                                    |
| **Description**  | When a User receives a rating they must get a "Rating" user_notification |

    DROP FUNCTION IF EXISTS new_rating_notif CASCADE;
    CREATE FUNCTION new_rating_notif() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
        INSERT INTO user_notification(notified_id, notifier_id, notif_category)
        VALUES (NEW.id_rated, NEW.id_rates,'Rating');
    END
    $BODY$
    LANGUAGE plpgsql;

    DROP TRIGGER IF EXISTS new_rating_notif on bid CASCADE;
    CREATE TRIGGER new_rating_notif
        AFTER INSERT ON rating 
        FOR EACH ROW 
        EXECUTE PROCEDURE new_rating_notif();

| **Trigger**      | TRIGGER12                              |
| ---              | ---                                    |
| **Description**  | When a User follows an Auction, it's User gets a notification |

    DROP FUNCTION IF EXISTS new_auction_follow_notif CASCADE;
    CREATE FUNCTION new_auction_follow_notif() RETURNS TRIGGER AS 
    $BODY$
    DECLARE
        seller_id INTEGER;
    BEGIN
        SELECT auction.seller_id INTO seller_id FROM auction 
        WHERE auction.id = NEW.id_folllowed;
        INSERT INTO auction_notification(notified_id, auction_id, anotif_category)
        VALUES (seller_id, NEW.id_folllowed,'Follow');
    END
    $BODY$
    LANGUAGE plpgsql;

    DROP TRIGGER IF EXISTS new_auction_follow_notif on bid CASCADE;
    CREATE TRIGGER new_auction_follow_notif
        AFTER INSERT ON auction_follow 
        FOR EACH ROW 
        EXECUTE PROCEDURE new_auction_follow_notif();


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