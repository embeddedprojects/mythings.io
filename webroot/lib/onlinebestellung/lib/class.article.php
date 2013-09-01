<?

class Article
{
  var $id;
  var $articleid;
  var $aufsteigend;
  var $title;
  var $price;
  var $tax;
  var $deliverytime;
  var $args;

  function Article()
  {
  }

  function Get($db,$articleid)
  {
    if($articleid!="")
    {
      $sql = "SELECT * FROM smartshop_articles WHERE articleid='$articleid' LIMIT 1";
      $result = $db->SelectArr($sql);
      $this->id = $result[0]['id'];
      $this->title = $result[0]['title'];
      $this->price = $result[0]['price'];
      $this->tax = $result[0]['tax'];
      $this->deliverytime = $result[0]['deliverytime'];
      $this->articleid = $result[0]['articleid'];
      $this->args = $result[0]['args'];
    }
  }
}

?>
