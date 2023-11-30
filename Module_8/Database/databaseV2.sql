create table User
(
    userId    int unsigned auto_increment
        primary key,
    userType  varchar(255)                         not null,
    firstName varchar(255)                         not null,
    lastName  varchar(255)                         not null,
    email     varchar(255)                         not null,
    password  varchar(255)                         not null,
    createdAt datetime default current_timestamp() not null,
    updatedAt datetime default current_timestamp() not null on update current_timestamp(),
    about     text                                 null,
    constraint uniqueEmail
        unique (email)
);

create table Booking
(
    bookingId   int unsigned auto_increment
        primary key,
    studentId   int unsigned                         null,
    tutorId     int unsigned                         null,
    bookingTime datetime                             not null,
    status      varchar(255)                         not null,
    createdAt   datetime default current_timestamp() not null,
    updatedAt   datetime default current_timestamp() not null on update current_timestamp(),
    constraint Booking_ibfk_1
        foreign key (studentId) references User (userId)
            on delete cascade,
    constraint Booking_ibfk_2
        foreign key (tutorId) references User (userId)
            on delete cascade
);

create index studentId
    on Booking (studentId);

create index tutorId
    on Booking (tutorId);

create table Message
(
    messageId   int unsigned auto_increment
        primary key,
    senderId    int unsigned                           not null,
    receiverId  int unsigned                           not null,
    sentAt      datetime   default current_timestamp() not null,
    messageText text                                   not null,
    isRead      tinyint(1) default 0                   not null,
    constraint Message_ibfk_1
        foreign key (senderId) references User (userId)
            on delete cascade,
    constraint Message_ibfk_2
        foreign key (receiverId) references User (userId)
            on delete cascade
);

create index receiverId
    on Message (receiverId);

create index senderId
    on Message (senderId);

create table Notification
(
    notificationId   int unsigned auto_increment
        primary key,
    senderId         int unsigned                           null,
    receiverId       int unsigned                           not null,
    sentAt           datetime   default current_timestamp() not null,
    notificationText text                                   not null,
    isRead           tinyint(1) default 0                   not null,
    constraint Notification_ibfk_1
        foreign key (senderId) references User (userId),

    constraint Notification_ibfk_2
        foreign key (receiverId) references User (userId)
            on delete cascade
);

create index receiverId
    on Notification (receiverId);

create index email
    on User (email);

