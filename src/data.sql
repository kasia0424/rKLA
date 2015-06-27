kla_trainigns
kla_types
kla_places

kla_posts
kla_photos
(rodzaj??)

(??
pyt
odp
??)

so_users
so_roles

CREATE TABLE IF NOT EXISTS `kla_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(64) COLLATE utf8_bin NOT NULL,
  `price` float COLLATE utf8_bin NULL,
  `info` char(255) COLLATE utf8_bin NULL,
  `date` DATE NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `place` int(10) unsigned NULL,
  `meeting` int(10) unsigned NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('łucznictwo współczesne 2', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('profilowanie kryminologiczne', '2015-03-07', '2');
// places - LOK id 1
INSERT INTO `12_sipel`.`kla_events` (`name`, `info`, `date`, `type_id`, `place`) VALUES ('warsztaty rusznikarskie', 'warsztaty z budowy, utrzymania i konserwacji broni', '2015-03-07', '2', '1');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('warsztaty pirotechniczne', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('warsztaty łuczniczo-kusznicze ', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `info`, `date`, `type_id`) VALUES ('Islam we współczesnym świecie, m.in. o taktyce mudżahedinów', 'konferencja Polskiego Towarzystwa Geopolitycznego', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `info`, `date`, `type_id`) VALUES ('mini selekcja do jednostek specjalnych', 'z bardzo obniżonymi wymogami, warto się sprawdzić', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');
INSERT INTO `12_sipel`.`kla_events` (`name`, `date`, `type_id`) VALUES ('inauguracja sezonu – nocna taktyka', '2015-03-07', '2');


//photos
INSERT INTO `12_sipel`.`kla_photos` (`name`, `post_id`, `description`) VALUES ('11205127_451780918315129_3619502430463042219_n', '6', 'rtdfyug');

//posty
INSERT INTO `12_sipel`.`kla_posts` (`title`, `content`, `date`, `author`) VALUES ('Szkolenie unitare', 'Ostatni dzień szkolenia unitarnego w tym roku był bardzo ciepły, ale nie dla wszystkich. Legioniści rozpoczęli zajęcia o 3 w nocy, gdy na polach lśnił w pełni księżyca śnieg. Po ćwiczeniu gotowości bojowej, która unaoczniła uczestnikom ich braki, kontynuowano szkolenie umiejętności bojowych: posługiwania się granatami ręcznymi, wykonywania okopów i korzystania z różnego innego sprzętu. Po szkoleniach odbyła się uroczysta przysięga wojskowa dla rekrutów poprzedzona udziałem we mszy świętej za ojczyznę.', '2015-03-07', 'Piotr Wilczyński');

