#!/usr/bin/python
import sys
import file_operations 
from configfile import configFile
import encrypt_template
from dbObjects import DB_Interface

class form_gen:
  def __init__(self, form,path,file_operations):
    self.counter = 0		                # Counter for the class
    self.name_form = form                   # Name of the form
    self.path = path                        # the path where the file is created
    self.file_operations = file_operations  # The Object for the file operations
    
  def write_class(self,parse_class):
    out_file = self.file_operations.file_open_write(self.path,('widget.gen.%s.php' % self.name_form))
    if(out_file == 0):
      sys.exit()
    self.file_operations.file_write(out_file,'<?php \n\n')
    constructor = self.constructor()
    self.file_operations.file_write(out_file,constructor)
    delete_function = self.delete_function()
    self.file_operations.file_write(out_file,delete_function)
    
    edit_function = self.edit_function()
    self.file_operations.file_write(out_file,edit_function)
    copy_function = self.copy_function()
    self.file_operations.file_write(out_file,copy_function)

    create_function = self.create_function()
    self.file_operations.file_write(out_file,create_function)
    search_function = self.search_function()
    self.file_operations.file_write(out_file,search_function)
    summary_function = self.summary_function()
    self.file_operations.file_write(out_file,summary_function)


    form_function = self.form_function(parse_class)
    self.file_operations.file_write(out_file,form_function)
    self.file_operations.file_write(out_file,'}\n\n?>')
  
  def get_commands(self, parse_class):
    parse_class.no_name_counter = 1
    command_array = ''
    for commands in parse_class.analysed_commands:
      name = parse_class.get_macro(commands)
      name = name.lower()
      argument_upper = commands[1][2].upper()
      if(argument_upper == 'INPUT'):
        type = self.get_type(commands).lower()
        if(type == 'checkbox'):
          array = self.build_checkbox(name,commands)
          command_array = command_array + array
        else: 
          if(type != 'button' and type != 'submit'):
            array = self.build_input(type,name,commands)
            command_array = command_array + array
      elif(argument_upper == 'SELECT'):
        array = self.build_select(name,commands)
        command_array = command_array + array
      elif(argument_upper == 'TEXTAREA'):
        text = self.get_text(commands,parse_class)
        rows = self.get_int_value(commands,'rows')
        cols = self.get_int_value(commands,'cols')
        command_array = command_array + '''    $field = new HTMLTextarea("%s",%i,%i);   
    $this->form->NewField($field);\n''' % (name,rows,cols)
      Mandatory = self.add_Mandatory(commands,name,parse_class)
      if(Mandatory != 0):
        command_array = command_array + Mandatory
      else:
        command_array = command_array + '\n'
    return command_array
    
  def add_Mandatory(self,commands,name,parse_class):
    rule = parse_class.find_Mandatory(commands)
    if(rule != []):
      Mandatory = ""
      if(len(rule) == 2):
        if(rule[1] != ''):
          Mandatory = '    $this->form->AddMandatory("%s","%s","%s",MSG%s);\n\n' % (name,
                       rule[0],rule[1],name.upper())
        else:
          Mandatory = '    $this->form->AddMandatory("%s","%s","!",MSG%s);\n\n' % (name,
                       rule[0],name.upper())
      else:
        Mandatory = '    $this->form->AddMandatory("%s","%s","!",MSG%s);\n\n' % (name,
                       rule[0],name.upper())
      return Mandatory
    else:
      return 0   
  
  def build_input(self,type,name,commands):
    size = self.get_int_value(commands,'size')
    value = self.get_value(commands)
    maxlength = self.get_int_value(commands,'maxlength')
    array = '    $field = new HTMLInput("%s","%s","%s"' % (name,type,value)
    if(size != 0):
      array = array + ',"%i"' % size
    if(maxlength != 0):
      array = array + ',maxlength="%i"' % maxlength
    if(self.get_checked(commands) != 0):
      array = array + ',checked="checked"'
    if(self.get_readonly(commands) != 0):
      array = array + ',readonly="readonly"'
    if(self.get_disabled(commands) != 0):
      array = array + ',disabled="disabled"'
    array = array + ');\n    $this->form->NewField($field);\n'
    return array
  
  def get_checked(self,commands):
    checked = 0
    for command in commands[0]:
      command = command.lower()
      if(command == "checked"):
        checked = 1
        break;
    return checked
  
  def get_readonly(self,commands):
    checked = 0
    for command in commands[0]:
      command = command.lower()
      if(command == "readonly"):
        checked = 1
        break;
    return checked
 
  def get_disabled(self,commands):
    checked = 0
    for command in commands[0]:
      command = command.lower()
      if(command == "disabled"):
        checked = 1
        break;
    return checked

  def build_checkbox(self,name,commands):
    checked = self.get_checked(commands)
    array = ""
    value = self.get_value(commands)
    if(checked == 1):
      array = '''    $field = new HTMLCheckbox("%s","","%s","%s");
    $this->form->NewField($field);\n''' % (name,value,value)
    else:
      array = '''    $field = new HTMLCheckbox("%s","","","%s");
    $this->form->NewField($field);\n''' % (name,value)
    return array  
      
  def build_select(self,name,commands):
    size = self.get_int_value(commands,'size')
    options = self.get_options(commands)
    array = '    $field = new HTMLSelect("%s",%i);\n' % (name,size)
    for option in options:
      array = array + "    $field->AddOption('%s','%s');\n" % (option[0],option[1]) 
    array = array + '    $this->form->NewField($field);\n'
    return array
        
  def get_type(self,commands):
    self.counter = 2
    type = ""	
    commands_len = len(commands[0])
    while(self.counter < commands_len):
      argument_upper = commands[0][self.counter].upper()
      if(argument_upper == 'TYPE'):
        return commands[1][self.counter]
      self.counter = self.counter + 1
    return type
  
  def get_int_value(self,commands,argument):
    self.counter = 2
    number = 0	
    commands_len = len(commands[0])
    argument = argument.upper()
    while(self.counter < commands_len):
      current_argument = commands[0][self.counter].upper()
      if(current_argument == argument):
        return int(commands[1][self.counter])
      self.counter = self.counter + 1
    return number
    
  def get_value(self,commands):
    self.counter = 2
    value = ""	
    commands_len = len(commands[0])
    while(self.counter < commands_len):
      argument_upper = commands[0][self.counter].upper()
      if(argument_upper == 'VALUE'):
        return commands[1][self.counter]
      self.counter = self.counter + 1
    return value
  
  def get_text(self,commands, parse_class):
    if(commands[0] != commands[1]):
      begin = parse_class.position_signs[1][int(commands[1][0])]+1
      end = parse_class.position_signs[0][int(commands[1][1])]
      return parse_class.template[begin:end]
    else:
      return ""
  
  def get_options(self,commands):
    self.counter = 2
    options = []
    buffer = []
    commands_len = len(commands[0])
    while(self.counter < commands_len):
      buffer = []
      argument_upper = commands[0][self.counter].upper()
      if(argument_upper == 'OPTION'):
        buffer.append(commands[1][self.counter])
        if((self.counter+1) < commands_len):
          argument_upper = commands[0][self.counter+1].upper()
          if(argument_upper == 'VALUE'):
            buffer.append(commands[1][self.counter+1])
            self.counter = self.counter + 1
          else:
            buffer.append(commands[1][self.counter].lower())
        else:
            buffer.append(commands[1][self.counter].lower())
        options.append(buffer)
      self.counter = self.counter + 1
    return options
  
  def constructor(self):
    classname = 'class WidgetGen%s\n{\n\n' % self.name_form
    variables = '''  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content\n\n'''
    constructor = '''  public function WidgetGen%s($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }\n\n''' % self.name_form
    """classname = 'class %s\n' % self.name_form
    formgen = '{\n\n  function %s(&$app)\n  {\n    $this->app=&$app;\n\n
        $this->%sForm();\n\n' % (self.name_form,self.name_form)
    AH='    $this->app->ActionHandlerInit($this);\n\n'
    AHCreate = '    $this->app->ActionHandler("create","%sCreate");\n' % self.name_form
    AHEdit = '    $this->app->ActionHandler("edit","%sEdit");\n' % self.name_form
    AHCopy = '    $this->app->ActionHandler("copy","%sCopy");\n' % self.name_form
    AHlist = '    $this->app->ActionHandler("list","%sList");\n' % self.name_form
    AHdelete = '    $this->app->ActionHandler("delete","%sDelete");\n' % self.name_form
    DefaultAH= '    $this->app->ActionHandler("create");'
    AHListen = '\n\n    $this->app->ActionHandlerListen(&$app);'
    End = '\n  } \n\n'
    return classname + formgen + AH + AHCreate + AHEdit + AHCopy + AHlist + AHdelete + DefaultAH + AHListen + End"""
    return classname + variables + constructor
  
  def delete_function(self):
    function = '''  public function %sDelete()\n  {\n    
    $this->form->Execute("%s","delete");\n
    $this->%sList();\n  }\n\n''' %(self.name_form,self.name_form,self.name_form)   
    return function
  
  def create_function(self):
    function = '  public function Create()\n  {\n'   
    settings = '    $this->form->Create();\n'
    end = '  }\n\n'  
    return function + settings + end
   
  def summary_function(self):
    function = '  public function Summary()\n  {\n'   
    settings = '    $this->app->Tpl->Set($this->parsetarget,"grosse Tabelle");\n'
    end = '  }\n\n'  
    return function + settings + end
 
  def search_function(self):
    function = '  public function Search()\n  {\n'   
    settings = '    $this->app->Tpl->Set($this->parsetarget,"SUUUCHEEE");\n'
    end = '  }\n\n'  
    return function + settings + end

  def edit_function(self):
    function = '  function Edit()\n  {\n'
    settings = '    $this->form->Edit();\n'
    end = '  }\n\n'   
    return function + settings + end
   
  def copy_function(self):
    function = '  function Copy()\n  {\n'
    settings = '    $this->form->Copy();\n'
    end = '  }\n\n'   
    return function + settings + end
 
  def form_function(self, parse_class):
    function = '''  function Form()\n  {\n    $this->form = $this->app->FormHandler->CreateNew("%s");
    $this->form->UseTable("%s");
    $this->form->UseTemplate("%s.tpl",$this->parsetarget);\n\n'''% (self.name_form,self.name_form,self.name_form)
    commandarray = self.get_commands(parse_class)
    end = '  }\n\n'   
    return function + commandarray + end
    
