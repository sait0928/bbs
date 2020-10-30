create table users(
    id int auto_increment,
    name varchar(255) not null,
    email varchar(255) not null,
    pass varchar(255) not null,
    primary key (id),
    unique (email)
);