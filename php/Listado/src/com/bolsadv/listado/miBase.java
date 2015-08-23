package com.bolsadv.listado;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteDatabase.CursorFactory;
import android.database.sqlite.SQLiteOpenHelper;

public class miBase extends SQLiteOpenHelper {

	public miBase(Context context, String name, CursorFactory factory,
			int version) {
		super(context, name, factory, version);
		// TODO Auto-generated constructor stub
	}

	@Override
	public void onCreate(SQLiteDatabase db) {
		// TODO Auto-generated method stub
	    String query1 = "CREATE TABLE USUARIO (id INTEGER, usuario TEXT,apellido TEXT,nombre TEXT, clave TEXT, rol TEXT);";
	    String query2 = "CREATE TABLE MATERIA (id TEXT, materia TEXT,cuatrimestre INTEGER);";
	    String query3 = "CREATE TABLE PROFESOR_MATERIA (materia_id TEXT,usuario_id INTEGER);";
	    String query4 = "CREATE TABLE NOTAS (usuario_id INTEGER,materia_id TEXT,nota_1 TEXT,nota_2 TEXT,nota_3 TEXT,nota_4 TEXT);";
	    String query5 = "CREATE TABLE CARRERA (id TEXT,carrera TEXT);";
	    String query6 = "CREATE TABLE CARRERA_MATERIA (carrera_id TEXT,materia_id TEXT);";
	    
	    db.execSQL(query1);
	    db.execSQL(query2);
	    db.execSQL(query3);
	    db.execSQL(query4);
	    db.execSQL(query5);
	    db.execSQL(query6);
	    //Datos base
	    
	    String queryUsuarios;
	    queryUsuarios = "INSERT INTO USUARIO (id, usuario,clave,nombre,apellido,rol) VALUES (1, 'admin','admin','Juan','Perez','ADM')";
	    db.execSQL(queryUsuarios);
	    queryUsuarios = "INSERT INTO USUARIO (id, usuario,clave,nombre,apellido,rol) VALUES (2, 'alumno1','1234','Juan Carlos','Rodriguez','ALU')";
	    db.execSQL(queryUsuarios);
	    queryUsuarios = "INSERT INTO USUARIO (id, usuario,clave,nombre,apellido,rol) VALUES (3, 'alumno2','1234','Leticia','Gomez','ALU')";
	    db.execSQL(queryUsuarios);
	    queryUsuarios = "INSERT INTO USUARIO (id, usuario,clave,nombre,apellido,rol) VALUES (4, 'alumno3','1234','Ricardo','Perez','ALU')";
	    db.execSQL(queryUsuarios);
	    queryUsuarios = "INSERT INTO USUARIO (id, usuario,clave,nombre,apellido,rol) VALUES (5, 'hfenocci','1234','Hector','Fenocci','PRO')";
	    db.execSQL(queryUsuarios);
	    queryUsuarios = "INSERT INTO USUARIO (id, usuario,clave,nombre,apellido,rol) VALUES (6, 'smiraglia','1234','Sebastian','Miraglia','PRO')";
	    db.execSQL(queryUsuarios);
	    queryUsuarios = "INSERT INTO USUARIO (id, usuario,clave,nombre,apellido,rol) VALUES (7, 'sraneri','1234','Silvia','Raneri','PRO')";
	    db.execSQL(queryUsuarios);
	    queryUsuarios = "INSERT INTO USUARIO (id, usuario,clave,nombre,apellido,rol) VALUES (8, 'avidaurri','1234','Alejandro','Vidaurri','PRO')";
	    db.execSQL(queryUsuarios);
	    
	    
	    String queryCarreras;
	    queryCarreras = "INSERT INTO CARRERA (id,carrera) VALUES ('AS','Analista de Sistemas');";
	    db.execSQL(queryCarreras);
	    queryCarreras = "INSERT INTO CARRERA (id,carrera) VALUES ('DM','Diseño Multimedial');";
	    db.execSQL(queryCarreras);
	    queryCarreras = "INSERT INTO CARRERA (id,carrera) VALUES ('DW','Diseño Web');";
	    db.execSQL(queryCarreras);
	    queryCarreras = "INSERT INTO CARRERA (id,carrera) VALUES ('VJ','Programación de Video Juegos');";
	    db.execSQL(queryCarreras);
	    queryCarreras = "INSERT INTO CARRERA (id,carrera) VALUES ('CA','Cine y Animación');";
	    db.execSQL(queryCarreras);
	    queryCarreras = "INSERT INTO CARRERA (id,carrera) VALUES ('DG','Diseño gráfico');";
	    db.execSQL(queryCarreras);
	    String queryMaterias;
	    
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0011','Organización Empresarial',1);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0012','Introducción a la Informática',1);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0013','Programación I',1);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0014','Taller de Computación I',1);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0015','Matemática',1);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0016','Inglés Técnico I',1);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0021','Sistemas Administrativos',2);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0022','Arquitectura y Sistemas Operativos',2);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0023','Programación II',2);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0024','Taller de Computación II',2);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0025','Estadística',2);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0026','Ingles Técnico II',2);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0031','Modelos Estratégicos de Negocios',3);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0032','Diseño y Admin. de Base de Datos',3);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0033','Programación III',3);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0034','Taller de Computación III',3);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0035','Etica',3);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0041','Análisis y metodología de sistemas',4);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0042','Redes y sistemas operativos distribuidos',4);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0043','Seminario de programación',4);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0044','Taller de computación IV',4);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0045','Simulación',4);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0046','Deontología profesional',4);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0051','Administración de proyectos',5);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0052','Diseño de Sistemas',5);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0053','Calidad de Software',5);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0054','Taller de Computación V',5);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0055','Informática y Sociedad',5);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0061','Seminario de Sistemas',6);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0062','Seguridad e Integridad de Sistemas',6);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0063','Seminario de Tecnología',6);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0064','Computación Avanzada',6);";
	    db.execSQL(queryMaterias);
	    queryMaterias = "INSERT INTO MATERIA (id, materia,cuatrimestre) VALUES ('S0065','Taller de Computación VI',6);";
	    db.execSQL(queryMaterias);

	    
	    String queryCarreraMateria;
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0011');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0012');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0013');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0014');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0015');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0016');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0021');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0022');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0023');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0024');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0025');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0026');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0031');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0032');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0033');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0034');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0035');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0041');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0042');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0043');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0044');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0045');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0046');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0051');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0052');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0053');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0054');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0055');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0061');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0062');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0063');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0064');";
	    db.execSQL(queryCarreraMateria);
	    queryCarreraMateria = "INSERT INTO CARRERA_MATERIA (carrera_id,materia_id) VALUES ('AS','S0065');";
	    db.execSQL(queryCarreraMateria);
	    
	    
	    String queryProfesorMateria;
	    queryProfesorMateria = "INSERT INTO PROFESOR_MATERIA (usuario_id,materia_id) VALUES (5,'S0011')";
	    db.execSQL(queryProfesorMateria);
	    queryProfesorMateria = "INSERT INTO PROFESOR_MATERIA (usuario_id,materia_id) VALUES (5,'S0021')";
	    db.execSQL(queryProfesorMateria);
	    queryProfesorMateria = "INSERT INTO PROFESOR_MATERIA (usuario_id,materia_id) VALUES (5,'S0031')";
	    db.execSQL(queryProfesorMateria);
	    queryProfesorMateria = "INSERT INTO PROFESOR_MATERIA (usuario_id,materia_id) VALUES (6,'S0012')";
	    db.execSQL(queryProfesorMateria);
	    queryProfesorMateria = "INSERT INTO PROFESOR_MATERIA (usuario_id,materia_id) VALUES (8,'S0013')";
	    db.execSQL(queryProfesorMateria);
	    queryProfesorMateria = "INSERT INTO PROFESOR_MATERIA (usuario_id,materia_id) VALUES (7,'S0015')";
	    db.execSQL(queryProfesorMateria);
	    
	    String queryNotas;
	    queryNotas = "INSERT INTO NOTAS (usuario_id,materia_id,nota_1,nota_2,nota_3,nota_4) VALUES (2,'S0011',10,5,7,10);";
	    db.execSQL(queryNotas);
	    queryNotas = "INSERT INTO NOTAS (usuario_id,materia_id,nota_1,nota_2,nota_3,nota_4) VALUES (3,'S0011',7,8,9,8);";
	    db.execSQL(queryNotas);
	    queryNotas = "INSERT INTO NOTAS (usuario_id,materia_id,nota_1,nota_2,nota_3,nota_4) VALUES (4,'S0011',5,4,8,9);";
	    db.execSQL(queryNotas);
	    queryNotas = "INSERT INTO NOTAS (usuario_id,materia_id,nota_1,nota_2,nota_3,nota_4) VALUES (2,'S0021',7,8,9,8);";
	    db.execSQL(queryNotas);
	    queryNotas = "INSERT INTO NOTAS (usuario_id,materia_id,nota_1,nota_2,nota_3,nota_4) VALUES (2,'S0012',6,8,9,7);";
	    db.execSQL(queryNotas);
	    queryNotas = "INSERT INTO NOTAS (usuario_id,materia_id,nota_1,nota_2,nota_3,nota_4) VALUES (2,'S0013',7,7,8,6);";
	    db.execSQL(queryNotas);
	    queryNotas = "INSERT INTO NOTAS (usuario_id,materia_id,nota_1,nota_2,nota_3,nota_4) VALUES (2,'S0015',8,6,4,8);";
	    db.execSQL(queryNotas);
	    db.close();
	}

	@Override
	public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
		// TODO Auto-generated method stub
		
	}

}
