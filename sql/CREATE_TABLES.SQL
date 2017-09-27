CREATE TABLE IF NOT EXISTS ACCOUNT(
    id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password CHAR(40) NOT NULL,
    status INT(2) NOT NULL DEFAULT 1,
    firstname VARCHAR(128) NOT NULL,
    lastname VARCHAR(128) NOT NULL,
    birthday DATE NOT NULL,
    sex INT(1) NOT NULL,
    mobile VARCHAR(16) NOT NULL,
    address VARCHAR(255),
    district VARCHAR(128),
    city VARCHAR(128),
    state VARCHAR(128),
    nation VARCHAR(64),
    website VARCHAR(255),
    introduce TEXT(1024),
    avatar VARCHAR(255),
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    active_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted INT(1) NOT NULL DEFAULT 0,
    
    CONSTRAINT ACCOUNT_UNIQUE_PK PRIMARY KEY (id),
    UNIQUE(email)
);

CREATE TABLE IF NOT EXISTS REGION(
    id INT NOT NULL AUTO_INCREMENT,
    code VARCHAR(64) NOT NULL,
    name VARCHAR(64) NOT NULL,
    status INT(2) NOT NULL DEFAULT 1,
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted INT(1) NOT NULL DEFAULT 0,
    
    CONSTRAINT REGION_UNIQUE_PK PRIMARY KEY (id),
    UNIQUE (code)
);

CREATE TABLE IF NOT EXISTS GROUPS(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(128) NOT NULL,
    friendly VARCHAR(128),
    description TEXT(1024),
    avatar VARCHAR(255),
    admin_id INT NOT NULL,
    type INT(2) NOT NULL DEFAULT 1,
    status INT(2) NOT NULL DEFAULT 1,
    privacy INT(2) NOT NULL DEFAULT 1,
    region INT(2) NOT NULL,
    parents_id INT,
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    modified_user INT,
    deleted INT(1) NOT NULL DEFAULT 0,
    
    CONSTRAINT GROUP_UNIQUE_PK PRIMARY KEY (id),
    CONSTRAINT GROUP_FK_ACCOUNT FOREIGN KEY (admin_id) REFERENCES ACCOUNT(id),
    UNIQUE (name)
);

CREATE TABLE IF NOT EXISTS ROLE (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(128) NOT NULL,
    description TEXT(1024),
    group_id INT NOT NULL,
    code VARCHAR(64) NOT NULL,
    status INT(2) NOT NULL DEFAULT 1,
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    modified_user INT,
    deleted INT(1) NOT NULL DEFAULT 0,
    
    CONSTRAINT ROLE_UNIQUE_PK PRIMARY KEY (id),
    CONSTRAINT ROLE_FK_GROUP FOREIGN KEY (group_id) REFERENCES GROUPS(id),
    UNIQUE (name, group_id)
);

CREATE TABLE IF NOT EXISTS PERMISSION (     
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(128) NOT NULL,
    description TEXT(1024),
    readable INT(1) NOT NULL DEFAULT 0,
    writable INT(1) NOT NULL DEFAULT 0,
    executable INT(1) NOT NULL DEFAULT 0,
    status INT(2) NOT NULL DEFAULT 1,
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    modified_user INT,
    deleted INT(1) NOT NULL DEFAULT 0,

    CONSTRAINT PERMISSION_UNIQUE_PK PRIMARY KEY (id),
    UNIQUE (name)
);

CREATE TABLE IF NOT EXISTS GROUP_USER (
    group_id INT NOT NULL,
    account_id INT NOT NULL,
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_user INT NOT NULL,
    modified_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    modified_user INT NOT NULL,
    deleted INT(1) NOT NULL DEFAULT 0,
    
    CONSTRAINT GA_UNIQUE_PK PRIMARY KEY (group_id, account_id),
    CONSTRAINT GA_FK_GROUP FOREIGN KEY (group_id) REFERENCES GROUPS(id),
    CONSTRAINT GA_FK_ACCOUNT FOREIGN KEY (account_id) REFERENCES ACCOUNT(id)
);

CREATE TABLE IF NOT EXISTS ROLE_PERMISSION (
    role_id INT NOT NULL,
    permission_id INT NOT NULL,
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_user INT NOT NULL,
    modified_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    modified_user INT NOT NULL,
    deleted INT(1) NOT NULL DEFAULT 0,
    
    CONSTRAINT RP_UNIQUE_PK PRIMARY KEY (role_id, permission_id),
    CONSTRAINT RP_FK_ROLE FOREIGN KEY (role_id) REFERENCES ROLE(id),
    CONSTRAINT RP_FK_ACCOUNT FOREIGN KEY (permission_id) REFERENCES PERMISSION(id)
);

