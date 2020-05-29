function nom_ruche(){
			var nomruchepublic = document.getElementById("liste_ruche_public").value;
			var nomrucheprivee = document.getElementById("liste_ruche_privee").value;
			
			if((nomruchepublic==null)||(nomrucheprivee==null)){
				document.getElementById("liste_ruche_privee").style.display = 'block';
				document.getElementById("liste_ruche_public").style.display = 'block';
				document.getElementById("nom_ruche_choisie").innerHTML ="";
				
				console.log('nomruche');	
				
			}else if(nomruchepublic!=null){
				document.getElementById("nom_ruche_choisie").innerHTML = "La ruche choisie est : "+nomruchepublic;
				document.getElementById("liste_ruche_public").style.display = 'block';
				document.getElementById("liste_ruche_privee").style.display = 'none';
				
				console.log('ruche public not nomruche');
				
			}else if(nomrucheprivee!=null){
				document.getElementById("nom_ruche_choisie").innerHTML = "La ruche choisie est : "+nomrucheprivee;
				document.getElementById("liste_ruche_privee").style.display = 'block';
				document.getElementById("liste_ruche_public").style.display = 'none';
				
				console.log('ruche privee not nomruche');
			}
 	 	}
