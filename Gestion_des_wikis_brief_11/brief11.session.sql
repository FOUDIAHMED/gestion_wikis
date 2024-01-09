--@block
DROP database if exists wiki_gestion;

CREATE database wiki_gestion;
use database wiki_gestion;
--@block

CREATE TABLE users (
    user_id int PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255)not null,
    email VARCHAR(255) not null,
    roleuser  enum('Admin','author')default'author',
    password VARCHAR(255) not null,
    isactive boolean default 1
);
--@block

CREATE TABLE categorie(
    idcategory INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) not null,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
--@block

CREATE TABLE tag(
    idtag INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) not null,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE wiki(
    id_wiki INTEGER PRIMARY KEY AUTO_INCREMENT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    nom VARCHAR(255) not null,
    content VARCHAR(600)not null,
    idcat INTEGER,
    iduser INTEGER,
    constraint fk_cat foreign key (idcat) references categorie(idcategory),
    constraint fk_user foreign key (iduser) references user(user_id)
);

CREATE TABLE wiki_tag(
    wiki_id INTEGER,
    id_tag INTEGER,
    constraint pk_wt PRIMARY key (wiki_id, id_tag),
    constraint fk_tag foreign key (id_tag) references tag(idtag),
    constraint fk_wiki foreign key (wiki_id) references wiki(id_wiki)
);

