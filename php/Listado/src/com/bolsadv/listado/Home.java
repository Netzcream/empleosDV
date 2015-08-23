package com.bolsadv.listado;

	import android.os.Bundle;
import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.Intent;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

	public class Home extends Activity implements OnClickListener {

	    @Override
	    protected void onCreate(Bundle savedInstanceState) {
	        super.onCreate(savedInstanceState);
	        setContentView(R.layout.activity_home);
	        setTitle("Ingreso al sistema");
			Button b = (Button) findViewById(R.id.btnLogin);
	        b.setOnClickListener((android.view.View.OnClickListener) this);
	        
	       
	    }

		@SuppressLint("DefaultLocale")
		@Override
		public void onClick(View v) {
			
	
			
			
			Intent i = null;
			switch (v.getId()) {
				case R.id.btnLogin: {
					
					
					/* Inicio Login */
			        miBase conexBase = new miBase(this, "Listado", null, 1);
			        SQLiteDatabase db = conexBase.getWritableDatabase();
			        
			        if(db != null)
			        {
			        	
			        	EditText etUsuario = (EditText) findViewById(R.id.etUsuario);
			        	EditText etClave = (EditText) findViewById(R.id.etClave);
			        	
			        	String usuario = etUsuario.getText().toString().toLowerCase();
			        	String clave = etClave.getText().toString();
			        	String query = "SELECT id,apellido,nombre,rol FROM USUARIO WHERE usuario='"+usuario+"' AND clave='"+clave+"';";
			        	
			        	Cursor c = db.rawQuery(query, null);
			        	
			        	if (c.moveToFirst()) {
			        		Integer id= c.getInt(0);
			        		String apellido = c.getString(1);
			        		String nombre = c.getString(2);
			        		String rol = c.getString(3);
			           		TextView adv = (TextView)findViewById(R.id.tvAdvertencia);
			            	adv.setText("Logueo Exitoso");

			            	if (rol.equals("ALU")) {
			            		i = new Intent(this, Alumno.class);
			            		i.putExtra("id",id);
			            		i.putExtra("apellido",apellido);
			            		i.putExtra("nombre",nombre);
			            		startActivity(i);
         		
			            	}
			            	else if (rol.equals("PRO")) {
			            		i = new Intent(this, Profesor.class);
			            		i.putExtra("id",id);
			            		i.putExtra("apellido",apellido);
			            		i.putExtra("nombre",nombre);
								startActivity(i);
			            	}
			            	else if (rol.equals("ADM")) {
								 //i = new Intent(this, Profesor.class);
								 //startActivity(i);
			            		
			            		TextView adv1 = (TextView)findViewById(R.id.tvAdvertencia);
				            	adv1.setText("Ingreso como Administrador");
			            	}
			            	etUsuario.setText("");
			            	etClave.setText("");
			        	}
			        	
			        	else {
			        		TextView adv = (TextView)findViewById(R.id.tvAdvertencia);
			            	adv.setText(this.getString(R.string.err_log_1));
			        	}
			            db.close();
			        }
			        /* Fin Login */
					break;
				}
				
				
				
				

			}
	    	

			
		}

}
