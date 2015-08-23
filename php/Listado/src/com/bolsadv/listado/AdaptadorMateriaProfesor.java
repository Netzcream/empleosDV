package com.bolsadv.listado;

import java.util.List;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

public class AdaptadorMateriaProfesor extends ArrayAdapter<String> {

	Activity context;
    List<String> materia;
    List<String> codigo;
    List<String> cuatrimestre;
	    public AdaptadorMateriaProfesor(Activity context, int idListItem, List<String> listaMaterias, List<String> listaCodigos, List<String> listaCuatrimestre){
	    	 super(context, idListItem,listaMaterias);
	    	 this.context = context;
	    	 this.materia = listaMaterias;
	    	 this.codigo = listaCodigos;
	    	 this.cuatrimestre = listaCuatrimestre;
	    }
	    
        @SuppressLint({ "ViewHolder", "InflateParams" })
		public View getView(int position, View convertView, ViewGroup parent) {
        	LayoutInflater inflater = context.getLayoutInflater();
        	View item = inflater.inflate(R.layout.listprofesor, null);
        	TextView texto = (TextView)item.findViewById(R.id.tvMateriaProfesor);
        	texto.setText(materia.get(position));
        	TextView cod = (TextView)item.findViewById(R.id.tvCodMateria2);
        	cod.setText(codigo.get(position));
        	
        	TextView cuatri = (TextView)item.findViewById(R.id.tvProfMateriaCuatri);
        	cuatri.setText(cuatrimestre.get(position));
        	return(item);
    }
	
}
