<?

class ObjGenFrk_Member
{

  private  $memberId;
  private  $email;
  private  $title;
  private  $firstName;
  private  $middleName;
  private  $lastName;
  private  $zipCode;
  private  $city;
  private  $stateCode;
  private  $countryId;
  private  $phone;
  private  $mobile;
  private  $fax;
  private  $username;
  private  $password;
  private  $salt;
  private  $autoLogin;
  private  $timeZone;
  private  $expirationDate;
  private  $lastLoginDate;
  private  $lastLoginAddress;
  private  $creationDate;
  private  $lastChangeDate;
  private  $visits;
  private  $badAccess;
  private  $level;
  private  $activation;
  private  $authorId;
  private  $enabled;

  public $app;            //application object 

  public function ObjGenFrk_Member($app)
  {
    $this->app = $app;
  }

  public function Select($memberId)
  {
    if(is_numeric($memberId))
      $result = $this->app->DB->SelectArr("SELECT * FROM frk_member WHERE (memberId = '$memberId')");
    else
      return -1;

$result = $result[0];

    $this->memberId=$result[memberId];
    $this->email=$result[email];
    $this->title=$result[title];
    $this->firstName=$result[firstName];
    $this->middleName=$result[middleName];
    $this->lastName=$result[lastName];
    $this->zipCode=$result[zipCode];
    $this->city=$result[city];
    $this->stateCode=$result[stateCode];
    $this->countryId=$result[countryId];
    $this->phone=$result[phone];
    $this->mobile=$result[mobile];
    $this->fax=$result[fax];
    $this->username=$result[username];
    $this->password=$result[password];
    $this->salt=$result[salt];
    $this->autoLogin=$result[autoLogin];
    $this->timeZone=$result[timeZone];
    $this->expirationDate=$result[expirationDate];
    $this->lastLoginDate=$result[lastLoginDate];
    $this->lastLoginAddress=$result[lastLoginAddress];
    $this->creationDate=$result[creationDate];
    $this->lastChangeDate=$result[lastChangeDate];
    $this->visits=$result[visits];
    $this->badAccess=$result[badAccess];
    $this->level=$result[level];
    $this->activation=$result[activation];
    $this->authorId=$result[authorId];
    $this->enabled=$result[enabled];
  }

