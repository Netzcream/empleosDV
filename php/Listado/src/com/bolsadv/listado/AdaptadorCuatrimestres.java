package com.bolsadv.listado;

import java.util.List;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

public class AdaptadorCuatrimestres extends ArrayAdapter<String> {

	 Activity context;
	    List<String> cuatrimestre;
	    List<String> carrera;
	    
	    public AdaptadorCuatrimestres(Activity context, int idListItem, List<String> cuatrimestres, List<String> carreras){
	    	 super(context, idListItem,carreras);
	            this.context = context;
	            this.cuatrimestre = cuatrimestres;
	            this.carrera = carreras;
	            
	        }
	    
        @SuppressLint({ "ViewHolder", "InflateParams" })
		public View getView(int position, View convertView, ViewGroup parent) {
            
        	LayoutInflater inflater = context.getLayoutInflater();
        	View item = inflater.inflate(R.layout.listcuatrimestre, null);
          	TextView texto = (TextView)item.findViewById(R.id.tvCuatrimestre);
        	texto.setText(cuatrimestre.get(position));
        	TextView texto2 = (TextView)item.findViewById(R.id.tvCarr);
        	texto2.setText(carrera.get(position));
        	        	
        	return(item);
    }
 
	
	
}
