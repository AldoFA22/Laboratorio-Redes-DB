CREATE TABLE IF NOT EXISTS historial_estatus (
   id_historial int NOT NULL AUTO_INCREMENT,
   id_elemento int,
   hora_cambio datetime,
   id_estatus_old int,
   nombre_estatus_old varchar(15),
   id_estatus_new int,
   nombre_estatus_new varchar(15),
  PRIMARY KEY ( id_historial )
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS marca (
   id_marca int NOT NULL AUTO_INCREMENT,
   nombre_marca varchar(100) DEFAULT NULL,
  PRIMARY KEY ( id_marca )
) ENGINE=InnoDB;

INSERT INTO marca
VALUES (1,'N/A'),
       (2,'ALLIED TELESYN'),
       (3,'Apple'),
       (4,'CISCO'),
       (5,'CYBER BOTICS'),
       (6,'DELL'),
       (7,'DESARROLLO E IMPLEMENTACION DE PROYECTOS EDUCATIVOS. S.A C.V.'),
       (8,'ELEMENT I4'),
       (9,'GC TRONIG'),
       (10,'GENIUS'),
       (11,'HP'),
       (12,'INFINITUM'),
       (13,'KINGSTON'),
       (14,'LEGO'),
       (15,'LENOVO'),
       (16,'Lenovo IBM'),
       (17,'LINKSYS'),
       (18,'LOGITECH'),
       (19,'LONGWELL'),
       (20,'MICROSOFT'),
       (21,'MICROTEK'),
       (22,'NIKON'),
       (23,'RASPBERRY'),
       (24,'SOLIDEX'),
       (25,'SONY'),
       (26,'SPARK FUN'),
       (27,'STEREN'),
       (28,'TECH SMITH');


CREATE TABLE IF NOT EXISTS modelo (
   id_modelo int NOT NULL AUTO_INCREMENT,
   id_marca int,
   nombre_modelo varchar(35) DEFAULT NULL,
  PRIMARY KEY ( id_modelo ),
  FOREIGN KEY ( id_marca ) REFERENCES marca( id_marca ) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO modelo
VALUES (1,1,'N/A'),
       (2,20,'1414'),
       (3,10,'3003'),
       (4,5,'009-947-280'),
       (5,19,'125V'),
       (6,27,'299-866'),
       (7,11,'672652-001'),
       (8,16,'6920-AB2'),
       (9,16,'6920-AB3'),
       (10,11,'800 G1'),
       (11,11,'801 G1'),
       (12,3,'A1152'),
       (13,3,'A1243'),
       (14,3,'A1296'),
       (15,3,'A1312'),
       (16,3,'A1314'),
       (17,3,'A1418'),
       (18,2,'AT-FS705LE'),
       (19,8,'B'),
       (20,4,'Cisco 2800 Series'),
       (21,4,'Cisco 2900 Series'),
       (22,4,'Cisco WAP4410N'),
       (23,17,'Cisco WVC80N'),
       (24,4,'CP-6921-C-K9'),
       (25,25,'DCR-DV201'),
       (26,25,'DSC-F828'),
       (27,14,'EV3'),
       (28,18,'F310'),
       (29,1,'HT-F3033'),
       (30,11,'KV-1156'),
       (31,22,'L820'),
       (32,17,'Linksys PLSK400'),
       (33,17,'Linksys WAP54G'),
       (34,18,'MK200'),
       (35,23,'PI2 V2.0'),
       (36,6,'POWER EDGE T110 II'),
       (37,6,'POWER EDGE T410'),
       (38,21,'SCANMARK ER9800'),
       (39,6,'ST 2320L'),
       (40,12,'ST585'),
       (41,11,'V-201'),
       (42,26,'WIG-11888'),
       (43,4,'WS-C2950T-24'),
       (44,4,'WS-C2960-24TC-L'),
       (45,4,'WS-C2960-24TT-L'),
       (46,4,'WS-C3650-24PS');

CREATE TABLE IF NOT EXISTS caracteristica (
   id_caracteristica int NOT NULL AUTO_INCREMENT,
   nombre_caracteristica varchar(40) DEFAULT NULL,
   nombre_largo_caracteristica varchar(50) DEFAULT NULL,
   id_modelo_marca int,
   descripcion text,
  PRIMARY KEY ( id_caracteristica ),
  FOREIGN KEY ( id_modelo_marca ) REFERENCES modelo( id_modelo ) ON DELETE CASCADE
) ENGINE=InnoDB;


INSERT INTO caracteristica
VALUES (1,'Servidor DELL','Servidor DELL Power Edge T110 II',36,'Intel Xeon E3-1220 @3.10 GHz RAM: 8GB DDR3 @1600 MHz Disco Duro: 500 GB ST500NM0011'),
       (2,'Servidor DELL','Servidor DELL Power Edge T410',37,'Intel Xeon CPU X5660 @2.80 GHz RAM: 8GB DDR3 @1333 MHz Disco Duro: 500 GB ST3500514NS'),
       (3,'Modem Infinitum','Model Infinitum Thomson',40,'Modem Infinitum Thompson ST585 v.7.2.5.1 Subida: 6.98 Mbps Bajada: 887 Kbps'),
       (4,'Telefono IP','Telefono Cisco 6921',24,'Telefono Cisco 6921'),
       (5,'Switch Catalyst 2960','Cisco WS-C2960-24TC-L',44,'IOS: 15.0 SE Flash: 64 KB 24 Puertos Fast Ethernet 2 Puertos Gigabit Ethernet'),
       (6,'Switch Catalyst 2960','Cisco WS-C2960-24TT-L',45,'IOS: 12.2 SE7 Flash: 64 KB 24 Puertos Fast Ethernet 2 Puertos Gigabit Ethernet'),
       (7,'Switch Catalyst 2950','Cisco WS-C2950T-24',43,'IOS: 12.1 EA14 Flash: 32 KB 24 Puertos Fast Ethernet/IEEE 802.3 2 Puertos Gigabit Ethernet/IEEE 802.3'),
       (8,'Switch Catalyst 3650','Cisco WS-C3650-24PS',46,'IOS-XE: 03.03.03 SE Flash: 2.48 KB 28 Puertos Gigabit Ethernet'),
       (9,'Router 2800','Cisco 2800 Series',20,'IOS: 12.4 v 2 Puertos Fast Ethernet 2 Puertos Seriales 1 Modulo VPN'),
       (10,'Router 2900','Cisco 2900 Series',21,'IOS: 15.1 M4 3 Puerts Gigabit Ethernet 2 Puertos Seriales 2 Puertos USB'),
       (11,'Router 2900','Cisco 2900 Series',21,'IOS: 15.2 M6 3 Puerts Gigabit Ethernet 2 Puertos Seriales 2 Puertos USB'),
       (12,'Camara IP','Cisco Camara Inalambrica IP WVC80N',23,'Camara IP Inalambrica Banda: 2.4 GHz Resolución: 640X480'),
       (13,'Kit Adaptador PLSK 400','Linksys PLSK 400 Adaptador de Red de 4 Puertos',32,'PLE400 AV 1 Puerto PLS 400 AV 4 Puertos'),
       (14,'Access Point WAP4410N','Cisco Access Point WAP4410N',22,'Banda 2.4 GHz'),
       (15,'Access Point WAP54G','Linksys Access Point WAP54G',33,'Banda 2.4 GHz'),
       (16,'Switch de 5 Puertos','Switch de 5 Puertos AT-FS705LE',18,'5 Puertos Fast Ethernet 10 Base-T 100 Base-TX'),
       (17,'Pinzas Crimpeadoras','Pinazas Crimpeadoras',1,'Pinzas Crimpeadoras Cable Coaxial Cable UTP Cat 6'),
       (18,'Kit de Fibra Óptica','Kit de Fibra Óptica',29,'Kit de Fibra Óptica HT-F3033'),
       (19,'Cable de Consola','Cable de Consola',1,'Cable de Consola de 6 ft Conectores RJ45 Y DB9F'),
       (20,'TRI PIE','TRI PIE',1,'TRIPIE PARA CAMARA'),
       (21,'TECLADO INALAMBRICO CON MOUSE','N/A',1,'N/A'),
       (22,'TECLADO','TECLADO INALAMBRICO',16,'ALFA NUMERICO'),
       (23,'TECLADO','TECLADO',13,'ALFA NUMERICO REQUIEREMAC OS X 10.6.8, PUERTO USB1.10 2.0'),
       (24,'ROBOTS','N/A',1,'N/A'),
       (25,'RASPBERRY PI 2','RASPBERRY PI 2 MODELO B+',35,'RASPBERRY PI 2 MODELO B+ PROCESASOR QUAD-CORE ARM CORTEX-A7 A 900 MHz, 1 GB DE MEMORIA RAM, 4 PUERTOS USB, PUERTO HDMI , PUERTO ETHERNENET'),
       (26,'MOUSE','MOUSE',3,'ACCESORIO'),
       (27,'MOUSE','MOUSE INALAMBRICO',14,'ACCESORIO'),
       (28,'MOUSE','MOUSE',12,'ACCESORIO'),
       (29,'Monitor','Monitor',8,'N/A'),
       (30,'Monitor','Monitor',9,'N/A'),
       (31,'LICENCIA','LICENCIA CAMTASIA',1,'CAMTASIA STUDIO, PARA PRODUCCION DE VIDEO'),
       (32,'LEGO MINDSTORMS EV3','LEGO MINDSTORMS EV3',27,'LEGO MINDSTORMS EV3'),
       (33,'KIT DE INICIO CANAKIT RASPBERRY PI 2','KIT DE INICIO CANAKIT PARA RASPEBBRY PI 2 ULTIMATE',35,'KIT DE INICIO CANAKIT PARA RASPEBBRY PI 2 ULTIMATE'),
       (34,'ESCANER','ESCANER',38,'N/A'),
       (35,'CPU','CPU',10,'Intel Core i7-4790 @ 3.60 Ghz 233 GB 16 GB @ 1333 MHz DDR3Windows 8.1 Enterprise 64 bits Ubuntu 14.04 LTS 64 bits'),
       (36,'CPU','CPU',11,'Intel Core i7-4790 @ 3.60 Ghz 233 GB 16 GB @ 1333 MHz DDR3Windows 8.1 Enterprise 64 bits Ubuntu 14.04 LTS 64 bits'),
       (37,'COMPUTADORA','COMPUTADORA',17,'Intel Core i5 @ 2.9 GHz Macintosh HD 1 TB 8 GB @ 1600 MHz DDR3 OS X Yosemite Version 10.10.5'),
       (38,'COMPUTADORA','COMPUTADORA',17,'Intel Core i7 @ 3.4 GHz Macintosh HD 1 TB 8 GB @ 1333 MHz DDR3 OS X Yosemite Version 10.10.5 1 TB'),
       (39,'COMPUTADORA','COMPUTADORA',15,'Intel Core i7 @ 3.4 GHz Macintosh HD 1 TB 8 GB @ 1333 MHz DDR3 OS X Yosemite Version 10.10.5 1 TB'),
       (40,'CAMARA V','CAMARA V',25,'N/A'),
       (41,'CAMARA V','CAMARA V',26,'N/A'),
       (42,'CAMARA','CAMARA',31,'30X OPTICAL ZOOM WIDE FULL HD'),
       (43,'CABLE','CABLE PARA COMPUTADORA',5,'CABLE PARA COMPUTADORA'),
       (44,'Arduinos','Arduinos',1,'Arduinos'),
       (45,'4 PICO BOARD','TARJETAS PROGRAMABLES',42,'TARJETAS PROGRAMABLES'),
       (46,'4 MEMORIAS SD','MEMORIAS',1,'MEMORIAS SD 32 GB'),
       (47,'4 LOGITECH GAMEPAD','LOGITECH GAMEPAD',28,'CONTROL PARA VIDEO JUEGOS'),
       (48,'3 KINECT SENSOR','SENSOR PARA CONSOLA DE VIDEO JUEGO',2,'SENSOR PARA CONSOLA DE VIDEO JUEGO XBOX 360'),
       (49,'3 FINCH','ROBOT PROGRAMABLE',1,'ROBOT PROGRAMABLE CON CABLE USB'),
       (50,'2 WEBOTS 7','WEBOTS 7',4,'PARA PROTOTIPOS Y SIMULACION DE ROBOTS MOBILES'),
       (51,'2 TECLADOS INALAMBRICOS CON MOUSE','TECLADO INALAMBRICO CON MAUSE',34,'LOGITECH MEDIA COMBO'),
       (52,'2 TECLADOS INALAMBRICOS CON MOUSE','TECLADO INALAMBRICO',16,'ALFA NUMERICO REQUIEREMAC OS X 10.6.8, PUERTO USB1.10 2.0'),
       (53,'2 ROBOTS','ROBOTS EPUCK',1,'ROBOTS PROGRAMABLES'),
       (54,'2 MONITORES','MONITORES',39,'MONITORES'),
       (55,'2 CABLES HDMI','CABLE HDMI',6,'CABLE HDMI DE ALTA VELOCIDAD MACHO A MACHO DE 1,8 M, COMPACTIBLE CON 3D'),
       (56,'16 TECLADOS','TECLADO',13,'ALFA NUMERICO REQUIEREMAC OS X 10.6.8, PUERTO USB1.10 2.0'),
       (57,'16 TECLADOS','TECLADO',30,'ALFA NUMERICO'),
       (58,'16 MOUSE','MOUSE',12,'ACCESORIO'),
       (59,'15 MOUSE','MOUSE',7,'ACCESORIO'),
       (60,'15 MONITOR','MONITOR',41,'N/A'),
       (61,'5 RASPBERRY PI','RASPBERRY PI',19,'COMPUTADORA DE TARJETAS');

CREATE TABLE IF NOT EXISTS tipo (
   id_tipo int NOT NULL AUTO_INCREMENT,
   nombre_tipo varchar(15) DEFAULT NULL,
  PRIMARY KEY ( id_tipo )
) ENGINE=InnoDB;

INSERT INTO tipo
VALUES (1,'Equipo'),
       (2,'Material');

CREATE TABLE IF NOT EXISTS materia (
   id_materia int NOT NULL AUTO_INCREMENT,
   clave_materia varchar(30) DEFAULT NULL,
  PRIMARY KEY ( id_materia )
) ENGINE=InnoDB;

INSERT INTO materia
VALUES (1,'N/A'),
       (2,'TC1001'),
       (3,'TC1014'),
       (4,'TC1015'),
       (5,'TC1017'),
       (6,'TC1021'),
       (7,'TC2008'),
       (8,'TC2016'),
       (9,'TC2018'),
       (10,'TC2022'),
       (11,'TC2024'),
       (12,'TC2026'),
       (13,'TC2027'),
       (14,'TC2029'),
       (15,'TC2030'),
       (16,'TC2031'),
       (17,'TC3045'),
       (18,'TC3048'),
       (19,'TC3052'),
       (20,'TC3053'),
       (21,'TC3056'),
       (22,'TC3057'),
       (23,'TI1012'),
       (24,'TI3030'),
       (25,'YC0517'),
       (26,'Eventos del departamento'),
       (27,'Materias de maestria'),
       (28,'Talleres');


CREATE TABLE IF NOT EXISTS ubicacion (
   id_ubicacion int NOT NULL AUTO_INCREMENT,
   nombre_ubicacion varchar(35) DEFAULT NULL,
  PRIMARY KEY ( id_ubicacion )
) ENGINE=InnoDB;

INSERT INTO ubicacion
VALUES (1,'N/A'),
       (2,'2-113'),
       (3,'2506-J'),
       (4,'2506-K'),
       (5,'2506-O'),
       (6,'2506-R'),
       (7,'A2-203 Lab. Multimedia'),
       (8,'A2-113 Lab. Redes'),
       (9,'A2-205 Lab. Computo');


CREATE TABLE IF NOT EXISTS estatus (
   id_estatus int NOT NULL AUTO_INCREMENT,
   nombre_estatus varchar(15) DEFAULT NULL,
  PRIMARY KEY ( id_estatus )
) ENGINE=InnoDB;

INSERT INTO estatus
VALUES (1,'Disponible'),
       (2,'Apartado'),
       (3,'En reparación'),
       (4,'Retirado');

CREATE TABLE IF NOT EXISTS elemento (
   id_elemento int NOT NULL AUTO_INCREMENT,
   numero_serie varchar(20) DEFAULT NULL,
   id_caracteristica int,
   caracteristica_extra varchar(100),
   id_tipo int,
   id_materia int,
   id_ubicacion int,
  PRIMARY KEY ( id_elemento ),
  FOREIGN KEY ( id_caracteristica ) REFERENCES  caracteristica ( id_caracteristica ) ON DELETE CASCADE,
  FOREIGN KEY ( id_tipo ) REFERENCES tipo ( id_tipo ) ON DELETE CASCADE,
  FOREIGN KEY ( id_materia ) REFERENCES materia ( id_materia ) ON DELETE CASCADE,
  FOREIGN KEY ( id_ubicacion ) REFERENCES  ubicacion ( id_ubicacion ) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO elemento
VALUES (1,'FP9FBZ1',1,'N/A',1,7,8),
       (2,'4L6TBP1',2,'N/A',1,7,8),
       (3,'N/A',3,'N/A',1,9,8),
       (4,'PUC17351445',4,'MAC: 50:17:FF:77:49:32',1,7,8),
       (5,'PUC173510HC',4,'MAC: 50:17:FF:77:66:9F',1,7,8),
       (6,'FCQ175000G4',6,'MAC: 6C:99:89:18:54:80',1,7,8),
       (7,'FOC1041X4X4',5,'MAC: 00:19:E7:0C:66:00',1,7,8),
       (8,'FOC1041X4TW',5,'MAC: 00:19:AA:EE:37:00',1,7,8),
       (9,'FOC10410XAR',5,'MAC: 00:19:AA:FD:6F:00',1,7,8),
       (10,'FOC10272W5L',7,'MAC: 00:0A:B8:FC:5C:40',1,7,8),
       (11,'FOC10272QSK',7,'MAC: 00:0A:B8:F3:8B:C0',1,7,8),
       (12,'FOC10272W92',7,'MAC: 00:0A:B8:FC:5A:40',1,7,8),
       (13,'FDO18210PTK',8,'MAC: 10:05:CA:45:2C:00',1,7,8),
       (14,'FDO1821Q0ZB',8,'MAC: F4:0F:1B:D3:E2:80',1,7,8),
       (15,'FDO18210PSD',8,'MAC: F4:0F:1B:D3:A9:80',1,7,8),
       (16,'FTX1048A6KK',9,'N/A',1,7,8),
       (17,'FTX1040A1CF',9,'N/A',1,7,8),
       (18,'FTX1040A1CB',9,'N/A',1,7,8),
       (19,'FTX1040A1CH',9,'N/A',1,7,8),
       (20,'FTX1040A1C6',9,'N/A',1,7,8),
       (21,'FTX1040A1C7',9,'N/A',1,7,8),
       (22,'FTX1817ALE1',11,'N/A',1,7,8),
       (23,'FTX1646AKKD',10,'N/A',1,7,8),
       (24,'FTX1646AKKA',10,'N/A',1,7,8),
       (25,'AUY07M301297',12,'MAC: 58:6D:8F:EA:2E:FE',1,7,8),
       (26,'AUY07M301660',12,'MAC: 58:6D:8F:EA:30:69',1,7,8),
       (27,'AUY07M301605',12,'MAC: 58:6D:8F:EA:30:32',1,7,8),
       (28,'AUY07M301606',12,'MAC: 58:6D:8F:EA:30:33',1,7,8),
       (29,'AUY07M301321',12,'MAC: 58:6D:8F:EA:2F:16',1,7,8),
       (30,'11U10603200454',13,'1 Puerto MAC: 20:AA:4B:7D:DF:92X',1,7,8),
       (31,'11T10603200312',13,'4 Puertos MAC: 20:AA:4B:7D:E4:E5',1,7,8),
       (32,'11U10601203035',13,'1 Puerto MAC: 58:6D:8F:F2:4C:82',1,7,8),
       (33,'11T10601202289',13,'4 Puertos MAC: 58:6D:8F:F2:53:41',1,7,8),
       (34,'11U10601202188',13,'1 Puerto MAC: 58:6D:8F:F2:46:77',1,7,8),
       (35,'11T10601201912',13,'4 Puertos MAC: 58:6D:8F:F2:51:C8',1,7,8),
       (36,'11U10601203607',13,'1 Puerto MAC: 58:6D:8F:F2:4E:BE',1,7,8),
       (37,'11T10601202157',13,'4 Puertos MAC: 58:6D:8F:F2:52:BD',1,7,8),
       (38,'11U10601203181',13,'1 Puerto MAC: 58:6D:8F:F2:4D:14',1,7,8),
       (39,'11T10601201894',13,'4 Puertos MAC: 58:6D:8F:F2:51:B6',1,7,8),
       (40,'11U10601203602',13,'1 Puerto MAC: 58:6D:8F:F2:4E:B9',1,7,8),
       (41,'11T10601201834',13,'4 Puertos MAC: 58:6D:8F:F2:51:7A',1,7,8),
       (42,'SER1732030O',14,'MAC: 4C:00:82:E0:47:40',1,7,8),
       (43,'SER1732031B',14,'MAC: 4C:00:82:E0:47:6E',1,7,8),
       (44,'SER1732030O',15,'MAC: 4C:00:82:E0:47:40',1,7,8),
       (45,'SER1732030O',15,'MAC: 4C:00:82:E0:47:40',1,7,8),
       (46,'SER1732030O',15,'MAC: 4C:00:82:E0:47:40',1,7,8),
       (47,'L1SM3259A',16,'N/A',1,7,8),
       (48,'L1T23259A',16,'N/A',1,7,8),
       (49,'L1T13259A',16,'N/A',1,7,8),
       (50,'A00249L0501001H6 A',16,'N/A',1,7,8),
       (51,'L1L83259A',16,'N/A',1,7,8),
       (52,'L18V3259A',16,'N/A',1,7,8),
       (53,'L1T43259A',16,'N/A',1,7,8),
       (54,'A00249L050600059 A',16,'N/A',1,7,8),
       (55,'A00249L050600052 A',16,'N/A',1,7,8),
       (56,'N/A',17,'pinzas crimpeadoras',2,7,8),
       (57,'N/A',17,'pinzas crimpeadoras',2,7,8),
       (58,'N/A',17,'pinzas crimpeadoras',2,7,8),
       (59,'N/A',17,'pinzas crimpeadoras',2,7,8),
       (60,'N/A',17,'pinzas crimpeadoras',2,7,8),
       (61,'N/A',17,'pinzas crimpeadoras',2,7,8),
       (62,'N/A',17,'pinzas crimpeadoras',2,7,8),
       (63,'N/A',17,'pinzas crimpeadoras',2,7,8),
       (64,'N/A',17,'pinzas crimpeadoras',2,7,8),
       (65,'N/A',17,'pinzas crimpeadoras',2,7,8),
       (66,'N/A',18,'kit de fibra optica',2,7,8),
       (67,'N/A',18,'kit de fibra optica',2,7,8),
       (68,'N/A',19,'cable consola',2,7,8),
       (69,'N/A',19,'cable consola',2,7,8),
       (70,'N/A',19,'cable consola',2,7,8),
       (71,'N/A',19,'cable consola',2,7,8),
       (72,'N/A',19,'cable consola',2,7,8),
       (73,'N/A',19,'cable consola',2,7,8),
       (74,'N/A',19,'cable consola',2,7,8),
       (75,'N/A',19,'cable consola',2,7,8),
       (76,'N/A',20,'Solidex',2,26,5),
       (77,'N/A',21,'N/A',1,1,1),
       (78,'602-7760-A',22,'N/A',1,1,3),
       (79,'CC2507200H9DQW7A2',23,'N/A',1,1,5),
       (80,'CC2512201ZTDQW7AH',23,'N/A',1,1,5),
       (81,'CC2507200AEDQW7AJ',23,'N/A',1,1,5),
       (82,'N/A',24,'N/A',1,6,1),
       (83,'N/A',25,'RASPBERRY',1,1,2),
       (84,'N/A',25,'RASPBERRY',1,1,2),
       (85,'N/A',26,'MOUSE GENIUS',1,19,9),
       (86,'N/A',27,'MOUSE INALAMBRICO',1,1,3),
       (87,'N/A',28,'MOUSE APPLE',1,1,5),
       (88,'V1-G2666',29,'MONITOR LENOVO',1,1,1),
       (89,'V1-G6187',30,'MONITOR LENOVO',1,19,9),
       (90,'N/A',31,'TECH SMITH',2,2,7),
       (91,'N/A',31,'TECH SMITH',2,3,4),
       (92,'N/A',32,'LEGO',2,1,2),
       (93,'N/A',32,'LEGO',2,1,2),
       (94,'N/A',32,'LEGO',2,1,2),
       (95,'N/A',33,'RASPBERRY',2,1,2),
       (96,'N/A',33,'RASPBERRY',2,1,2),
       (97,'N/A',33,'RASPBERRY',2,1,2),
       (98,'N/A',33,'RASPBERRY',2,1,2),
       (99,'W4936B00480',34,'ESCANER',1,1,1),
       (100,'MXL50615ZS',35,'N/A',1,19,9),
       (101,'MXL50615YR',35,'N/A',1,19,9),
       (102,'MXL50615YW',35,'N/A',1,19,9),
       (103,'MXL5061609',35,'N/A',1,19,9),
       (104,'MXL50615ZL',35,'N/A',1,19,9),
       (105,'MXL50615Z8',35,'N/A',1,19,9),
       (106,'MXL50615ZK',35,'N/A',1,19,9),
       (107,'MXL50615ZM',35,'N/A',1,19,9),
       (108,'MXL50615ZB',35,'N/A',1,19,9),
       (109,'MXL50615ZR',35,'N/A',1,19,9),
       (110,'MXL506160S',35,'N/A',1,19,9),
       (111,'MXL50615ZH',35,'N/A',1,19,9),
       (112,'MXL50615ZG',35,'N/A',1,19,9),
       (113,'MXL50615ZF',35,'N/A',1,19,9),
       (114,'MXL50615ZC',35,'N/A',1,19,9),
       (115,'MXL50615YJ',35,'N/A',1,19,9),
       (116,'SC02NC3UHF8J3',37,'N/A',1,2,7),
       (117,'SC02NX3N4F8J3',37,'N/A',1,2,7),
       (118,'SC02NC5ALF8J3',37,'N/A',1,2,7),
       (119,'SC02NX3LEF8J3',37,'N/A',1,2,7),
       (120,'SC02NX3NCF8J3',37,'N/A',1,2,7),
       (121,'B8098AC44D5B',38,'N/A',1,2,7),
       (122,'SD25J61SKDHJW',39,'N/A',1,2,7),
       (123,'SD25J61SHDHJW',39,'N/A',1,27,6),
       (124,'SD25J61S9DHJW',39,'N/A',1,2,7),
       (125,'SD25J61S3DHJW',39,'N/A',1,2,7),
       (126,'SD25J61SCDHJW',39,'N/A',1,27,6),
       (127,'SD25J61RWDHJW',39,'N/A',1,2,5),
       (128,'SD25J61S0DHJW',39,'N/A',1,2,7),
       (129,'SD25J61SFDHJW',39,'N/A',1,2,7),
       (130,'SD25J61S5DHJW',39,'N/A',1,2,7),
       (131,'SD25J61RZDHJW',39,'N/A',1,2,5),
       (132,'SD25J61RYDHJW',39,'N/A',1,2,7),
       (133,'SD25J61S1DHJW',39,'N/A',1,2,7),
       (134,'SD25J61RUDHJW',39,'N/A',1,2,7),
       (135,'SD25J61SBDHJW',39,'N/A',1,2,3),
       (136,'SD25J61RTDHJW',39,'N/A',1,2,7),
       (137,'856345',40,'N/A',1,1,1),
       (138,'1908875',41,'N/A',1,1,1),
       (139,'30263073',42,'N/A',1,26,5),
       (140,'E55349',43,'N/A',2,1,5),
       (141,'N/A',44,'N/A',1,4,1),
       (142,'N/A',45,'N/A',1,3,4),
       (143,'N/A',46,'KINGSTON',1,3,4),
       (144,'N/A',47,'N/A',1,3,4),
       (145,'N/A',48,'N/A',1,1,4),
       (146,'N/A',49,'N/A',1,3,4),
       (147,'N/A',50,'N/A',1,3,4),
       (148,'N/A',51,'N/A',1,3,4),
       (149,'DG745110D9EDRO5AW',52,'N/A',1,27,6),
       (150,'N/A',53,'N/A',1,3,4),
       (151,'N/A',54,'N/A',1,3,4),
       (152,'N/A',55,'N/A',2,3,4),
       (153,'CC2426',56,'N/A',1,2,7),
       (154,'N/A',57,'N/A',1,19,9),
       (155,'8B1300',58,'N/A',1,2,7),
       (156,'N/A',59,'N/A',1,19,9),
       (157,'N/A',60,'N/A',1,19,9),
       (158,'N/A',61,'N/A',1,3,4);


CREATE TABLE IF NOT EXISTS elemento_estatus (
   id_elemento_estatus int NOT NULL AUTO_INCREMENT,
   id_elemento int,
   id_estatus int,
   PRIMARY KEY ( id_elemento_estatus ),
  FOREIGN KEY ( id_elemento ) REFERENCES elemento ( id_elemento ) ON DELETE CASCADE,
  FOREIGN KEY ( id_estatus ) REFERENCES estatus ( id_estatus ) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO elemento_estatus
VALUES (1,1,2),
       (2,2,2),
       (3,3,2),
       (4,4,2),
       (5,5,2),
       (6,6,2),
       (7,7,2),
       (8,8,2),
       (9,9,2),
       (10,10,1),
       (11,11,1),
       (12,12,1),
       (13,13,1),
       (14,14,1),
       (15,15,1),
       (16,16,1),
       (17,17,1),
       (18,18,1),
       (19,19,1),
       (20,20,1),
       (21,21,1),
       (22,22,1),
       (23,23,1),
       (24,24,1),
       (25,25,1),
       (26,26,1),
       (27,27,1),
       (28,28,1),
       (29,29,1),
       (30,30,1),
       (31,31,1),
       (32,32,1),
       (33,33,1),
       (34,34,1),
       (35,35,1),
       (36,36,1),
       (37,37,1),
       (38,38,1),
       (39,39,1),
       (40,40,1),
       (41,41,1),
       (42,42,1),
       (43,43,1),
       (44,44,1),
       (45,45,1),
       (46,46,1),
       (47,47,1),
       (48,48,1),
       (49,49,1),
       (50,50,1),
       (51,51,1),
       (52,52,1),
       (53,53,1),
       (54,54,1),
       (55,55,1),
       (56,56,1),
       (57,57,1),
       (58,58,1),
       (59,59,1),
       (60,60,1),
       (61,61,1),
       (62,62,1),
       (63,63,1),
       (64,64,1),
       (65,65,1),
       (66,66,1),
       (67,67,1),
       (68,68,1),
       (69,69,1),
       (70,70,1),
       (71,71,1),
       (72,72,1),
       (73,73,1),
       (74,74,1),
       (75,75,1),
       (76,76,1),
       (77,77,1),
       (78,78,1),
       (79,79,1),
       (80,80,1),
       (81,81,1),
       (82,82,1),
       (83,83,1),
       (84,84,1),
       (85,85,1),
       (86,86,1),
       (87,87,1),
       (88,88,1),
       (89,89,1),
       (90,90,1),
       (91,91,1),
       (92,92,1),
       (93,93,1),
       (94,94,1),
       (95,95,1),
       (96,96,1),
       (97,97,1),
       (98,98,1),
       (99,99,1),
       (100,100,3),
       (101,101,3),
       (102,102,3),
       (103,103,3),
       (104,104,3),
       (105,105,3),
       (106,106,3),
       (107,107,3),
       (108,108,3),
       (109,109,3),
       (110,110,3),
       (111,111,3),
       (112,112,3),
       (113,113,3),
       (114,114,3),
       (115,115,3),
       (116,116,3),
       (117,117,3),
       (118,118,3),
       (119,119,3),
       (120,120,3),
       (121,121,3),
       (122,122,3),
       (123,123,3),
       (124,124,3),
       (125,125,3),
       (126,126,3),
       (127,127,3),
       (128,128,3),
       (129,129,3),
       (130,130,3),
       (131,131,4),
       (132,132,4),
       (133,133,4),
       (134,134,4),
       (135,135,4),
       (136,136,4),
       (137,137,4),
       (138,138,4),
       (139,139,4),
       (140,140,4),
       (141,141,4),
       (142,142,4),
       (143,143,4),
       (144,144,4),
       (145,145,4),
       (146,146,4),
       (147,147,4),
       (148,148,4),
       (149,149,4),
       (150,150,4),
       (151,151,4),
       (152,152,4),
       (153,153,4),
       (154,154,4),
       (155,155,4),
       (156,156,4),
       (157,157,4),
       (158,158,4);

CREATE VIEW elemento_resumen AS SELECT elemento.id_elemento ,nombre_caracteristica, nombre_largo_caracteristica, descripcion, nombre_marca, nombre_ubicacion, nombre_estatus FROM elemento_estatus 
  INNER JOIN elemento ON elemento_estatus.id_elemento = elemento.id_elemento
  INNER JOIN estatus ON estatus.id_estatus = elemento_estatus.id_estatus 
  INNER JOIN ubicacion ON elemento.id_ubicacion = ubicacion.id_ubicacion 
  INNER JOIN caracteristica ON elemento.id_caracteristica = caracteristica.id_caracteristica 
  INNER JOIN modelo ON caracteristica.id_modelo_marca = modelo.id_modelo
  INNER JOIN marca ON modelo.id_marca = marca.id_marca;

DELIMITER $$
CREATE PROCEDURE GetElementoById(IN id_el INT)
BEGIN
SELECT elemento.*, estatus.nombre_estatus, tipo.nombre_tipo, marca.nombre_marca, modelo.nombre_modelo, caracteristica.*, estatus.nombre_estatus, ubicacion.nombre_ubicacion, materia.clave_materia 
FROM elemento_estatus, elemento, caracteristica, estatus, tipo, modelo, marca, ubicacion, materia 
WHERE elemento.id_elemento = id_el 
AND caracteristica.id_modelo_marca = modelo.id_modelo 
AND elemento.id_materia = materia.id_materia 
AND elemento.id_ubicacion = ubicacion.id_ubicacion 
AND modelo.id_marca = marca.id_marca 
AND elemento.id_tipo = tipo.id_tipo 
AND elemento_estatus.id_estatus = estatus.id_estatus 
AND elemento_estatus.id_elemento = elemento.id_elemento 
AND elemento.id_caracteristica = caracteristica.id_caracteristica;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE UpdateElementoById(
IN numero_serie VARCHAR(20), 
IN id_caracteristica INT, 
IN caracteristica_extra VARCHAR(100), 
IN id_tipo INT, 
IN id_materia INT, 
IN id_ubicacion INT,
IN id_el INT)
BEGIN
UPDATE `elemento` SET numero_serie = numero_serie, id_caracteristica= id_caracteristica,caracteristica_extra= caracteristica_extra,id_tipo= id_tipo, id_materia=id_materia, id_ubicacion= id_ubicacion WHERE id_elemento = id_el; 
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE DeleteElementoById(IN id INT)
BEGIN
DELETE FROM elemento WHERE id_elemento = id;
END$$
DELIMITER ;

DELIMITER $$ 
DROP TRIGGER IF EXISTS before_elemento_estatus_update;
CREATE TRIGGER before_elemento_estatus_update 
BEFORE UPDATE 
ON elemento_estatus FOR EACH ROW BEGIN 
IF NEW.id_estatus <> OLD.id_estatus THEN 
IF (OLD.id_estatus = 1 AND NEW.id_estatus = 2) THEN 
INSERT INTO historial_estatus SET id_elemento = OLD.id_elemento, hora_cambio = NOW(), id_estatus_old = OLD.id_estatus, nombre_estatus_old = 'Disponible', id_estatus_new = NEW.id_estatus, nombre_estatus_new = 'Apartado'; 
END IF; 
IF (OLD.id_estatus = 1 AND NEW.id_estatus = 3) THEN 
INSERT INTO historial_estatus SET id_elemento = OLD.id_elemento, hora_cambio = NOW(), id_estatus_old = OLD.id_estatus, nombre_estatus_old = 'Disponible', id_estatus_new = NEW.id_estatus, nombre_estatus_new = 'En reparación'; 
END IF; 
IF (OLD.id_estatus = 1 AND NEW.id_estatus = 4) THEN 
INSERT INTO historial_estatus SET id_elemento = OLD.id_elemento, hora_cambio = NOW(), id_estatus_old = OLD.id_estatus, nombre_estatus_old = 'Disponible', id_estatus_new = NEW.id_estatus, nombre_estatus_new = 'Retirado'; 
END IF; 
IF (OLD.id_estatus = 2 AND NEW.id_estatus = 1) THEN 
INSERT INTO historial_estatus SET id_elemento = OLD.id_elemento, hora_cambio = NOW(), id_estatus_old = OLD.id_estatus, nombre_estatus_old = 'Apartado', id_estatus_new = NEW.id_estatus, nombre_estatus_new = 'Disponible'; 
END IF; 
IF (OLD.id_estatus = 2 AND NEW.id_estatus = 3) THEN 
INSERT INTO historial_estatus SET id_elemento = OLD.id_elemento, hora_cambio = NOW(), id_estatus_old = OLD.id_estatus, nombre_estatus_old = 'Apartado', id_estatus_new = NEW.id_estatus, nombre_estatus_new = 'En reparación'; 
END IF; 
IF (OLD.id_estatus = 2 AND NEW.id_estatus = 4) THEN 
INSERT INTO historial_estatus SET id_elemento = OLD.id_elemento, hora_cambio = NOW(), id_estatus_old = OLD.id_estatus, nombre_estatus_old = 'Apartado', id_estatus_new = NEW.id_estatus, nombre_estatus_new = 'Retirado'; 
END IF; 
IF (OLD.id_estatus = 3 AND NEW.id_estatus = 1) THEN 
INSERT INTO historial_estatus SET id_elemento = OLD.id_elemento, hora_cambio = NOW(), id_estatus_old = OLD.id_estatus, nombre_estatus_old = 'En reparación', id_estatus_new = NEW.id_estatus, nombre_estatus_new = 'Disponible'; 
END IF; 
IF (OLD.id_estatus = 3 AND NEW.id_estatus = 2) THEN 
INSERT INTO historial_estatus SET id_elemento = OLD.id_elemento, hora_cambio = NOW(), id_estatus_old = OLD.id_estatus, nombre_estatus_old = 'En reparación', id_estatus_new = NEW.id_estatus, nombre_estatus_new = 'Apartado'; 
END IF; 
IF (OLD.id_estatus = 3 AND NEW.id_estatus = 4) THEN 
INSERT INTO historial_estatus SET id_elemento = OLD.id_elemento, hora_cambio = NOW(), id_estatus_old = OLD.id_estatus, nombre_estatus_old = 'En reparación', id_estatus_new = NEW.id_estatus, nombre_estatus_new = 'Retirado'; 
END IF; 
IF (OLD.id_estatus = 4 AND NEW.id_estatus = 1) THEN 
INSERT INTO historial_estatus SET id_elemento = OLD.id_elemento, hora_cambio = NOW(), id_estatus_old = OLD.id_estatus, nombre_estatus_old = 'Retirado', id_estatus_new = NEW.id_estatus, nombre_estatus_new = 'Disponible'; 
END IF; 
IF (OLD.id_estatus = 4 AND NEW.id_estatus = 2) THEN 
INSERT INTO historial_estatus SET id_elemento = OLD.id_elemento, hora_cambio = NOW(), id_estatus_old = OLD.id_estatus, nombre_estatus_old = 'Retirado', id_estatus_new = NEW.id_estatus, nombre_estatus_new = 'Apartado'; 
END IF; 
IF (OLD.id_estatus = 4 AND NEW.id_estatus = 3) THEN 
INSERT INTO historial_estatus SET id_elemento = OLD.id_elemento, hora_cambio = NOW(), id_estatus_old = OLD.id_estatus, nombre_estatus_old = 'Retirado', id_estatus_new = NEW.id_estatus, nombre_estatus_new = 'En reparación'; 
END IF; 
END IF;
END$$
DELIMITER ;