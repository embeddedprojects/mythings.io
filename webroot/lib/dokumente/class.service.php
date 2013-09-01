<?php


class ServicePDF extends Briefpapier {
  public $doctype;

  function ServicePDF($app, $doctype)
  {
    $this->app=&$app;
    //parent::Briefpapier();
    $this->doctype=strtolower($doctype);
    $this->doctypeOrig=$doctype;
    parent::Briefpapier(&$this->app);

  }

  function getServicePDF($data)
  {
   $this->recipient['enterprise'] = $data[name];

    $this->recipient['address1']     = $data[strasse];
    $this->recipient['areacode']     = $data[plz];
    $this->recipient['city']         = $data[ort];
    $this->recipient['kundentyp']    = $data[adresse];
    $this->recipient['phone']    = $data[telefon];
    $this->recipient['email']    = $data[email];

    if($this->recipient['city']!="")
      $this->recipient['country']      = $data[land]; 
  
  $this->setCorrDetails(array("Kundennummer"=>$data['kundennummer'],
			      "Datum"=>date('d.m.Y')));
  
  for($i=0;$i<count($data[articlelist]);$i++)
  {
    $artikel = $data[articlelist][$i];
    $this->addServiceItem(array('id'=>$artikel[id],
				'amount'=>$artikel[anzahl],
				'name'=>$artikel[beschreibung]));
  }

  $this->notice = $data[bemerkung];

  $this->setBarcode($data[session]);

  }

}
?>
