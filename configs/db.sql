CREATE TABLE admin (
    id INT NOT NULL AUTO_INCREMENT,
    fName VARCHAR(100) NOT NULL,
    lName VARCHAR(100) NOT NULL,
    uName VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    CONSTRAINT pk_admin PRIMARY KEY(id)
);

CREATE TABLE events (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    image_name VARCHAR(255) NOT NULL,
    CONSTRAINT pk_events PRIMARY KEY(id)
);

CREATE TABLE menus_types (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price DECIMAL(11, 2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    CONSTRAINT pk_menus_types PRIMARY KEY(id)
);

CREATE TABLE extras_types (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price DECIMAL(11, 2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    CONSTRAINT pk_extras_types PRIMARY KEY(id)
);

CREATE TABLE payment_method (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    CONSTRAINT pk_payment PRIMARY KEY(id)
); 

CREATE TABLE payment_details (
    id INT NOT NULL AUTO_INCREMENT,
    extras_total DECIMAL(11, 2),
    menus_total DECIMAL(11, 2),
    total DECIMAL(11, 2) NOT NULL,
    minPayment DECIMAL(11, 2) NOT NULL,
    paid DECIMAL(11, 2) NOT NULL,
    balance DECIMAL(11, 2) NOT NULL,
    pay_method INT NOT NULL,
    CONSTRAINT pk_payment_details PRIMARY KEY(id);
    CONSTRAINT fk_pay_method FOREIGN KEY(pay_method)
    REFERENCES payment_method(id)
);

CREATE TABLE bookings (
    id INT NOT NULL AUTO_INCREMENT,
    eventID INT,
    eventDate DATE,
    status enum('confirmed', 'cancelled'),
    receiptID INT,
    CONSTRAINT pk_bookings PRIMARY KEY(id),
    CONSTRAINT pk_event_bookings FOREIGN KEY(eventID)
        REFERENCES events(id),
    CONSTRAINT pk_pay_bookings FOREIGN KEY(receiptID)
        REFERENCES payment_details(id),
)

CREATE TABLE menus_bookings (
    id INT NOT NULL AUTO_INCREMENT,
    type INT NOT NULL,
    bookingID INT NOT NULL,
    quantity INT NOT NULL,
    total DECIMAL(11, 2) NOT NULL,
    CONSTRAINT pk_menus_bookings PRIMARY KEY(id),
    CONSTRAINT fk_book_menu FOREIGN KEY(bookingID)
    REFERENCES booking(id);
);

CREATE TABLE extras_bookings (
    id INT NOT NULL AUTO_INCREMENT,
    type INT NOT NULL,
    bookingID INT NOT NULL,
    quantity INT NOT NULL,
    total DECIMAL(11, 2) NOT NULL,
    CONSTRAINT pk_extras_bookings PRIMARY KEY(id),
    CONSTRAINT fk_book_extras FOREIGN KEY(bookingID)
    REFERENCES bookings(id);
);