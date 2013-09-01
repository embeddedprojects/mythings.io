#!/usr/bin/python

import sys
import file_operations 
from configfile import configFile
from dbObjects import DB_Interface

class ObjAPI_gen:
  def __init__(self,path,file_operations,DBDatatype):
    self.counter = 0		                # Counter for the class
    self.path = path                        # the path where the file is created
    self.file_operations = file_operations  # The Object for the file operations
    self.DBDatatype = DBDatatype            # includes the information about the database and the function to get the information
    
  def write_classes(self):
    tables = DBDatatype.GetTables()
    if(tables != []):
      for table in tables:
        self.write_class(table)
        #print self.DBDatatype.GetPKTable(table)
    else:
      print "No tables are in the database to build a ObjectAPI"
  
  def write_class(self,table):
    out_file = self.file_operations.file_open_write(self.path,('object.gen.%s.php' % table))
    comments = ''
    if(out_file != 0):
      columns = self.build_column_list(table)
      PKs = self.DBDatatype.GetPKTable(table)
      if(columns != [] and PKs != []):
        constructor = self.create_constructor(columns,table)
        self.file_operations.file_write(out_file,constructor)
        selectfunc = self.selectfunc(columns,table,PKs)
        self.file_operations.file_write(out_file,selectfunc)
        createfunc = self.createfunc(columns,table)
        self.file_operations.file_write(out_file,createfunc)
        updatefunc = self.updatefunc(table,PKs)
        self.file_operations.file_write(out_file,updatefunc)
        deletefunc = self.deletefunc(columns,table,PKs)
        self.file_operations.file_write(out_file,deletefunc)
        copyfunc = self.copyfunc(PKs)
        self.file_operations.file_write(out_file,copyfunc)
        comments = ''' /** 
   Mit dieser Funktion kann man einen Datensatz suchen 
   dafuer muss man die Attribute setzen nach denen gesucht werden soll
   dann kriegt man als ergebnis den ersten Datensatz der auf die Suche uebereinstimmt
   zurueck. Mit Next() kann man sich alle weiteren Ergebnisse abholen
   **/ \n\n'''
        self.file_operations.file_write(out_file,comments)
        findfunc = self.findfunc()
        self.file_operations.file_write(out_file,findfunc)
        findnextfunc = self.findnextfunc()
        self.file_operations.file_write(out_file,findnextfunc)
        comments = ''' /** Funktionen um durch die Tabelle iterieren zu koennen */ \n\n'''
        self.file_operations.file_write(out_file,comments)
        nextfunc = self.nextfunc()
        self.file_operations.file_write(out_file,nextfunc)
        firstfunc = self.firstfunc()
        self.file_operations.file_write(out_file,firstfunc)
        comments = ''' /** dank dieser funktionen kann man die tatsaechlichen werte einfach 
  ueberladen (in einem Objekt das mit seiner klasse ueber dieser steht)**/ \n\n'''
        self.file_operations.file_write(out_file,comments)
        setfuncs = self.setfuncs(columns)
        self.file_operations.file_write(out_file,setfuncs)
        # write the end of the class
        self.file_operations.file_write(out_file,'}\n\n?>')
      else:
        print "no columns are found for this table or the table has no primary key %s" % table
    else:
      print "the class for %s cannot be written" % table
  
  def build_column_list(self,table):
    #ForeignKeys = DBDatatype.GetForeignKeysTable(table)
    #TODO: Hier fehlen noch die Foreign Keys wie besprochen
    columns = self.DBDatatype.GetColumns(table)
    return columns
  
  def create_constructor(self,columns,table):
    classname = '<?\n\nclass ObjGen%s\n{\n\n' % table.title()
    variables = ''
    for column in columns:
      variables = variables + '  private  $%s;\n' % column
    variables = variables + '\n  public $app;            //application object \n\n'
    constructor = '''  public function ObjGen%s($app)
  {
    $this->app = $app;
  }\n\n''' % table.title()
    return classname + variables + constructor
  
  def selectfunc(self,columns,table,PKs):
    function = '  public function Select('
    numtest = '    if('
    sqlstatement = '      $result = $this->app->DB->SelectArr("SELECT * FROM %s WHERE (' % table
    self.counter = 0
    for PK in PKs:
      if(self.counter == 0):
        #print 'first'
        function = function + '$%s' % PK
        type = self.DBDatatype.GetType(table,PK)
        if(type == 'int'):
          numtest = numtest + 'is_numeric($%s)' % PK
        sqlstatement = sqlstatement + "%s = '$%s'" % (PK, PK)
      else:
        #print 'second'
        function = function + ', $%s' % PKs[self.counter]
        type = self.DBDatatype.GetType(table,PK)
        if(type == 'int'):
          numtest = numtest + ' && is_numeric($%s)' % PK
        sqlstatement = sqlstatement + " and %s = '$%s'" % (PK, PK)
      self.counter = self.counter + 1 
    if(numtest != '    if('):
      function = function + ')\n  {\n' + numtest + ')\n' + sqlstatement + ''')");
    else\n      return -1;\n\n'''
    else:
      sqllen = len(sqlstatement)
      function = function + ')\n  {\n' + sqlstatement[2:sqllen] + ')");\n\n'
    function = function + '$result = $result[0];\n\n'
    for column in columns:
      function = function + '    $this->%s=$result[%s];\n' % (column,column)
    return function + '  }\n\n'
  
  def createfunc(self,columns,table):
    function = '  public function Create()\n  {\n    $sql = "'
    ai_value = self.DBDatatype.GetAutoincrement(table)
    command = 'INSERT INTO %s (' % table
    values = 'VALUES('
    self.counter = 0
    for column in columns:
      if(self.counter == 0):
        command = command + '%s' % column
        if(ai_value == column):
          values = values + "''"
        else:
          values = values + "'{$this->%s}'" % column
      else:
        command = command + ',%s' % column
        if(ai_value == column):
          values = values + ",''"
        else:
          values = values + ",'{$this->%s}'" % column
      self.counter = self.counter + 1
    function = function + command + ')\n      '
    function = function + values + ''')"; \n\n    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();\n  }\n\n'''
    return function
  
  def updatefunc(self,table,PKs):
    function = '  public function Update()\n  {\n'
    numtest = '    if('
    self.counter = 0
    whereclause = '      WHERE ('
    columns = columns = self.build_column_list(table)
    if(columns == []):
      return ""
    for PK in PKs:
      if(self.counter == 0):
        columns.remove(PK)
        whereclause = whereclause + "%s='{$this->%s}'" % (PK, PK)
        type = self.DBDatatype.GetType(table,PK)
        if(type == 'int'):
          numtest = numtest + '!is_numeric($this->%s)' % PK
      else:
        columns.remove(PK)
        whereclause = whereclause + " && %s='{$this->%s}'" % (PK, PK)
        type = self.DBDatatype.GetType(table,PK)
        if(type == 'int'):
          numtest = numtest + ' || !is_numeric($this->%s)' % PK
      self.counter = self.counter + 1
    if(numtest != '    if('):
      function = function + numtest + ')\n      return -1;\n\n'
    function = function + '    $sql = "UPDATE %s SET\n' % table
    self.counter = 0
    for column in columns:
      if(self.counter == 0):
        function = function + "      %s='{$this->%s}'" % (column, column)
      else:
        function = function + ",\n      %s='{$this->%s}'" % (column, column)
      self.counter = self.counter + 1
    function = function + '\n' + whereclause + ')";\n\n'
    return function + '    $this->app->DB->Update($sql);\n  }\n\n' 
  
  def deletefunc(self,columns,table,PKs):
    function = '  public function Delete('
    numtest = '    if('
    numbody = ''
    self.counter = 0
    whereclause = 'WHERE ('
    for PK in PKs:
      if(self.counter == 0):
        function = function + '$%s=""' % PK
        whereclause = whereclause + "%s='{$this->%s}'" % (PK, PK)
        type = self.DBDatatype.GetType(table,PK)
        if(type == 'int'):
          numtest = numtest + 'is_numeric($%s)' % PK
          numbody = '      $this->%s=$%s;\n' % (PK,PK)
      else:
        function = function + ' ,$%s=""' % PK
        whereclause = whereclause + " && %s='{$this->%s}'" % (PK, PK)
        type = self.DBDatatype.GetType(table,PK)
        if(type == 'int'):
          numtest = numtest + ' && is_numeric($%s)' % PK
          numbody = numbody + '      $this->%s=$%s;\n' % (PK,PK)
      self.counter = self.counter + 1
    function = function + ')\n  {\n'
    if(numtest != '    if('):
      function = function + numtest + ')\n    {\n' + numbody + '    }\n'
      function = function + '    else\n      return -1;\n\n'
    function = function + '    $sql = "DELETE FROM ' + table +' '+ whereclause + ')";\n' 
    function = function + '    $this->app->DB->Delete($sql);\n\n'
    for column in columns:
      function = function + '    $this->%s="";\n' % column
    return function + '  }\n\n'
  
  def copyfunc(self,PKs):
    function = '  public function Copy()\n  {\n'
    for PK in PKs:
      function = function + '    $this->%s = "";\n' % PK
    function = function + '    $this->Create();\n  }\n\n'
    return function
  
  def findfunc(self):
    function = '''  public function Find()\n  {
    //TODO Suche mit den werten machen\n  }\n\n'''
    return function
  
  def findnextfunc(self):
    function = '''  public function FindNext()\n  {
    //TODO Suche mit den alten werten fortsetzen machen\n  }\n\n'''
    return function
  
  def nextfunc(self):
    function = '''  public function Next()\n  {
    //TODO: SQL Statement passt nach meiner Meinung nach noch nicht immer\n  }\n\n'''
    return function
  
  def firstfunc(self):
    function = '''  public function First()\n  {
    //TODO: SQL Statement passt nach meiner Meinung nach noch nicht immer\n  }\n\n'''
    return function
  
  def setfuncs(self,columns):
    functions = ''
    for column in columns:
      functions = functions + '  function Set%s($value) { $this->%s=$value; }\n' % (column.title(),column)
      functions = functions + '  function Get%s() { return $this->%s; }\n' % (column.title(),column)
    return functions + '\n'
    
 
