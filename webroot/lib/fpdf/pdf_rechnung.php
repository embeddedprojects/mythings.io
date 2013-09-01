<?
include("fpdf.php");

class PDFRechnung extends FPDF {

	var $x0,$y0;
	
	var $R; //rechnungsdaten
	var $K; //kundendaten
	var $P; //firma daten (p kommt von provider)


	function Rechnung($id)
	{
		global $db,$myAuth;
		define('EUR'," EUR");
		$this->AliasNbPages();
		$this->SetAutoPageBreak('on',30);
		
		$this->R[datum] = Datum($this->R[datum]); 
		
		
		// Kundendaten
		$this->K[col_institut]=$konto[col_institut];
		$konto[col_kontonummer] = substr_replace($konto[col_kontonummer], 'xxx', -3, 3);
		$this->K[col_kontonummer]=$konto[col_kontonummer];
			
		
		
		// Providerdaten
		$this->AddPage();
		$pos=1;	
		if(count($ArrArtikel)>0){
		foreach($ArrArtikel as $artikel){
			$this->Artikel($pos,$artikel[menge],$artikel[einheit],
				$artikel[beschreibung],$artikel[einzelpreis],$artikel[einzelpreis]*$artikel[menge]);
			$pos++;
			$gesamt = $gesamt + $artikel[einzelpreis]*$artikel[menge];
			}
		}


		$this->Gesamt($gesamt);
	}
	
	function TabellenBeschriftung()
	{
		$this->SetY(130);
		$this->SetX(20);
		
		$this->SetFont('Arial','',9);
	        $this->Cell(15,6,'Pos',1);
	        $this->Cell(15,6,'Menge',1);
	        $this->Cell(15,6,'Einheit',1);
	        $this->Cell(75,6,'Beschreibung',1);
	        $this->Cell(25,6,'Einzelpreis',1);
	        $this->Cell(25,6,'Gesamtpreis',1);
		$this->Ln();
	}
	
	function Artikel($pos,$menge,$einheit,$beschreibung,$preis,$gesamt)
	{
		
		
		$preis = number_format($preis,2);
		$gesamt = number_format($gesamt,2);
	
		// zähle anzahl der zeilen
		$beschreibung = nl2br($beschreibung);
		$ArrBeschr = split("<br />",$beschreibung);
		$beschreibung ="";$zeilen=0;
		
		foreach($ArrBeschr as $besch){
			//echo $zeilen ." ".$besch."<br>";
			$besch = rtrim($besch);
			if($besch!="" && strlen($besch)>3){
				$beschreibung .= $besch;
				$zeilen++;
				//echo strlen($besch)."<br>";
				if(strlen($besch)>=45)
					$zeilen++;

			}
			if(($zeilen > 20)&& (count($ArrBeschr)>20) ){
				$beschreibung = Datum($beschreibung);	
				$hoehe = 4 * $zeilen;
				$this->SetX(20);
	        		$this->Cell(15,$hoehe,$pos,'LTRB',0,'R');
	        		$this->Cell(15,$hoehe,$menge,'LTRB',0,'C');
	        		$this->Cell(15,$hoehe,$einheit,'LTRB',0,'C');
				$y = $this->GetY();
				$x = $this->GetX();
	        		$this->MultiCell(75,4,$beschreibung,'TLRB','L');
				$this->SetY($y); 
	       			$this->SetX($x+75); 
				$this->Cell(25,$hoehe,$preis.EUR,'LTRB',0,'R');
	        		$this->Cell(25,$hoehe,$gesamt.EUR,'LTRB',0,'R');
				$this->Ln();
				$beschreibung="Fortsetzung von vorheriger Seite:";	
				$zeilen=0;
				$preis=0;
				$gesamt=0;
				//break;
			}
		}
		//$zeilen=5;
//		if($zeilen<count($ArrBeschr))
//			$zeilen = count($ArrBeschr);
				$zeilen++;

		$beschreibung = Datum($beschreibung);	
		$hoehe = 4 * $zeilen;

		$this->SetX(20);
	        $this->Cell(15,$hoehe,$pos,'LTR',0,'R');
	        $this->Cell(15,$hoehe,$menge,'LTR',0,'C');
	        $this->Cell(15,$hoehe,$einheit,'LTR',0,'C');
		$y = $this->GetY();
		$x = $this->GetX();
	        $this->MultiCell(75,4,$beschreibung,'TLR','L');
		$this->SetY($y); 
	       	$this->SetX($x+75); 
		$this->Cell(25,$hoehe,$preis.EUR,'LTR',0,'R');
	        $this->Cell(25,$hoehe,$gesamt.EUR,'LTR',0,'R');
		$this->Ln();
	}	

