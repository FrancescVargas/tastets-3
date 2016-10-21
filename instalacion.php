<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>crear bd Contactos</title>
        <link href="estilos.css" rel="stylesheet">
       
    </head>
    <body>
        <h1>INSTALACION</h1>
        
        <?php
        
          try
            {
                $conexion = new PDO('mysql:host=localhost', "root");
            }
          catch(PDOException $e)
            {
                echo "Error:".$e->getMessage(); 
                die();
            }
        
        // borramos la base de datos antes que nada para no tener que borrarla en myadmin
        
        
          $sql="drop database if exists activitats;";
          $res=$conexion->exec($sql);
          
        
        // creamos la base de datos cinemania
        
          $sql="create database activitats;";
          $res=$conexion->exec($sql); //exec nos devuelve el número de filas afectadas o "false" (o "0") si no ha podido crear la BD
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la base de datos</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Base de Datos creada</p>";
              }
          
          // nos conectamos a la base de datos que hemos creado
        
          $sql="use activitats;";
        
          $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la base de datos</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Conectados a 'activitats'</p>";
              }
        
        //creamos tabla dispany
        
          $sql="create table dispany(
	id int primary key auto_increment,
    disp varchar(30) not null unique)";
    

       $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la tabla dispany</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Tabla dispany creada!!!</p>";
              }
         
        
        //insertamos en dispany
        
         $sql="INSERT INTO `dispany` (`id`, `disp`) values ('1','Intersemestral (Gener-Febrer)'),('2','Setmanes d’exàmens parcials'),('3','Els dies de JPO'),('4','Durant tot l&#39;any'),('5','Altres')";

        
          $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>Error al añadir datos en dispany</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Se han añadido $res filas en la tabla dispany</p>";
              } 
           
        
        
        
        
        
         //creamos tabla tastets
        
          $sql=<<<sql
create table activitats(
	id int primary key not null unique,
    nom varchar(60) not null unique,
    responsable varchar(40),
    dni varchar(10),
    departament varchar(40),
    lloc varchar(40),
    descripcio text,
    foto varchar(140),
    int_comentari text,
    int_maxim_alu int,
    int_nivell varchar(20),
    int_dispany int,
    int_max_tallers_any int,
    int_sugg text,
    int_duracio_activitat int,
    int_duracio_preparacio int,
    int_personal_implicat int,
    int_borrat varchar(5) default "No",
    foreign key (int_dispany) references dispany(id) ON DELETE SET NULL ON UPDATE CASCADE
	
	
);
sql;
       $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la tabla activitats</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Tabla activitats creada!!!</p>";
              }
         
        

           
        
        // creamos tabla solicituts
        
           $sql=<<<sql
create table solicituts(
	id int primary key auto_increment,
    activitat_id int,
    centre varchar(60),
    nom_i_cognoms varchar(40),  
    estuaprox int,
    email varchar(60),
    telefon varchar(20),
    comentari text,
    realitzada boolean default false,
    foreign key (activitat_id) references activitats(id) ON DELETE SET NULL ON UPDATE CASCADE
);
sql;
        
          $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la tabla solicituts</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Tabla solicituts creada!!!</p>";
              }
        
        
     
     // creamos tabla tastets_fets
        
           $sql=<<<sql
create table activitats_fetes(
	id int primary key auto_increment,
    activitat_id int,
    solicitut_id int unique,
    data date,
    anyaca int,
    professor varchar(20),
    numestu int,
    comentari text,
    foreign key (activitat_id) references activitats(id) ON UPDATE CASCADE,
    foreign key (solicitut_id) references solicituts(id) ON UPDATE CASCADE
);
sql;
        
          $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la tabla activitats_fetes</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Tabla activitats_fetes creada!!!</p>";
              }
      
        
        
       // creamos tabla estu_activitats
        
           $sql=<<<sql