def parsearguments(argv):
  if(argv[1] == '-u'):
    if(argv[3] == '-p'):
      if(argv[5] == '-d'):
        return 1
      else:
        return 0
    else:
      return 0
  else:
    return 0

length = len(sys.argv)
if(length == 2):
  configfile = configFile(sys.argv[1])
  files = file_operations.Fileoperations()

  DBDatatype = DB_Interface(configfile.GetParameter("database","host"), configfile.GetParameter("database","port"),
                     configfile.GetParameter("database","db"), configfile.GetParameter("database","type"),
                     configfile.GetParameter("database","user"), configfile.GetParameter("database","password"))

  ObjAPIgen = ObjAPI_gen(configfile.GetContent("path"),files,DBDatatype)
  ObjAPIgen.write_classes()
if(length == 9):
  allright = parsearguments(sys.argv)  
  if(allright == 1 and sys.argv[7] == '-a'):
    files = file_operations.Fileoperations()
    DBDatatype = DB_Interface('localhost', '',
                     sys.argv[6], 'mysql',
                     sys.argv[2], sys.argv[4])
    ObjAPIgen = ObjAPI_gen(sys.argv[8],files,DBDatatype)
    ObjAPIgen.write_classes()
  else:
    print 'wrong sorting of the arguments'
elif(length == 11):
  allright = parsearguments(sys.argv)
  if(allright == 1 and sys.argv[7] == '-t' and sys.argv[9] == '-a'):
    files = file_operations.Fileoperations()
    DBDatatype = DB_Interface('localhost', '',
                     sys.argv[6], 'mysql',
                     sys.argv[2], sys.argv[4])
    ObjAPIgen = ObjAPI_gen(sys.argv[10],files,DBDatatype)
    ObjAPIgen.write_class(sys.argv[8])
  else:
    print 'wrong sorting of the arguments'
else:
  print 'wrong number of arguments'

#tables = DBDatatype.GetTables()

#for table in tables:
  #print table
  #autoincrement = DBDatatype.GetAutoincrement(table)
  #print autoincrement
  #keys = test2.GetForeignKeysColumn(table,'kundenid')
  #for key in keys:
  #  print key