	function Gesamt($netto)
	{
		global $myAuth;

		$steuer = number_format(round(($netto * $this->P[col_umsatzsteuer])-$netto,2),2);
		$brutto = number_format($netto * $this->P[col_umsatzsteuer],2);
		$netto = number_format($netto,2);
	
		$this->SetX(20);
	        $this->Cell(145,6,'Gesamt Netto',1);
	        $this->Cell(25,6,$netto.EUR,1,0,'R');
		$this->Ln();
		$this->SetX(20);
	        $this->Cell(145,6,'zzgl. '.(($this->P[col_umsatzsteuer]*100)-100).'% USt.',1);
	        $this->Cell(25,6,$steuer.EUR,1,0,'R');
		$this->Ln();
		$this->SetX(20);
		$this->SetFont('Arial','B',10);
	        $this->Cell(145,6,'Gesamtbetrag',1);
	        $this->Cell(25,6,$brutto.EUR,1,0,'R');
		$this->Ln();
		$this->SetFont('Arial','',10);
		if($this->R[lastschrift]=="1"){
			$this->Cell(10); $this->Cell(170,20,
			"Betrag wird vom Konto ".
			($this->K[col_kontonummer])." bei der ".$this->K[col_institut]." abgebucht."
			,0,1,'L');
		}
		else {
			$this->Cell(10); $this->Cell(170,20,
			$myAuth->GetProviderData('col_zahlziel')
			,0,1,'L');
		}
    //$this->SetFont('Arial','',10);
		//$this->Cell(10); $this->Cell(170,20,"Der Betrag wird in den nächsten Tagen auf Ihr Konto überwiesen".,0,1,'L');



	}

