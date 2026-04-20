create table henkilo (
 hetu char(11),
 nimi varchar(50),
 osoite varchar(100),
 puhelinnumero varchar(20),
 primary key (hetu)
);

create table auto (
 rekisterinro char(7),
 vari varchar(30),
 vuosimalli int,
 omistaja char(11),
 primary key (rekisterinro),
 foreign key (omistaja) references henkilo(hetu)
);

insert into henkilo values ('281182-070W', 'Anne Autoilija', 'Kanervapolku 2', '050-1640837');
insert into henkilo values ('080173-169T', 'Matti Miettinen', 'Koivukuja 25', '040-1842950');
insert into henkilo values ('120760-093B', 'Tapio Tamminen', 'Tammistontie 18', '0400-
576397');
insert into henkilo values ('200292-195H', 'Teemu Tamminen', 'Tammistontie 18', '040-
9740768');

insert into auto values ('CES-528', 'sininen', 2010, '281182-070W');
insert into auto values ('HUT-444', 'kulta', 2006, '120760-093B');
insert into auto values ('ROA-630', 'harmaa', 2011, '080173-169T');