create table estu_activitats(
	id int primary key auto_increment,
    activitats_fetes_id int,
    nom_estu varchar(40),
    dni_estu varchar(20),
    mail_estu varchar(60),
    foreign key (activitats_fetes_id) references activitats_fetes(id) ON UPDATE CASCADE
);
sql;
        
          $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la tabla estu_activitats</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Tabla estu_activitats creada!!!</p>";
              }
        
        
        
 // ============================= PROFESSORS PERSONAL ======
        
        /*
Navicat MySQL Data Transfer

Source Server         : sextam
Source Server Version : 50173
Source Host           : sextam.epsevg.upc.es:3306
Source Database       : epsevg

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-10-19 13:23:21
*/




           
$sql="CREATE TABLE `340_personal_epsevg` (
  `cip` char(7) NOT NULL,
  `telf1` char(9) NOT NULL,
  `telf2` int(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `incid` char(2) NOT NULL,
  `numero_expedient` int(4) NOT NULL,
  `unitat_estructural` varchar(3) NOT NULL,
  `categoria` int(2) NOT NULL,
  `tipus_associat` int(1) NOT NULL,
  `dedicacio` varchar(7) NOT NULL,
  `titulacio` int(2) NOT NULL,
  `departament` char(6) NOT NULL,
  `tasca` varchar(50) NOT NULL,
  `despatx` varchar(4) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `perfil` char(3) NOT NULL,
  PRIMARY KEY (`dni`,`perfil`));";

        
$res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la tabla 340_personal_epsevg</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Tabla 340_personal_epsevg creada!!!</p>";
              }

       
 $sql="INSERT INTO `340_personal_epsevg` VALUES ('0104557', '0', '0', 'pol.martin.llado@upc.edu', 'A', '0', '7XX', '28', '0', 'TC8', '0', '709', '', '', '39924081', 'EXT');
INSERT INTO `340_personal_epsevg` VALUES ('2670937', '938967265', '0', 'wilman.alonso.pineda@upc.edu', 'A', '0', '7XX', '28', '0', 'TC8', '1', '710', 'Doctoratn SARTI', 'NEAP', 'Y4486492', 'EXT');
INSERT INTO `340_personal_epsevg` VALUES ('0104146', '938967725', '0', 'giuseppe.gugliotta@upc.edu', 'A', '843', '7XX', '4', '0', 'TP4', '1', '737', '', '176', 'X5227440', 'PDI');
INSERT INTO `340_personal_epsevg` VALUES ('0010810', '67795', '0', 'amelia.napoles@upc.edu', 'A', '844', '', '2', '0', '', '1', '712', '', 'D131', '47.927.15', 'PDI');
INSERT INTO `340_personal_epsevg` VALUES ('', '67721', '0', 'marcos.gomila@upc.edu', 'A', '846', '709', '3', '0', 'TP', '13', '709', '', '127', '43066525', 'PDI');
INSERT INTO `340_personal_epsevg` VALUES ('', '67785', '0', 'oriol.priu@upc.edu', 'A', '850', '7XX', '3', '0', '4', '1', '732', '', '157', '46131593', 'PDI');
INSERT INTO `340_personal_epsevg` VALUES ('', '67761', '0', 'GERARD.SANZ@UPC.EDU', 'A', '847', '', '3', '0', 'TP', '6', '717', '', '142', '47711600', 'PDI');
INSERT INTO `340_personal_epsevg` VALUES ('', '', '0', 'marta.montoliu@upc.edu', 'A', '848', '7XX', '3', '0', 'TP6', '6', '737', '', '176', '52218379', 'PDI');
INSERT INTO `340_personal_epsevg` VALUES ('', '', '0', '	maria.rosa.gatell@upc.edu', 'A', '849', '7XX', '3', '0', 'TP', '6', '702', '', '', '52214703', 'PDI');
INSERT INTO `340_personal_epsevg` VALUES ('0002084', '67281', '0', 'agustin@ac.upc.edu', 'A', '845', '', '7', '0', 'TC', '0', '701', '', '', '35017494', 'PDI');";
 
        
 $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>Error al añadir datos en 340_personal_epsevg</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Se han añadido $res filas en la tabla 340_personal_epsevg</p>";
              } 
        
        
        