	function Header()
	{	
	        //$this->SetMargins( 0, 0, 0 );
	        //$this->SetDisplayMode("fullwidth");
	        $this->AliasNbPages();
		 //PDF-Info
                $this->SetAuthor(PAGE_AUTHOR);
                $this->SetTitle(STORE_NAME);
                $this->SetCreator('sisbuz Provider System v. 0.1');
	
		//firmen daten
		//Set font
		$this->SetFont('Arial','B',18);
		//Move to 8 cm to the right
		$this->Cell(10); $this->Cell(170,20,$this->P[col_firma],0,1,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(140); $this->Cell(50,5,$this->P[col_strasse],0,1,'L');
		$this->Cell(140); $this->Cell(50,5,$this->P[col_plz]." ".$this->P[col_ort],0,1,'L');
		$this->Cell(140); $this->Cell(50,5,"Telefon: ".$this->P[col_telefon],0,1,'L');
		
		$this->SetFont('Arial','',8);
		$this->Cell(10); $this->Cell(80,5,$this->P[col_firma]." - ".$this->P[col_strasse]." - ".$this->P[col_plz]." ".$this->P[col_ort],0,0,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(50);$this->Cell(50,5,"Telefax: ".$this->P[col_telefax],0,1,'L');	
		
		$this->SetFont('Arial','',8);
		$this->Cell(10); $this->Line($this->GetX(),$this->GetY(),$this->GetX()+80,$this->GetY());
		$this->SetFont('Arial','',10);
		$this->Cell(50);$this->Cell(50,1,"",0,1,'L');	
		
		$this->Cell(10); $this->Cell(80,5,"",0,0,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(50);$this->Cell(50,5,"E-Mail: ".$this->P[col_emailr],0,1,'L');	
		
		if($this->K[col_firma]!=""){
			$this->Cell(10); $this->Cell(80,5,$this->K[col_firma],0,0,'L');
			$this->SetFont('Arial','',10);
			$this->Cell(50);$this->Cell(50,5,"",0,1,'L');	
		}	
		$this->Cell(10); $this->Cell(80,5,$this->K[col_vorname]." ".$this->K[col_nachname],0,0,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(50);$this->Cell(50,5,"",0,1,'L');	
		
        	$this->Cell(10); $this->Cell(80,5,$this->K[col_strasse],0,0,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(50);$this->Cell(50,5,"",0,1,'L');	
	       	
		$this->Cell(10); $this->Cell(80,5,"",0,0,'L');
		$this->SetFont('Arial','',11);
		$this->Cell(50);$this->Cell(50,5,"",0,1,'L');	
		
		$this->Cell(10); $this->Cell(80,5,$this->K[col_plz]." ".$this->K[col_ort],0,0,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(50);$this->Cell(50,5,$this->P[col_sonstiges],0,1,'L');	
	
		//*************** kundennummer rechnungsnummer und datum
		$this->Ln(20);
		$this->SetFont('Arial','',8);
		$this->Cell(10); $this->Cell(50,5,"Kundennummer");
		$this->Cell(50,5,"Lieferdatum");
		$this->Cell(50,5,"Rechnungsnnummer");$this->Cell(40,5,"Datum",0,1);
		$this->Cell(10); $this->Cell(50,5,$this->R[kunde_id]);
		$this->Cell(50,5,$this->R[datum]);
		$this->Cell(50,5,$this->R[rechnungsnr]);
		$this->Cell(40,5,$this->R[datum]);
		
		$this->Ln(10);
		$this->SetFont('Arial','B',11);
		$this->Cell(10); $this->Cell(180,5,"Rechnung Nr. ".$this->R[rechnungsnr],0,1);
		

		$this->TabellenBeschriftung();
	}


	function Footer()
	{

    		//Go to 1.5 cm from bottom
        	$this->SetY(-30);
		$this->Line($this->GetX()+10,$this->GetY(),$this->GetX()+180,$this->GetY());
		$this->Ln(1);
	        $this->SetFont('Arial','',7);
		$this->Cell(10); $this->Cell(130,3,$this->P[col_firma]);$this->Cell(60,3,$this->P[col_kontoinhaber],0,1);
		$this->Cell(10); $this->Cell(130,3,$this->P[col_nachname]);$this->Cell(60,3,$this->P[col_institut],0,1);
		$this->Cell(10); $this->Cell(130,3,$this->P[col_strasse]);$this->Cell(20,3,"Konto");$this->Cell(40,3,$this->P[col_kontonummer],0,1);
		$this->Cell(10); $this->Cell(130,3,$this->P[col_plz]." ".$this->P[col_ort]);$this->Cell(20,3,"BLZ:");$this->Cell(40,3,$this->P[col_blz],0,1);
		$this->Cell(10); $this->Cell(130,3,$this->P[col_emailr]);$this->Cell(20,3,"IBAN:");$this->Cell(40,3,$this->P[col_iban],0,1);
		if($this->P[col_umsatzsteuer]=="1")
		{
		$this->Cell(10); $this->Cell(130,3,"SteuerNr. ".$this->P[col_steuernummer]);
		$this->Cell(20,3,"BIC:");$this->Cell(40,3,$this->P[col_bic],0,1);
		}else 
		{
		$this->Cell(10); $this->Cell(130,3,"USt-ID. ".$this->P[col_steuernummer]);
		$this->Cell(20,3,"BIC:");$this->Cell(40,3,$this->P[col_bic],0,1);
		}
		
	    	//Select Arial italic 8
	        $this->SetFont('Arial','I',7);
	    	//Print centered page number
		$this->Cell(0,5,'Seite '.$this->PageNo().'/{nb}',0,0,'C');

	}

}




?>
