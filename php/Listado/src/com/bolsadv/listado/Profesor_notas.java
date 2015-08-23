package com.bolsadv.listado;

import java.util.ArrayList;
import java.util.List;

import android.app.Activity;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.widget.ListView;

public class Profesor_notas extends Activity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_profesor_notas);
		
    	Bundle extras = getIntent().getExtras();
		
		String materia = extras.getString("materia");
		String id = extras.getString("id");
		//Integer id = extras.getInt("id");
		
        setTitle(materia);
		
        
        miBase conexBase = new miBase(this, "Listado", null, 1);
        SQLiteDatabase db = conexBase.getWritableDatabase();
    	List<String> listaAlumno = new ArrayList<String>();
    	List<String> listaNotaPP = new ArrayList<String>();
    	List<String> listaNotaSP = new ArrayList<String>();
    	List<String> listaNotaTP = new ArrayList<String>();
    	List<String> listaNotaNF = new ArrayList<String>();
    	
    	 if(db != null) {
    		 
    		 
           	String query = "SELECT U.apellido,U.nombre,N.nota_1,N.nota_2,N.nota_3,N.nota_4 FROM NOTAS N" +
           			" JOIN USUARIO U ON (U.id=N.usuario_id)" +
           			" WHERE N.materia_id='"+id+"' ORDER by U.apellido ASC;";
        	Cursor c = db.rawQuery(query, null);
        	 if (c.moveToFirst()) {
        		 
                 do {
                     listaAlumno.add(c.getString(0)+", "+c.getString(1));
                     listaNotaPP.add(c.getString(2));
                     listaNotaSP.add(c.getString(3));
                     listaNotaTP.add(c.getString(4));
                     listaNotaNF.add(c.getString(5));
                 	
                } while(c.moveToNext());
        		 
        		 
                 if (!listaAlumno.isEmpty()) {
                 	AdaptadorProfesorNotas adaptador = new AdaptadorProfesorNotas(this, R.layout.listcargarnotas,listaAlumno,listaNotaPP,listaNotaSP,listaNotaTP,listaNotaNF); 
                 	ListView lstOpciones = (ListView)findViewById(R.id.lvCargarNotas);
                 	lstOpciones.setAdapter(adaptador);
                 }
        		 
        		 
        	 }
        	 db.close();
        	 
        	 //Else cartel de no hay alumnos...
        	 
    		 
    	 }
		
		
	}


}