// =========  PERSONAL PROFESSORS  ======================
        
        
$sql="CREATE TABLE `340_personal` (
  `nom` varchar(30) NOT NULL,
  `cognoms` varchar(50) NOT NULL,
  `sexe` char(1) NOT NULL,
  `domicili` varchar(50) NOT NULL,
  `cp` char(5) NOT NULL,
  `poblacio` varchar(35) NOT NULL,
  `telefon` int(9) NOT NULL,
  `telf_movil` int(9) NOT NULL,
  `data_naixement` date NOT NULL,
  `dni` varchar(9) NOT NULL,
  `dni_lletra` char(1) NOT NULL,
  PRIMARY KEY (`dni`)
);";

        
$res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la tabla 340_personal</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Tabla 340_personal creada!!!</p>";
              }

       
 $sql="INSERT INTO `340_personal` VALUES ('Pol', 'Martín Lladó', 'H', 'Partida el Pous, s/n.', '43450', 'La Riba', '977876245', '609715992', '1993-08-31', '39924081', 'Z');
INSERT INTO `340_personal` VALUES ('Wilman Alonso', 'Pineda Muñoz', 'H', 'Dr. Fleming, 9', '08800', 'Vilanova i la Geltrú', '0', '685250555', '1975-07-31', 'Y4486492', 'B');
INSERT INTO `340_personal` VALUES ('Giuseppe', 'Gugliotta', 'H', 'Rabla Castell, 85, àtic-1', '08800', 'Vilanova i la Geltrú', '0', '647536722', '1975-09-02', 'X5227440', 'T');
INSERT INTO `340_personal` VALUES ('Amelia', 'Napoles Alberro', 'D', 'Juan de la Cierva, 32, entlo. 1ª 08860 Castelldefe', '', '', '932776597', '606243694', '1963-01-05', '47.927.15', 'Y');
INSERT INTO `340_personal` VALUES ('Agustin', 'Fernandez Jimenez', 'H', '', '', '', '0', '0', '0000-00-00', '35017494', 'V');
INSERT INTO `340_personal` VALUES ('MARCOS', 'GOMILA GONZALEZ', 'H', 'AIGUA 212, 1 1 ', '', '08800 VILANOVA I LA GELTRU', '657371103', '0', '1972-02-23', '43066525', 'Z');
INSERT INTO `340_personal` VALUES ('MARTA', 'MONTOLIU ALBET', 'D', 'RBLA. EXPOSICIÓ, 51, 2 4 ', '08800', 'VILANOVA I LA GELTRU', '938144753', '618862146', '1969-04-28', '52218379', 'F');
INSERT INTO `340_personal` VALUES ('GERARD', 'SANZ COLLADO', 'H', 'RONDA OTERO PEDRAYO 42 ESC C B1', '08860', 'CASTELLDEFELS', '0', '653937222', '1986-03-26', '47711600', 'D');
INSERT INTO `340_personal` VALUES ('ROSA', 'GATELL FERNANDEZ', 'D', 'JOAN LLAVERIAS 21, 2 2', '08800', 'VILANOVA I LA GELTRU', '0', '646680120', '1968-04-11', '52214703', 'B');
INSERT INTO `340_personal` VALUES ('ORIOL', 'PRIU TOUS', 'H', 'AV. CAN CANYAMERES, 16, PB, 4', '08174', 'SANT CUGAT DEL VALLÈS', '0', '678557181', '1976-11-03', '46131593', 'X');";
 
        
 $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>Error al añadir datos en 340_personal</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Se han añadido $res filas en la tabla 340_personal</p>";
              } 
  
        
