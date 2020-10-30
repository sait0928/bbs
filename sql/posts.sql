create table posts(
    id int auto_increment,
    post varchar(255) not null,
    user_id int not null,
    primary key (id),
    foreign key (user_id) references users (id)
);