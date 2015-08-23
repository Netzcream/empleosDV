package com.bolsadv.listado;

import java.util.List;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

public class AdaptadorNotas extends ArrayAdapter<String> {

	 Activity context;
	    List<String> materia;
	    List<String> pp;
	    List<String> sp;
	    List<String> tp;
	    List<String> notaFinal;
	    
	    public AdaptadorNotas(Activity context, int idListItem, List<String> materias, List<String> pp2, List<String> sp2, List<String> tp2, List<String> notaFinal2){
	    	 super(context, idListItem,materias);
	            this.context = context;
	            this.materia = materias;
	            this.pp = pp2;
	            this.sp = sp2;
	            this.tp = tp2;
	            this.notaFinal = notaFinal2;
	            
	        }
	    
        @SuppressLint({ "ViewHolder", "InflateParams" })
		public View getView(int position, View convertView, ViewGroup parent) {
            
        	LayoutInflater inflater = context.getLayoutInflater();
        	View item = inflater.inflate(R.layout.listnotas, null);
        	
          	TextView texto = (TextView)item.findViewById(R.id.tvMateria);
        	texto.setText(materia.get(position));
        	TextView texto2 = (TextView)item.findViewById(R.id.tvPrimerP);
        	texto2.setText(pp.get(position));
        	TextView texto3 = (TextView)item.findViewById(R.id.tvSegundoP);
        	texto3.setText(sp.get(position));
        	TextView texto4 = (TextView)item.findViewById(R.id.tvTP);
        	texto4.setText(tp.get(position));
        	TextView texto5 = (TextView)item.findViewById(R.id.tvFinal);
        	texto5.setText(notaFinal.get(position));
        	return(item);
    }
 
	
	
}