// creamos tabla participants_activitats
        
           $sql=<<<sql
create table participants_activitats(
	id int primary key auto_increment,
    activitats_id int,
    nom_participant varchar(40),
    dni_participant varchar(20),
    departament_participant int,
    foreign key (activitats_id) references activitats(id) ON UPDATE CASCADE
);
sql;
        
          $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la tabla participants_activitats</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Tabla participants_activitats creada!!!</p>";
              }
  
        
// =========  DEPARTAMENTS  ======================
        
        
$sql="CREATE TABLE `340_departaments_upc` (
  `coddep` char(6) DEFAULT NULL,
  `nomdep` char(80) DEFAULT NULL,
  `capdep` char(60) DEFAULT NULL,
  `emaildirector` varchar(100) DEFAULT NULL,
  `adrecapostal` varchar(50) DEFAULT NULL,
  `codidep` varchar(4) DEFAULT NULL,
  `telefondep` varchar(12) DEFAULT NULL,
  `administradora` varchar(50) DEFAULT NULL,
  `wwwseccio` varchar(100) DEFAULT NULL,
  `wwwdep` varchar(100) DEFAULT NULL,
  `id` int(10) NOT NULL,
  `hores_cont` decimal(7,2) DEFAULT NULL,
  `sigdep` char(10) DEFAULT NULL,
  `cred_cont` decimal(7,2) DEFAULT NULL,
  `tipologia` varchar(1) NOT NULL
);";

        
$res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la tabla 340_departaments_upc</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Tabla 340_departaments_upc creada!!!</p>";
              }

       
 $sql="INSERT INTO `340_departaments_upc` VALUES ('743', 'MATEMATICA APLICADA IV', 'Josep Fàbrega Canudas', 'matjfc@mat@upc.edu', null, '743', '93,401,58,89', 'Mónica Garizuain Zugasti', '', 'http://www.ma4.upc.edu', '426', '168.00', '743-MAIV', '504.00', '');
