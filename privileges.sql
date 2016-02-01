# Privilèges pour `Admin`@`localhost`

GRANT ALL PRIVILEGES ON *.* TO 'Admin'@'localhost' WITH GRANT OPTION;

GRANT ALL PRIVILEGES ON `TP_SIBD`.* TO 'Admin'@'localhost' WITH GRANT OPTION;


# Privilèges pour `AdminPriv`@`localhost`

GRANT USAGE ON *.* TO 'AdminPriv'@'localhost' WITH GRANT OPTION;

GRANT USAGE ON `TP_SIBD`.* TO 'AdminPriv'@'localhost' WITH GRANT OPTION;


# Privilèges pour `Developpeur`@`localhost`

GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'Developpeur'@'localhost';

GRANT ALL PRIVILEGES ON `TP_SIBD`.* TO 'Developpeur'@'localhost';


# Privilèges pour `RespOpti`@`localhost`

GRANT SELECT, CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, CREATE VIEW, SHOW VIEW ON *.* TO 'RespOpti'@'localhost';

GRANT ALL PRIVILEGES ON `TP_SIBD`.* TO 'RespOpti'@'localhost';
