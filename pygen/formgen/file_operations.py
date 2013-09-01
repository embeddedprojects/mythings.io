import sys
import codecs

class Fileoperations:
  #def __init__(self):
	#test = 0
  
  # Open the file to write things in it
  def file_open_write(self,path, file):
    try:
      out_file = open(path + file,"w")
      return out_file
    except IOError,e:
      print "cannot open file"
      print e 
      return 0
  
  # Open the file to read the content
  def file_open_read(self,path, file):
    try:
      in_file = open(path + file,"r")
      return in_file
    except IOError,e:
      print "cannot open file"
      print e 
      return 0
  
  # Open the file to write new things at the end
  def file_open_append(self,path, file):
    try:
      append_file = open(path + file,"a")
      return append_file
    except IOError,e:
      print "cannot open file"
      print e 
      return 0
  
  # Close the opened file
  def fileclose(self,file):
    try:
      file.close()
      return 1
    except IOError,e:
      print "cannot close file"
      print e
      return 0
      
  # Open the file to read the complete content
  def file_read_complete(self,in_file):
    try:
      content=in_file.read()
      return content
    except IOError,e:
      print "cannot read file"
      print e 
      return 0
      
  # Open the file to read a part of the content
  def file_read_part(self,in_file, length):
    try:
      part_content = in_file.read(length)
      return part_content
    except IOError,e:
      print "cannot read file"
      print e 
      return 0
      
  # Open the file to read a part of the content
  def file_write(self,out_file, string):
    try:
      out_file.write(string)
      return 1
    except IOError,e:
      print "cannot read file"
      print e 
      return 0