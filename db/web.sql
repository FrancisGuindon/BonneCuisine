-- noinspection SqlDialectInspectionForFile

create table client
(
    idClient  smallint    not null
        primary key,
    prenom    varchar(25) not null,
    nom       varchar(25) not null,
    courriel  varchar(50) null,
    telephone varchar(10) null
);

create table facture
(
    idFacture   smallint     not null
        primary key,
    noClient    smallint     not null,
    date        datetime     not null,
    montant     float        not null,
    commentaire varchar(250) null,
    constraint FK_noClient
        foreign key (noClient) references client (idClient)
);

create table commande
(
    idCommande smallint not null,
    noFacture  smallint not null,
    noMenu     smallint not null,
    quantite   smallint not null,
    primary key (idCommande, noMenu),
    constraint FK_noFacture
        foreign key (noFacture) references facture (idFacture)
);

create table forgot_password
(
    idUsager    smallint     not null,
    randomKey   varchar(255) not null,
    expiry_time datetime     not null,
    constraint forgot_password_idUsager_uindex
        unique (idUsager)
);

create table menu
(
    idMenu      smallint auto_increment
        primary key,
    nom         varchar(45)  not null,
    description varchar(250) null,
    prix        float        null
);

create table panier
(
    idPanier   smallint not null,
    noProduit  smallint not null,
    quantite   smallint not null,
    datePanier datetime not null,
    primary key (idPanier, noProduit),
    constraint FK_noProduit
        foreign key (idPanier) references menu (idMenu)
);

create table usager
(
    idUsager smallint auto_increment
        primary key,
    nom      varchar(45)  not null,
    motPasse varchar(250) not null,
    courriel varchar(50)  null,
    constraint usager_courriel_uindex
        unique (courriel),
    constraint usager_nom_uindex
        unique (nom)
);

create definer = root@localhost event event_DeleteAfter5Min on schedule
    every '1' MINUTE
        starts '2020-02-10 20:24:00'
    enable
    do
    DELETE
    FROM forgot_password
    WHERE expiry_time < now();

