from sqlalchemy import *
import re

class mysqlInterface:
  def __init__(self, dbhost, dbport, dbname, dbtype, dbuser,dbpassword):
    #self.connection = 0                        # Connection to the dat
    # Build the connection to the database
    if dbport=="":
      connectionurl = "%s://%s:%s@%s/%s" % (dbtype,dbuser,dbpassword,dbhost,dbname)
      self.connection = create_engine(connectionurl)
    else:
      connectionurl = "%s://%s:%s@%s:%s/%s" % (dbtype,dbuser,dbpassword,dbhost,dbport,dbname)
      self.connection = create_engine(connectionurl)
      
  def GetTables(self):
  # returns a list with the table names 
    tables = self.connection.execute('SHOW TABLES');
    tableArray = []
    for row in tables:
    # build the return list
      tableArray.append(row[0])
    return tableArray

  def GetColumns(self,table):
    """ It is made this way because otherwise it is not possible to change the Settings of the Columns """
    sql = "SHOW COLUMNS FROM %s" % table
    columns = self.connection.execute(sql)
    column = []
    columnArray = []
    for row in columns:
      for element in row:
        column.append(element)
      columnArray.append(column)
      column = []
      
    return columnArray
    
  
  def GetKeys(self, dbname):
    sql = "select CONSTRAINT_NAME, TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME from information_schema.KEY_COLUMN_USAGE where CONSTRAINT_SCHEMA = '%s'" % dbname

    keys = self.connection.execute(sql)
    keysArray = keys.fetchall()
    
    return keysArray
    
  def ExecuteSelect(self, sql):
    select = self.connection.execute(sql)
    selectArray = select.fetchall()
    
    return selectArray
  
  def ConvertDBTypes(self,type):
    type = type.lower()
    if(type.find('varchar') != -1):
      return 'string'
    elif(type.find('int') != -1):
      return 'int'
    elif(type.find('enum') != -1):
      return 'enum'
    elif(type.find('mediumtext') != -1):
      return 'mediumtext'
    else:
      print "dbObjects:dbVarType: Type",type," is not supported. Feel free and add new type here."
