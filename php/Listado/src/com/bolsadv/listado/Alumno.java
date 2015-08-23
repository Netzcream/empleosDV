package com.bolsadv.listado;

import java.util.ArrayList;
import java.util.List;

import android.app.Activity;
import android.content.Intent;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ListView;

public class Alumno extends Activity implements OnItemClickListener {

	List<String> cuatrimestreID;
	List<String> carreraID;
	Integer usuarioId;
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_alumno);

        
        //Levanto los datos que fueron pasados por parámetro
    	Bundle extras = getIntent().getExtras();
		
		String apellido = extras.getString("apellido");
		String nombre = extras.getString("nombre");
		Integer id = extras.getInt("id");
		usuarioId = id;
        setTitle(apellido+", "+nombre);
        
        
        miBase conexBase = new miBase(this, "Listado", null, 1);
        SQLiteDatabase db = conexBase.getWritableDatabase();
        List<String> cuatrimestres = new ArrayList<String>();
        List<String> carreras = new ArrayList<String>();
        cuatrimestreID = new ArrayList<String>();
    	carreraID = new ArrayList<String>();
    	 if(db != null)
         {
    		 
    		 String query = "SELECT M.cuatrimestre, C.carrera, C.id FROM NOTAS N" +
    		 		" JOIN MATERIA M ON (N.materia_id=M.id)" +
    		 		" JOIN CARRERA_MATERIA CM ON (CM.materia_id=M.id)" +
    		 		" JOIN CARRERA C ON (CM.carrera_id=C.id)" +
    		 		" WHERE N.usuario_id="+id+" GROUP BY M.cuatrimestre,C.carrera ORDER by C.carrera,M.cuatrimestre ASC;;";
    		 		Cursor c = db.rawQuery(query, null);
    		 		if (c.moveToFirst()) {
    		 			
    		 			
    		 	        do {
    		            	String qcuatrimestre= c.getString(0);
    		                String qcarrera = c.getString(1);
    		                cuatrimestres.add(qcuatrimestre+" "+this.getString(R.string.cuatri));
    		                carreras.add(qcarrera);
    		                cuatrimestreID.add(qcuatrimestre);
    		                carreraID.add(c.getString(2));
    		                
    		           } while(c.moveToNext());
    		 		}
    		 		db.close();
         }

    	AdaptadorCuatrimestres adaptador = new AdaptadorCuatrimestres(this, R.layout.listcuatrimestre, cuatrimestres,carreras);
    	ListView lstOpciones = (ListView)findViewById(R.id.lvCuatris);
    	lstOpciones.setAdapter(adaptador);
    	lstOpciones.setOnItemClickListener((OnItemClickListener) this);
    	
	
    }
	@Override
	public void onItemClick(AdapterView<?> parent, View view, int position,	long id) {
    	Intent i = new Intent(this, Notas.class);
		i.putExtra("usuario",usuarioId+"");
		i.putExtra("cuatrimestre",cuatrimestreID.get(position));
		i.putExtra("carrera",carreraID.get(position));
    	startActivity(i);
		
	}
	
	
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		getMenuInflater().inflate(R.menu.alumno, menu);
		return true;
	}

	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		int id = item.getItemId();
		if (id == R.id.action_settings) {
			Intent i = new Intent (this, Preferences.class);
			startActivity(i);
			return true;
		}
		return super.onOptionsItemSelected(item);
	}
	
}
