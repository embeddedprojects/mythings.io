<? 

class GenTicket { 

  function GenTicket(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","TicketCreate");
    $this->app->ActionHandler("edit","TicketEdit");
    $this->app->ActionHandler("copy","TicketCopy");
    $this->app->ActionHandler("list","TicketList");
    $this->app->ActionHandler("delete","TicketDelete");

    $this->app->Tpl->Set(HEADING,"Ticket");    $this->app->ActionHandlerListen(&$app);
  }

  function TicketCreate(){
    $this->app->Tpl->Set(HEADING,"Ticket (Anlegen)");
      $this->app->PageBuilder->CreateGen("ticket_create.tpl");
  }

  function TicketEdit(){
    $this->app->Tpl->Set(HEADING,"Ticket (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("ticket_edit.tpl");
  }

  function TicketCopy(){
    $this->app->Tpl->Set(HEADING,"Ticket (Kopieren)");
      $this->app->PageBuilder->CreateGen("ticket_copy.tpl");
  }

  function TicketDelete(){
    $this->app->Tpl->Set(HEADING,"Ticket (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("ticket_delete.tpl");
  }

  function TicketList(){
    $this->app->Tpl->Set(HEADING,"Ticket (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("ticket_list.tpl");
  }

} 
?>