  public function Create()
  {
    $sql = "INSERT INTO frk_member (memberId,email,title,firstName,middleName,lastName,zipCode,city,stateCode,countryId,phone,mobile,fax,username,password,salt,autoLogin,timeZone,expirationDate,lastLoginDate,lastLoginAddress,creationDate,lastChangeDate,visits,badAccess,level,activation,authorId,enabled)
      VALUES('','{$this->email}','{$this->title}','{$this->firstName}','{$this->middleName}','{$this->lastName}','{$this->zipCode}','{$this->city}','{$this->stateCode}','{$this->countryId}','{$this->phone}','{$this->mobile}','{$this->fax}','{$this->username}','{$this->password}','{$this->salt}','{$this->autoLogin}','{$this->timeZone}','{$this->expirationDate}','{$this->lastLoginDate}','{$this->lastLoginAddress}','{$this->creationDate}','{$this->lastChangeDate}','{$this->visits}','{$this->badAccess}','{$this->level}','{$this->activation}','{$this->authorId}','{$this->enabled}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->memberId))
      return -1;

    $sql = "UPDATE frk_member SET
      email='{$this->email}',
      title='{$this->title}',
      firstName='{$this->firstName}',
      middleName='{$this->middleName}',
      lastName='{$this->lastName}',
      zipCode='{$this->zipCode}',
      city='{$this->city}',
      stateCode='{$this->stateCode}',
      countryId='{$this->countryId}',
      phone='{$this->phone}',
      mobile='{$this->mobile}',
      fax='{$this->fax}',
      username='{$this->username}',
      password='{$this->password}',
      salt='{$this->salt}',
      autoLogin='{$this->autoLogin}',
      timeZone='{$this->timeZone}',
      expirationDate='{$this->expirationDate}',
      lastLoginDate='{$this->lastLoginDate}',
      lastLoginAddress='{$this->lastLoginAddress}',
      creationDate='{$this->creationDate}',
      lastChangeDate='{$this->lastChangeDate}',
      visits='{$this->visits}',
      badAccess='{$this->badAccess}',
      level='{$this->level}',
      activation='{$this->activation}',
      authorId='{$this->authorId}',
      enabled='{$this->enabled}'
      WHERE (memberId='{$this->memberId}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($memberId="")
  {
    if(is_numeric($memberId))
    {
      $this->memberId=$memberId;
    }
    else
      return -1;

    $sql = "DELETE FROM frk_member WHERE (memberId='{$this->memberId}')";
    $this->app->DB->Delete($sql);

    $this->memberId="";
    $this->email="";
    $this->title="";
    $this->firstName="";
    $this->middleName="";
    $this->lastName="";
    $this->zipCode="";
    $this->city="";
    $this->stateCode="";
    $this->countryId="";
    $this->phone="";
    $this->mobile="";
    $this->fax="";
    $this->username="";
    $this->password="";
    $this->salt="";
    $this->autoLogin="";
    $this->timeZone="";
    $this->expirationDate="";
    $this->lastLoginDate="";
    $this->lastLoginAddress="";
    $this->creationDate="";
    $this->lastChangeDate="";
    $this->visits="";
    $this->badAccess="";
    $this->level="";
    $this->activation="";
    $this->authorId="";
    $this->enabled="";
  }

  public function Copy()
  {
    $this->memberId = "";
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

  function SetMemberid($value) { $this->memberId=$value; }
  function GetMemberid() { return $this->memberId; }
  function SetEmail($value) { $this->email=$value; }
  function GetEmail() { return $this->email; }
  function SetTitle($value) { $this->title=$value; }
  function GetTitle() { return $this->title; }
  function SetFirstname($value) { $this->firstName=$value; }
  function GetFirstname() { return $this->firstName; }
  function SetMiddlename($value) { $this->middleName=$value; }
  function GetMiddlename() { return $this->middleName; }
  function SetLastname($value) { $this->lastName=$value; }
  function GetLastname() { return $this->lastName; }
  function SetZipcode($value) { $this->zipCode=$value; }
  function GetZipcode() { return $this->zipCode; }
  function SetCity($value) { $this->city=$value; }
  function GetCity() { return $this->city; }
  function SetStatecode($value) { $this->stateCode=$value; }
  function GetStatecode() { return $this->stateCode; }
  function SetCountryid($value) { $this->countryId=$value; }
  function GetCountryid() { return $this->countryId; }
  function SetPhone($value) { $this->phone=$value; }
  function GetPhone() { return $this->phone; }
  function SetMobile($value) { $this->mobile=$value; }
  function GetMobile() { return $this->mobile; }
  function SetFax($value) { $this->fax=$value; }
  function GetFax() { return $this->fax; }
  function SetUsername($value) { $this->username=$value; }
  function GetUsername() { return $this->username; }
  function SetPassword($value) { $this->password=$value; }
  function GetPassword() { return $this->password; }
  function SetSalt($value) { $this->salt=$value; }
  function GetSalt() { return $this->salt; }
  function SetAutologin($value) { $this->autoLogin=$value; }
  function GetAutologin() { return $this->autoLogin; }
  function SetTimezone($value) { $this->timeZone=$value; }
  function GetTimezone() { return $this->timeZone; }
  function SetExpirationdate($value) { $this->expirationDate=$value; }
  function GetExpirationdate() { return $this->expirationDate; }
  function SetLastlogindate($value) { $this->lastLoginDate=$value; }
  function GetLastlogindate() { return $this->lastLoginDate; }
  function SetLastloginaddress($value) { $this->lastLoginAddress=$value; }
  function GetLastloginaddress() { return $this->lastLoginAddress; }
  function SetCreationdate($value) { $this->creationDate=$value; }
  function GetCreationdate() { return $this->creationDate; }
  function SetLastchangedate($value) { $this->lastChangeDate=$value; }
  function GetLastchangedate() { return $this->lastChangeDate; }
  function SetVisits($value) { $this->visits=$value; }
  function GetVisits() { return $this->visits; }
  function SetBadaccess($value) { $this->badAccess=$value; }
  function GetBadaccess() { return $this->badAccess; }
  function SetLevel($value) { $this->level=$value; }
  function GetLevel() { return $this->level; }
  function SetActivation($value) { $this->activation=$value; }
  function GetActivation() { return $this->activation; }
  function SetAuthorid($value) { $this->authorId=$value; }
  function GetAuthorid() { return $this->authorId; }
  function SetEnabled($value) { $this->enabled=$value; }
  function GetEnabled() { return $this->enabled; }

}

?>