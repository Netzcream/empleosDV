package com.bolsadv.listado;

import java.util.ArrayList;
import java.util.List;

import android.app.Activity;
import android.content.Intent;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.Toast;

public class Profesor extends Activity implements OnItemClickListener {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_profesor);

		Bundle extras = getIntent().getExtras();
		String apellido = extras.getString("apellido");
		String nombre = extras.getString("nombre");
		Integer id = extras.getInt("id");
        setTitle(apellido+", "+nombre);

        
        miBase conexBase = new miBase(this, "Listado", null, 1);
        SQLiteDatabase db = conexBase.getWritableDatabase();
    	List<String> listaMaterias = new ArrayList<String>();
    	List<String> listaCodigos = new ArrayList<String>();
    	List<String> listaCuatrimestre = new ArrayList<String>();
        if(db != null)
        {
          	String query = "SELECT M.id,M.cuatrimestre,M.materia FROM PROFESOR_MATERIA PM" +
          			" JOIN MATERIA M ON (PM.materia_id=M.id)" +
          			" WHERE PM.usuario_id='"+id+"' ORDER BY M.cuatrimestre ASC;";
        	Cursor c = db.rawQuery(query, null);
            if (c.moveToFirst()) {
	            do {
	            	String qid= c.getString(0);
	                String qcuatrimestre = c.getString(1);
	                String qmateria = c.getString(2);
	                
	
	            	listaMaterias.add(qmateria);
	            	listaCodigos.add(qid);
	            	
	            	listaCuatrimestre.add(" - "+qcuatrimestre+"º "+ this.getString(R.string.cuatri));
	            	
	           } while(c.moveToNext());
            }
            db.close();
        }
        if (!listaMaterias.isEmpty()) {
        	AdaptadorMateriaProfesor adaptador = new AdaptadorMateriaProfesor(this, R.layout.listprofesor, listaMaterias,listaCodigos,listaCuatrimestre); 
        	ListView lstOpciones = (ListView)findViewById(R.id.lvMateriaProfesor);
        	lstOpciones.setAdapter(adaptador);
        	lstOpciones.setOnItemClickListener((OnItemClickListener) this);	
        }
        else {
        	TextView cod = (TextView)findViewById(R.id.tvMateriaProfesor);
        	cod.setText(this.getString(R.string.noMatAsig));
        }

	}

	@Override
	public void onItemClick(AdapterView<?> parent, View view, int position,
			long id) {
		TextView tvs = (TextView) view.findViewById(R.id.tvCodMateria2);
		String texto = tvs.getText().toString();
		TextView tvmateria = (TextView) view.findViewById(R.id.tvMateriaProfesor);
		String materia = tvmateria.getText().toString();
		Toast toast = Toast.makeText(this,materia, Toast.LENGTH_SHORT);
        toast.show(); 
		Intent i = new Intent(this, Profesor_notas.class);
		i.putExtra("id",texto);
		i.putExtra("materia",materia);
		startActivity(i);
		
	}

}