CREATE TABLE IF NOT EXISTS LOG (
    id INT NOT NULL AUTO_INCREMENT,
    function VARCHAR(128) NOT NULL,
    message TEXT(1024) NOT NULL,
    status INT(2) NOT NULL,
    user_id INT NOT NULL,
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    CONSTRAINT LOG_UNIQUE_PK PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS ACCESS (
    id INT NOT NULL AUTO_INCREMENT,
    account_id INT NOT NULL DEFAULT 0,
    password varchar(64),
    token CHAR(32),
    algorithm VARCHAR(32) NOT NULL,
    created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_time BIGINT NOT NULL,
    IP VARCHAR(32) NOT NULL,
    browser VARCHAR(32),
    browser_version VARCHAR(32),
    platform VARCHAR(32),
    mobile VARCHAR(64),
    user_agent VARCHAR(255) NOT NULL,
    referrer VARCHAR(64),
    languages VARCHAR(32),
    remember INT(1) NOT NULL DEFAULT 0,
    
    CONSTRAINT ACCESS_UNIQUE_PK PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS RSAKEY (
    id INT NOT NULL AUTO_INCREMENT,
    public VARCHAR(512) NOT NULL,
    publicHex VARCHAR(512) NOT NULL,
    private VARCHAR(1024) NOT NULL,
    created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    CONSTRAINT RSAKEY_UNIQUE_PK PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS ARTICLES (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(128) NOT NULL,
    friendly VARCHAR(128),
    description VARCHAR(255) NOT NULL,
    image VARCHAR(512) NOT NULL,
    category_id INT NOT NULL,
    keyword VARCHAR(128) NOT NULL,
    series VARCHAR(128),
    status INT(1) NOT NULL DEFAULT 0,
    result INT(1) NOT NULL DEFAULT 0,
    privacy INT(1) NOT NULL DEFAULT 0,
    content TEXT NOT NULL,
    account_id INT NOT NULL,
    created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    actived_date DATETIME,
    popularity int(3) DEFAULT 1,
    admin_id INT,
    deleted INT(1) NOT NULL DEFAULT 0,
    
    CONSTRAINT ARTICLES_UNIQUE_PK PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS CATEGORIES (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,
    friendly VARCHAR(128),
    status INT(1) NOT NULL,
    created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    admin_id INT,
    hash VARCHAR(32),
    deleted INT(1) NOT NULL DEFAULT 0,

    CONSTRAINT CATEGORIES_UNIQUE_PK PRIMARY KEY (id),
    UNIQUE(hash)
);

CREATE TABLE IF NOT EXISTS RESPOND (
    id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    author varchar(128) NOT NULL,
    title VARCHAR(64) NOT NULL,
    friendly VARCHAR(128),
    content TEXT NOT NULL,
    status INT(1) NOT NULL,
    website VARCHAR(255),
    created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    admin_id INT,
    deleted INT(1) NOT NULL DEFAULT 0,

    CONSTRAINT RESPOND_UNIQUE_PK PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS SERIES (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(128) NOT NULL,
    friendly VARCHAR(128),
    code VARCHAR(64) NOT NULL,
    status INT(1) NOT NULL DEFAULT 1,
    created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    deleted INT(1) NOT NULL DEFAULT 0,

    CONSTRAINT CATEGORIES_UNIQUE_PK PRIMARY KEY (id),
    UNIQUE (code, user_id)
);

CREATE TABLE IF NOT EXISTS KEYWORD (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(128) NOT NULL,
    friendly VARCHAR(128),
    status INT(1) NOT NULL DEFAULT 1,
    created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    deleted INT(1) NOT NULL DEFAULT 0,

    CONSTRAINT KEYWORD_UNIQUE_PK PRIMARY KEY (id),
    UNIQUE (name)
);

CREATE VIEW IF NOT EXISTS USER_PERMISSION AS (
    SELECT 
        gu.group_id, gu.account_id, 
        rp.role_id, rp.permission_id, 
        a.email, 
        g.name group_name, g.privacy, g.type, g.region, 
        r.name role_name, 
        p.name permission_name, p.readable, p.writable, p.executable,
        re.id region_id, re.name region_name
    FROM ACCOUNT a, GROUP_USER gu, GROUPS g, ROLE r, PERMISSION p, ROLE_PERMISSION rp, REGION re
    WHERE gu.group_id = g.id
        AND gu.account_id = a.id
        AND gu.group_id = r.group_id
        AND rp.role_id = r.id
        AND rp.permission_id = p.id
        AND g.region = re.id
        AND g.status = 1
        AND g.deleted = 0
        AND gu.deleted = 0
        AND a.deleted = 0
        AND a.status = 1
        AND r.status = 1
        AND r.deleted = 0
        AND p.deleted = 0
        AND p.status = 1
        AND rp.deleted = 0
        AND re.deleted = 0
        AND re.status = 1
);
