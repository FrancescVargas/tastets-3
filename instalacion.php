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
         
        
       //insertamos en tastets
        
         $sql=<<<sql
          
INSERT INTO `activitats` (`id`,`nom`, `responsable`,`dni`,`departament`,`lloc`,`descripcio`,`foto`) VALUES ('1001','Assaigs destructius de caracterització de materials','Josep A. Picas','40554565-Q','Dept.de Ciència de materials i enginyeria metal de Ciència de materials i enginyeria metal·lúrgica','AL002 –Lab. Mesures Elèctriques ','Per tal de donar a conèixer les activitats del
departament es proposa una visita a les seves
instal·lacions, on es realitzaran diferents assaigs de
caracterització de materials. Abans de cada assaig
es farà un breu resum de la funcionalitat del mateix
i descripció dels paràmetres obtinguts. Els assaigs
proposats són els següents:
• Assaig de tracció.
• Assaig d’impacte mitjançant pèndul
Charpy.
• Assaig de duresa.
• Assaig d’ultramicroduresa.
Es realitzarà un recorregut per les instal·lacions de
corrosió i es visitarà la cambra de boira salina i
s’explicaran els assajos potencio-dinàmics per a
la determinació de la resistència de materials a la corrosió. S’observaran mostres
en el microscopi electrònic d’escombrat (SEM) a les instal·lacions del CTVG. 
','vista/imatges/tastet1.jpg'),('1002','Aplicacions de l\'extensiometria elèctrica','Victòria Ismael','40553265-R','Dept. de Resistència de materials i estructures a l\'enginyeria','AL012 –Laboratori Laboratori Laboratori Mecànica i Resistència de Materials Mecànica i Resistència de Materials Mecànica i Resistència de Materialsde l’EPSEVG','• L’extensiometria elèctrica és una tècnica experimental d’anàlisi de
tensions. Donar a conèixer a l’estudiant els principis fonamentals
d’aquesta tècnica.
• Enganxar una galga a una llauna de refresc i mesurar les deformacions
que pateix quan es sotmet a sol·licitacions estàtiques i dinàmiques.
• Sotmetre provetes del laboratori a esforços de tracció, compressió i flexió i
mesurar les deformacions que pateixen.
• Aplicar forces de tracció utilitzant una relació de braç de palanca de 1 a 10
en el banc d’aplicació de càrregues.
• Realitzar i analitzar totes les possibles connexions al pont de Wheatstone. 
','vista/imatges/tastet2.jpg'),('1003','activitat3','Josep A. Picas','40554565-Q','Dept.de Ciència de materials i enginyeria metal de Ciència de materials i enginyeria metal·lúrgica','AL002 –Lab. Mesures Elèctriques ','Per tal de donar a conèixer les activitats del
departament es proposa una visita a les seves
instal·lacions, on es realitzaran diferents assaigs de
caracterització de materials. Abans de cada assaig
es farà un breu resum de la funcionalitat del mateix
i descripció dels paràmetres obtinguts. Els assaigs
proposats són els següents:
• Assaig de tracció.
• Assaig d’impacte mitjançant pèndul
Charpy.
• Assaig de duresa.
• Assaig d’ultramicroduresa.
Es realitzarà un recorregut per les instal·lacions de
corrosió i es visitarà la cambra de boira salina i
s’explicaran els assajos potencio-dinàmics per a
la determinació de la resistència de materials a la corrosió. S’observaran mostres
en el microscopi electrònic d’escombrat (SEM) a les instal·lacions del CTVG. 
','vista/imatges/tastet1.jpg');
sql;
        
          $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>Error al añadir datos en activitats</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Se han añadido $res filas en la tabla activitats</p>";
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
        
        
        
         
          
     
        ?>
    </body>
</html>