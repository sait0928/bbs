create table posts(
    id int auto_increment,
    post varchar(255) not null,
    created_at datetime not null default current_timestamp,
    updated_at datetime not null default current_timestamp on update current_timestamp,
    user_id int not null,
    primary key (id),
    index (id),
    foreign key (user_id) references users (id)
);