# Liest die Datei ein
length = len(sys.argv)
if(length != 5):
  print 'not enough arguments' 
  
  configfile = configFile(sys.argv[1])
  files = file_operations.Fileoperations()
  template_name = 'einzelpersonsearch'
  in_file = files.file_open_read(configfile.GetContent("path") ,('%s.html'%template_name))
  if(in_file != 0):
    template = files.file_read_complete(in_file)
    parse_class = encrypt_template.parse_template(template, len(template))
    parse_class.encrypt_template()
    out_file = files.file_open_write(configfile.GetContent("path"),('%s_new.tpl' % template_name))
    if(out_file != 0):
      parse_class.write_new_template(out_file,files)

      form_gen = form_gen(template_name,configfile.GetContent("path"),files)
      form_gen.write_class(parse_class)
  else:
    print 'no template was found'
else:
  files = file_operations.Fileoperations()
  print sys.argv[2]
  in_file = files.file_open_read(sys.argv[2],'')
  if(in_file != 0):
    template = files.file_read_complete(in_file)
    parse_class = encrypt_template.parse_template(template, len(template))
    parse_class.encrypt_template()
    out_file = files.file_open_write(sys.argv[3],('%s.tpl' % sys.argv[1]))
    if(out_file != 0):
      parse_class.write_new_template(out_file,files)
      form_gen = form_gen(sys.argv[1],sys.argv[4],files)
      form_gen.write_class(parse_class)
  else:
    print 'no template was found'