INSERT INTO `340_departaments_upc` VALUES ('701', 'ARQUITECTURA DE COMPUTADORS', 'Jordi Domingo Pascual', 'director@ac.upc.edu', null, '701', '93,401,56,56', 'Ma Dolores Sánchez Lafarga', null, 'http://www.ac.upc.es ', '427', '40.00', '701-AC', '120.00', 'D');
INSERT INTO `340_departaments_upc` VALUES ('702', 'CIENCIA DELS MATERIALS I ENGINYERIA METAL.LURGICA', 'Marc J. Anglada Gomila', 'marc.j.anglada@upc.edu', null, '702', '93,739,86,85', 'Ferran Raga Serra', null, 'http://www.cmem.upc.edu', '428', '76.00', '702-CMEM', '228.00', 'D');
INSERT INTO `340_departaments_upc` VALUES ('707', 'ENGINYERIA, SISTEMES, AUTOMÀTICA I INFORMÀTICA INDUSTRIAL', 'Alberto Sanfeliu Cortés', 'director.esaii@upc.edu', null, '707', '93,401,69,85', 'Ma Jesús Compains Borobia', null, 'http://webesaii.upc.es', '429', '29.00', '707-ESAII', '87.00', 'D');
INSERT INTO `340_departaments_upc` VALUES ('709', 'ENGINYERIA ELECTRICA', 'Oriol Boix Aragonés', 'dirdee@ee.upc.edu', null, '709', '93,401,72,21', 'Cristina Torné Ubeda', 'http://www.epsevg.upc.edu/dee/', 'http://www.dee.upc.es', '430', '96.00', '709-EE', '288.00', 'D');
INSERT INTO `340_departaments_upc` VALUES ('710', 'ENGINYERIA ELECTRONICA', 'Javier Rosell Ferrer', 'dirdee@eel.upc.edu', null, '710', '93,401,67,23', 'Jaume Fusté Pratdesaba', 'http://www.eel.upc.edu/', 'http://www.eel.upc.edu', '431', '224.00', '710-EEL', '672.00', 'D');
INSERT INTO `340_departaments_upc` VALUES ('712', 'ENGINYERIA MECANICA', 'Salvador Cardona Foix', 'salvador.cardona@upc.edu', null, '712', '93,401,65,76', 'Isabel Segalés Miravent', null, 'http://www.em.upc.edu', '432', '39.00', '712-EM', '117.00', 'D');
INSERT INTO `340_departaments_upc` VALUES ('713', 'ENGINYERIA QUIMICA', 'Joan de Pablo Ribas', 'joan.de.pablo@upc.edu', null, '713', '93,739,81,79', 'Elena Galindo Gil', null, 'http://www.eq.upc.edu', '433', '100.00', '713-EQ', '300.00', 'D');
INSERT INTO `340_departaments_upc` VALUES ('717', 'EXPRESSIO GRAFICA A L\'ENGINYERIA', 'Francisco Hernández Abad', 'fhernandez@mf.upc.edu', null, '717', '93,401,17,91', 'Isabel Vilalata Ortiz', null, 'http://www.ege.upc.edu', '434', '99.00', '717-EGE', '297.00', 'D');
INSERT INTO `340_departaments_upc` VALUES ('721', 'FISICA I ENGINYERIA NUCLEAR', 'J. Lluís Tamarit i Mur', 'jose.luis.tamarit@upc.edu', null, '721', '93,401,59,89', 'Ana Calle González', '', 'http://dfen.upc.edu', '435', '100.00', '721-FEN', '300.00', '');
INSERT INTO `340_departaments_upc` VALUES ('723', 'CIÈNCIES DE LA COMPUTACIÓ', 'José Díaz Cort', 'diaz@lsi.upc.edu', null, '723', '93,401,01,10', 'Ana Ibáñez Julia', '', 'http://www.lsi.upc.es', '436', '122.33', '723-LSI', '367.00', 'D');
INSERT INTO `340_departaments_upc` VALUES ('744', 'ENGINYERIA TELEMATICA', 'Miquel Soriano Ibáñez', 'soriano@entel.upc.edu', null, '744', '93,401,60,11', null, null, 'http://www.entel.upc.edu', '437', '32.00', '744-ENTEL', '96.00', 'D');
INSERT INTO `340_departaments_upc` VALUES ('729', 'MECANICA DE FLUIDS', 'Enric Trillas Gay', 'trillas@mf.upc.edu', null, '729', '93,401,67,01', null, null, 'http://www.mf.upc.edu', '438', '32.00', '729-MF', '96.00', 'D');
INSERT INTO `340_departaments_upc` VALUES ('732', 'ORGANITZACIO D\'EMPRESES', 'Lluís Cuatrecasas Arbós', 'director.oe@upc.edu', null, '732', '93,401,16,94', 'Ana Belén Cortin', null, 'http://www.doe.upc.edu', '439', '36.00', '732-OE', '108.00', 'D');
INSERT INTO `340_departaments_upc` VALUES ('736', 'PROJECTES A L\'ENGINYERIA', 'Josep Mª Domènech Mas', 'josep.m.domenech@upc.edu', null, '736', '93,401,65,33', null, null, 'http://senna.upc.es', '440', '16.00', '736-PE', '48.00', '');
INSERT INTO `340_departaments_upc` VALUES ('737', 'RESISTENCIA DE MATERIALS I ESTRUCTURES A L\'ENGINYERIA', 'Antonio Viedma Martínez', 'antoni.viedma@upc.edu', null, '737', '93,401,65,57', 'Felicidad Leiva Hevia', null, 'http://www.rmee.upc.edu', '441', '26.00', '737-RMEE', '78.00', 'D');
INSERT INTO `340_departaments_upc` VALUES ('739', 'TEORIA DEL SENYAL I COMUNICACIONS', 'Antoni Broquetas Ibars', 'director@tsc.upc.edu', null, '739', '93,401,69,70', 'Àngela Noguera Navarro', null, 'http://www-tsc.upc.es', '442', '88.00', '739-TSC', '264.00', 'D');
INSERT INTO `340_departaments_upc` VALUES ('CTVG', 'Centre tecnològic de Vilanova i la Geltrú', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('NGA', 'Negociat de gestió acadèmica', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('SMAN', 'Servei de manteniment', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('NGE', 'Negociat de gestió econòmica', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('STIC', 'Serveis a les tecnologies de la informació i les comunicacio', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('BIB', 'Biblioteca', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('CON', 'Consergeria', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('NAD', 'Negociat d\'administració i direcció', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('SIO', 'Serveis d\'informació i organització', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('STL', 'Serveis tècnics de laboratori', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('UNI', 'Univers', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('ARE', 'Àrea de relacions externes', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('CA', 'Càtedra d\'accessibilitat', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('SAT', 'Servei d\'atenció tècnica', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('PDI', 'Personal docent i d\'investigació', null, null, null, null, null, null, null, null, '0', null, null, null, 'G');
INSERT INTO `340_departaments_upc` VALUES ('PAS', 'Personal d\'administració i serveis', null, null, null, null, null, null, null, null, '0', null, null, null, 'G');
INSERT INTO `340_departaments_upc` VALUES ('ADM', 'Administrador', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('340', 'Professorat assignat al 340', null, null, null, null, null, null, null, null, '0', null, null, null, 'S');
INSERT INTO `340_departaments_upc` VALUES ('USDQ', 'Unidad de Suport a la Docència i Qualitat', null, null, null, null, null, null, null, null, '0', null, null, null, '');
INSERT INTO `340_departaments_upc` VALUES ('USR', 'Unitat de Suport a la Recerca', null, null, null, null, null, null, null, null, '0', null, null, null, '');
INSERT INTO `340_departaments_upc` VALUES ('URES', 'Unitat de Recursos i Serveis', null, null, null, null, null, null, null, null, '0', null, null, null, '');
INSERT INTO `340_departaments_upc` VALUES ('ST', 'Serveis Tècnics', null, null, null, null, null, null, null, null, '0', null, null, null, '');
INSERT INTO `340_departaments_upc` VALUES ('PROMO', 'Promoció', null, null, null, null, null, null, null, null, '0', null, null, null, '');
INSERT INTO `340_departaments_upc` VALUES ('ADMDIR', 'Unitat d’Administració i Direcció', null, null, null, null, null, null, null, null, '0', null, null, null, '');
INSERT INTO `340_departaments_upc` VALUES ('CATAC', 'Càtedra d’Accessibilitat', null, null, null, null, null, null, null, null, '0', null, null, null, '');
INSERT INTO `340_departaments_upc` VALUES ('749', 'DEPARTAMENT DE MATEMÀTIQUES', 'Josep Fàbrega Canudas', null, null, null, null, null, null, 'http://www.mat.upc.edu', '0', null, null, null, 'D');
INSERT INTO `340_departaments_upc` VALUES ('748', 'DEPARTAMENT DE FÍSICA', 'J. Lluís Tamarit i Mur', null, null, null, null, null, null, 'http://dfen.upc.edu', '0', null, null, null, 'D');
INSERT INTO `340_departaments_upc` VALUES ('756', 'DEPARTAMENT DE TEORIA I HISTÒRIA DE L\'ARQUITECTURA I TÈCNIQUES DE COMUNCIACIÓ', null, null, null, null, null, null, null, 'https://thatc.upc.edu/ca', '0', null, null, null, 'D');";
 
        
 $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>Error al añadir datos en 340_departaments_upc</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Se han añadido $res filas en la tabla 340_departaments_upc</p>";
              } 
          
        
     
        ?>
    </body>
</html>

