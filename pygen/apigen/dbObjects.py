import sys
from sqlalchemy import *
from MySQLDB_Interface import mysqlInterface

class DB_Interface:
  def __init__(self,host,port,db,type,user,password):
    self.database = mysqlInterface(host,port,db,type,user,password)                   # open the DB
    self.dbname = db                                                                   # includes the name of the db which is opened
    self.DBType = []                                                                   # contain the types of the columns in the DB 
    self.counter = 0                                                                   # is only a counter for the class
    self.DBTables = self.database.GetTables()                                          # contain all tables
    self.DBKeys = self.database.GetKeys(self.dbname)                                   # contain alle keys
    self.buildDBDocument()                                                              # read the information from the database in the several python datatypes
  
  def buildDBDocument(self):
    ColumnsTable = []   
    for table in self.DBTables:
      ColumnsTable = self.database.GetColumns(table)
      ColumnsTable = self.convertColumnTypes(ColumnsTable)
      # ist ausgeblendet weil es eigentlich zur Informationengewinnung nicht beitraegt und somit eigentlich ueberfluessig ist
      #ColumnsTable = self.addKeys(self.DBKeys,ColumnsTable,table)   
      self.DBType.append([table,ColumnsTable])
    #print self.DBType
      
  def convertColumnTypes(self,ColumnArray):
    self.counter = 0
    for Column in ColumnArray:
      ColumnArray[self.counter][1] = self.database.ConvertDBTypes(Column[1])
      self.counter = self.counter + 1   
    return ColumnArray
    
  def addKeys(self,DBKeys,ColumnArray,table):
    self.DBKeys = DBKeys
    KeysColumn = []
    self.counter = 0
    for Column in ColumnArray:
      if(Column[3] != ""):
        for Key in DBKeys:
          if(Column[0] == Key[2] and table == Key[1]):
            KeysColumn.append(Key)
        ColumnArray[self.counter][3] = KeysColumn
        KeysColumn = []
      self.counter = self.counter + 1    
    return ColumnArray
    
  def GetType(self,table,column):
    for DB in self.DBType:
      if(DB[0] == table):
        for columns in DB[1]:
          if(columns[0] == column):
            return columns[1]
  
  def GetColumns(self,table):
    columns = []
    for DB in self.DBType:
      if(DB[0] == table):
        for column in DB[1]:
          columns.append(column[0])
        return columns
        
  def GetColumnsSettings(self,table):
    columnsSettings = []
    for DB in self.DBType:
      if(DB[0] == table):
        columnsSettings = DB[1]
        return columnsSettings
  
  def NULLable(self,table,column):
    for DB in self.DBType:
      if(DB[0] == table):
        for columns in DB[1]:
          if(columns[0] == column):
            if(columns[4] == None):
              return 'true'
            else:
              return 'false'
                     
  def GetTables(self):
    return self.DBTables
  
  def GetKeys(self):
    return self.DBKeys  
  
  def GetKeysColumn(self,table,column):
    KeysColumn = []
    for key in self.DBKeys:
      if(column == key[2] and table == key[1]):
        KeysColumn.append(Key)
    return KeysColumn
  
  def GetKeysTable(self,table):
    KeysColumn = []
    for key in self.DBKeys:
      if(table == key[1]):
        KeysColumn.append(Key)
    return KeysColumn
  
  def GetFKTable(self,table):
    ForeignKeys = []
    for key in self.DBKeys:
      if(table == key[1] and key[0] != 'PRIMARY' and key[4] != None):
        ForeignKeys.append(key)
    return ForeignKeys
  
  def GetFKColumn(self,table,column):
    ForeignKeys = []
    for key in self.DBKeys:
      if(column == key[2] and table == key[1] and key[0] != 'PRIMARY' and key[4] != None):
        ForeignKeys.append(key)
    return ForeignKeys
    
  def GetPKTable(self,table):
    PrimaryKey = []
    for key in self.DBKeys:
      if(table == key[1] and key[0] == 'PRIMARY' and key[4] == None):
        PrimaryKey.append(key[2])
    return PrimaryKey
    
  def GetAutoincrement(self,table):
    for DB in self.DBType:
      if(DB[0] == table):
        for column in DB[1]:
          if(column[5] == 'auto_increment'):
            return column[0]
    return 0
      