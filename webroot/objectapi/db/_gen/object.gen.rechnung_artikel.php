<?

class ObjGenRechnung_Artikel
{

  private  $id;
  private  $pos;
  private  $menge;
  private  $einheit;
  private  $beschreibung;
  private  $rabatt;
  private  $einzelpreis;
  private  $steuersatz;
  private  $rechnung;

  public $app;            //application object 

  public function ObjGenRechnung_Artikel($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM rechnung_artikel WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result[id];
    $this->pos=$result[pos];
    $this->menge=$result[menge];
    $this->einheit=$result[einheit];
    $this->beschreibung=$result[beschreibung];
    $this->rabatt=$result[rabatt];
    $this->einzelpreis=$result[einzelpreis];
    $this->steuersatz=$result[steuersatz];
    $this->rechnung=$result[rechnung];
  }

  public function Create()
  {
    $sql = "INSERT INTO rechnung_artikel (id,pos,menge,einheit,beschreibung,rabatt,einzelpreis,steuersatz,rechnung)
      VALUES('','{$this->pos}','{$this->menge}','{$this->einheit}','{$this->beschreibung}','{$this->rabatt}','{$this->einzelpreis}','{$this->steuersatz}','{$this->rechnung}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE rechnung_artikel SET
      pos='{$this->pos}',
      menge='{$this->menge}',
      einheit='{$this->einheit}',
      beschreibung='{$this->beschreibung}',
      rabatt='{$this->rabatt}',
      einzelpreis='{$this->einzelpreis}',
      steuersatz='{$this->steuersatz}',
      rechnung='{$this->rechnung}'
      WHERE (id='{$this->id}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($id="")
  {
    if(is_numeric($id))
    {
      $this->id=$id;
    }
    else
      return -1;

    $sql = "DELETE FROM rechnung_artikel WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->pos="";
    $this->menge="";
    $this->einheit="";
    $this->beschreibung="";
    $this->rabatt="";
    $this->einzelpreis="";
    $this->steuersatz="";
    $this->rechnung="";
  }

  public function Copy()
  {
    $this->id = "";
    $this->Create();
  }

 /** 
   Mit dieser Funktion kann man einen Datensatz suchen 
   dafuer muss man die Attribute setzen nach denen gesucht werden soll
   dann kriegt man als ergebnis den ersten Datensatz der auf die Suche uebereinstimmt
   zurueck. Mit Next() kann man sich alle weiteren Ergebnisse abholen
   **/ 

  public function Find()
  {
    //TODO Suche mit den werten machen
  }

  public function FindNext()
  {
    //TODO Suche mit den alten werten fortsetzen machen
  }

 /** Funktionen um durch die Tabelle iterieren zu koennen */ 

  public function Next()
  {
    //TODO: SQL Statement passt nach meiner Meinung nach noch nicht immer
  }

  public function First()
  {
    //TODO: SQL Statement passt nach meiner Meinung nach noch nicht immer
  }

 /** dank dieser funktionen kann man die tatsaechlichen werte einfach 
  ueberladen (in einem Objekt das mit seiner klasse ueber dieser steht)**/ 

  function SetId($value) { $this->id=$value; }
  function GetId() { return $this->id; }
  function SetPos($value) { $this->pos=$value; }
  function GetPos() { return $this->pos; }
  function SetMenge($value) { $this->menge=$value; }
  function GetMenge() { return $this->menge; }
  function SetEinheit($value) { $this->einheit=$value; }
  function GetEinheit() { return $this->einheit; }
  function SetBeschreibung($value) { $this->beschreibung=$value; }
  function GetBeschreibung() { return $this->beschreibung; }
  function SetRabatt($value) { $this->rabatt=$value; }
  function GetRabatt() { return $this->rabatt; }
  function SetEinzelpreis($value) { $this->einzelpreis=$value; }
  function GetEinzelpreis() { return $this->einzelpreis; }
  function SetSteuersatz($value) { $this->steuersatz=$value; }
  function GetSteuersatz() { return $this->steuersatz; }
  function SetRechnung($value) { $this->rechnung=$value; }
  function GetRechnung() { return $this->rechnung; }

}

?>