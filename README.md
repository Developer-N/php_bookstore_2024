# فروشگاه کتاب با php


### قالب صفحات عمومی

<div align="center">
    <img style="width: 50%; border-radius: 20px;" src="https://github.com/Developer-N/php_bookstore_2024/blob/main/images/theme1.png"  alt="قالب صفحات عمومی"/>
</div>

<hr>

### قالب صفحات مدیریتی

<div align="center">
    <img style="width: 50%; border-radius: 20px;" src="https://github.com/Developer-N/php_bookstore_2024/blob/main/images/theme2.png"  alt="قالب صفحات مدیریتی"/>
</div>
<hr>

###  کد sql لازم برای ساخت پایگاه داده سایت

```mysql
CREATE DATABASE bookstore2024;

USE bookstore2024;
CREATE TABLE users
(
    id           int AUTO_INCREMENT PRIMARY KEY,
    firstName    varchar(100) NOT NULL,
    lastName     varchar(150) NOT NULL,
    phone        varchar(11)  NOT NULL,
    email        varchar(100),
    userName     varchar(50)  NOT NULL UNIQUE,
    userPassword text         NOT NULL,
    userType     varchar(50) DEFAULT 'customer',
    userState    varchar(50) DEFAULT 'active',
    userProfile  varchar(250),
    registerDate datetime
);

USE bookstore2024;
CREATE TABLE categories
(
    id      int PRIMARY KEY AUTO_INCREMENT,
    catName varchar(50)
);

USE bookstore2024;
CREATE TABLE books
(
    id         int AUTO_INCREMENT PRIMARY KEY,
    bookName   varchar(150) NOT NULL,
    author     varchar(150) NOT NULL,
    isbn       varchar(50),
    publisher  varchar(150) NOT NULL,
    coverPhoto varchar(250),
    pageNumber int,
    coverType  varchar(50) DEFAULT 'normal',
    bookCount  int,
    extra      varchar(1000),
    categoryID int,
    insertDate datetime,

    FOREIGN KEY (categoryID) REFERENCES categories (id)
);

use bookstore2024;
CREATE TABLE orders
(
    id          int AUTO_INCREMENT PRIMARY KEY,
    customerID  int,
    bookID      int,
    orderCount  int,
    orderDate   datetime,
    orderStatus varchar(50) DEFAULT 'registered',

    FOREIGN KEY (customerID) REFERENCES users (id),
    FOREIGN KEY (bookID) REFERENCES books (id)
);
```