package com.bolsadv.listado;

import java.util.ArrayList;
import java.util.List;

import android.app.Activity;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.widget.ListView;
public class Notas extends Activity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_notas);
		
		
    	Bundle extras = getIntent().getExtras();
		
		String cuatrimestre = extras.getString("cuatrimestre");
		String id = extras.getString("usuario");
		String carrera = extras.getString("carrera");
        setTitle("Consulta de Notas");
		
        miBase conexBase = new miBase(this, "Listado", null, 1);
        SQLiteDatabase db = conexBase.getWritableDatabase();
        
        
        
        List<String> materias = new ArrayList<String>();
        List<String> pp = new ArrayList<String>();
        List<String> sp = new ArrayList<String>();
        List<String> tp = new ArrayList<String>();
        List<String> notaFinal = new ArrayList<String>();
        
   	 if(db != null)
     {
   		 
   		String query = "SELECT M.materia,N.nota_1,N.nota_2,N.nota_3,N.nota_4 FROM NOTAS N " +
        		" JOIN MATERIA M ON (M.id=N.materia_id) " +
        		" JOIN CARRERA_MATERIA CM ON (CM.materia_id=M.id) " +
        		" WHERE N.usuario_id="+id+" AND M.cuatrimestre="+cuatrimestre+"  AND CM.carrera_id='"+carrera+"';";
		
   		
   		Cursor c = db.rawQuery(query, null);
 		if (c.moveToFirst()) {
 			
 	        do {
            	materias.add(c.getString(0));
                pp.add(c.getString(1));
                sp.add(c.getString(2));
                tp.add(c.getString(3));
                notaFinal.add(c.getString(4));
                
           } while(c.moveToNext());
 		}
 		db.close();
   		 
     }
        
        
	    AdaptadorNotas adaptador = new AdaptadorNotas(this, R.layout.listnotas, materias,pp,sp,tp,notaFinal);
    	ListView lstOpciones = (ListView)findViewById(R.id.lvNotas);
    	lstOpciones.setAdapter(adaptador);
	}
}
