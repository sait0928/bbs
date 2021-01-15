create table users(
    id int auto_increment,
    name varchar(255) not null,
    email varchar(255) not null,
    pass varchar(255) not null,
    created_at datetime not null default current_timestamp,
    updated_at datetime not null default current_timestamp on update current_timestamp,
    primary key (id),
    index (id),
    unique (email)
);