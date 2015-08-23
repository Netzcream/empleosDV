package com.bolsadv.listado;

import java.util.List;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.TextView;

public class AdaptadorProfesorNotas extends ArrayAdapter<String> {

	
	Activity context;
    List<String> alumno;
    List<String> notasPP;
    List<String> notasSP;
    List<String> notasTP;
    List<String> notasNF;
    
	public AdaptadorProfesorNotas(Activity context, int idListItem, List<String> listaAlumno,
			List<String> listaNotaPP, List<String> listaNotaSP,
			List<String> listaNotaTP, List<String> listaNotaNF) {
   	 super(context, idListItem,listaAlumno);
	 this.context = context;
	 this.alumno = listaAlumno;
	 this.notasPP = listaNotaPP;
	 this.notasSP = listaNotaSP;
	 this.notasTP = listaNotaTP;
	 this.notasNF = listaNotaNF;

	}

	
    @SuppressLint({ "ViewHolder", "InflateParams" })
	public View getView(int position, View convertView, ViewGroup parent) {
    	LayoutInflater inflater = context.getLayoutInflater();
    	View item = inflater.inflate(R.layout.listcargarnotas, null);
    	
    	((TextView)item.findViewById(R.id.tvAlumnoNota)).setText(alumno.get(position));    	
    	((EditText)item.findViewById(R.id.etNotaPP)).setText(notasPP.get(position));
    	((EditText)item.findViewById(R.id.etNotaSP)).setText(notasSP.get(position));
    	((EditText)item.findViewById(R.id.etNotaTP)).setText(notasTP.get(position));
    	((EditText)item.findViewById(R.id.etNotaNF)).setText(notasNF.get(position));
    	
    	return(item);
}

	
}
