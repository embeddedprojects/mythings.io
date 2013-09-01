import sys
import file_operations

class parse_template:
  def __init__(self, template, len_template):
    self.counter = 0                    # Counter for loops
    self.template = template.lower()     # Is the template which should be parsed  
    self.old_template = template 		# is need to write the new template
    self.len_template = len_template    # Length of the template
    self.len_end_sign = 0               # Length of the array with the positions of the end signs 
    self.len_begin_sign = 0             # Length of the array with the positions of the begin signs
    self.position_command = 0           # Position of the command
    self.len_expr = 0                   # Length of the expression between the two signs
    self.position_signs = []            # Positions of the signs
    self.analysed_commands = []			# Array with the result of the analysis of the template commands
    self.len_analysed_commands = 0		# Length of the Array with the result of the analysis of the template commands
    self.no_name_counter = 1 			# Build the number behind the command if no name is given
  
  # Construct the array with the Input and other boxes in the template
  def encrypt_template(self):
    self.position_begin_end_sign("<", ">")
    
    if(self.len_end_sign == self.len_begin_sign and self.len_end_sign != 0):
      self.construct_array()
      #print self.analysed_commands
    else:
      print "Error: Syntax Error in the template file or no begin and end sign in the file\n"
      sys.exit()
  
  # Write the new template with the aliases
  def write_new_template(self,out_file,files):
    self.no_name_counter = 1
    own_counter = 0
    while(own_counter < self.len_analysed_commands and self.len_analysed_commands != 0):
      type = self.get_type(self.analysed_commands[own_counter])
      #print type
      if(type != 'button' and type != 'submit'):
        if(own_counter == 0):
          files.file_write(out_file,self.old_template[0:(self.position_signs[0][self.analysed_commands[own_counter][1][0]])])
        else:
          files.file_write(out_file,self.old_template[(self.position_signs[1][self.analysed_commands[(own_counter-1)][1][1]]+1):(self.position_signs[0][self.analysed_commands[own_counter][1][0]])])        
        self.write_macro(self.analysed_commands[own_counter],out_file,files)
      else:
        nbuttons = 1
        nbuttons = self.get_follow_buttons(own_counter,nbuttons)
        if((own_counter+nbuttons) <= self.len_analysed_commands):
          if(own_counter == 0):
            files.file_write(out_file,self.old_template[0:(self.position_signs[0][self.analysed_commands[own_counter+nbuttons][1][0]])])
          else:
            if((own_counter+nbuttons) == self.len_analysed_commands):
              files.file_write(out_file,self.old_template[(self.position_signs[1][self.analysed_commands[(own_counter-1)][1][1]]+1):(self.position_signs[1][self.analysed_commands[own_counter+nbuttons-1][1][1]]+1)])
            else:
              files.file_write(out_file,self.old_template[(self.position_signs[1][self.analysed_commands[(own_counter-1)][1][1]]+1):(self.position_signs[0][self.analysed_commands[own_counter+nbuttons][1][0]])])
            if((own_counter+nbuttons) < (self.len_analysed_commands-1)):
              self.write_macro(self.analysed_commands[own_counter+nbuttons],out_file,files)
          own_counter = own_counter + nbuttons
      own_counter = own_counter + 1
    files.file_write(out_file,self.old_template[(self.position_signs[1][self.analysed_commands[(self.len_analysed_commands-1)][1][1]]+1):self.len_template])
    if(self.len_analysed_commands == 0):
      print "No commands ( input, select, etc. ) are found in the file"
  
  def write_macro(self,command,out_file,files):
    name = self.get_macro(command)
    #print command
    rule = self.find_Mandatory(command)
    if(rule != []):
      files.file_write(out_file,'[%s][MSG%s]' % (name,name))
      #files.file_write(out_file,'[%s]*[MSG%s]' % (name,name))
    else:
      files.file_write(out_file,'[%s][MSG%s]' % (name,name))
  
  def get_follow_buttons(self, own_counter, nbuttons):
    if((own_counter+nbuttons) < self.len_analysed_commands):
      type = self.get_type(self.analysed_commands[own_counter+nbuttons])
      while(type == 'button' or type == 'submit'):
        nbuttons = nbuttons + 1
        if((own_counter+nbuttons) < self.len_analysed_commands):
          type = self.get_type(self.analysed_commands[own_counter+nbuttons])
          #print  type
        else:
          type = ""
    return nbuttons
   
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
  
  # Return the name of the macro
  def get_macro(self,analysed_command):
    self.counter = 2
    found_name = 0
    analysed_command_len = len(analysed_command[0])
    while(self.counter < analysed_command_len):
      argument_upper = analysed_command[0][self.counter].upper()
      if(argument_upper == 'NAME'):
        found_name = 1
        break
      self.counter = self.counter + 1
    if(found_name == 1):
      return analysed_command[1][self.counter].upper()
    else:
      name = '%s%s' % (analysed_command[1][2],self.no_name_counter)
      self.no_name_counter = self.no_name_counter +1
      return name.upper()
  
  # Find the Positions of the begin and end signs
  def position_begin_end_sign(self, begin_sign, end_sign):
    begin = []
    end = [] 
    self.counter = 0
    position = 0
    location_begin_2 = 0
    location_begin = 0
    location_end = 0
    len_array = self.len_template
    tp = self.template
  
    # Find the positions of the begin and end signs in the template and write it in the begin and end arrays
    while(position < self.len_template and location_end != -1 and location_begin != -1):
      location_begin = tp.find(begin_sign)
      location_end = tp.find(end_sign)
      sub_tp = tp[(location_begin+1):location_end]
      location_begin_2 = sub_tp.find(begin_sign)
      while(location_begin_2 != -1):
        location_begin = location_begin_2	 + location_begin + 1
        #print self.template[location_begin + end[self.counter-1]+1]
        sub_tp = tp[(location_begin+1):location_end]
        location_begin_2 = sub_tp.find(begin_sign)
    
      if(location_begin != -1 and self.counter != 0 and location_begin < location_end):
        begin.append(location_begin + position+1)
      elif(location_begin != -1 and location_begin < location_end):
        begin.append(location_begin)

      
      if(location_end != -1 and self.counter != 0 and location_begin < location_end):
        end.append(location_end + position +1)
      elif(location_end != -1 and location_begin < location_end):
        end.append(location_end)
  
      if(location_begin != -1 or location_end != -1):
        tp = tp[(location_end+1):len_array]
        len_array = len_array - (location_end+1)
        #print tp
        if(self.counter != 0):
          position = position + location_end + 1
        else:
          position = position + location_end   
      if(location_begin < location_end):
        self.counter = self.counter + 1
    
    # Set the length of the len_begin_sign and len_end_sign to the new value and build the two dimension array 
    # of the positions
    self.len_begin_sign = len(begin)
    self.len_end_sign = len(end)
    self.position_signs = [begin,end]
  
  # Build only the array with the information of the Begin and end signs
  def construct_array(self):
    self.counter = 0
    command_arguments = []
    while(self.counter<self.len_end_sign):
      between_signs = self.template[(self.position_signs[0][self.counter]+1):self.position_signs[1][self.counter]]
      #print between_signs
      if(between_signs != ""):
        if(between_signs.find("input") != -1):
          between_signs = self.old_template[(self.position_signs[0][self.counter]+1):self.position_signs[1][self.counter]]
          command_arguments = self.analyse_input(between_signs)
          if(self.get_block(command_arguments) != 1):
            self.analysed_commands.append(command_arguments)
        elif(between_signs.find("select") != -1):	
          between_signs = self.old_template[(self.position_signs[0][self.counter]+1):self.position_signs[1][self.counter]]
          command_arguments = self.analyse_select(between_signs)
          if(self.get_block(command_arguments) != 1):
            self.analysed_commands.append(command_arguments)
        elif(between_signs.find("textarea") != -1):
          between_signs = self.old_template[(self.position_signs[0][self.counter]+1):self.position_signs[1][self.counter]]
          command_arguments = self.analyse_textarea(between_signs)
          if(self.get_block(command_arguments) != 1):
            self.analysed_commands.append(command_arguments)
      else:
        print "Error: No Content between to command signs"
      self.counter = self.counter + 1 
    self.len_analysed_commands=len(self.analysed_commands)
  
  # check if the argument readonly is in the command
  def get_block(self,commands_arguments):
    readonly = 0 
    for argument in commands_arguments[0]:
      if(argument == "block"):
        readonly = 1
        break
    return readonly
  
  # Get the next command string 
  def get_expression(self):
    expression=""
    if(self.counter < self.len_end_sign and self.counter < self.len_begin_sign):
      expression = self.old_template[(self.position_signs[0][self.counter]+1):self.position_signs[1][self.counter]]
    return expression
  
  # Analyse a input command
  def analyse_input(self,expression):
    arguments = []
    values = []
    expression = self.analyse_head(arguments, values, "input", expression)
    if(expression != ""):
      self.analyse_arguments(arguments,values,expression)
    command_arguments=[arguments,values]
    return command_arguments
    
  # Analyse a select command
  def analyse_select(self,expression):
    arguments = []
    values = []
    expression = self.analyse_head(arguments, values, "select", expression)
    if(expression != ""):
      self.analyse_arguments(arguments,values,expression)
    self.counter = self.counter + 1
    expression = self.get_expression()
    while(expression.find("option") != -1):
      expression_o = expression[expression.find("option"):6]
      if(expression_o == "option"):
        arguments_o = []
        values_o= []
        self.analyse_arguments(arguments_o, values_o, expression[7:len(expression)])
        arguments.append("option")
        value = self.old_template[(self.position_signs[1][self.counter]+1):self.position_signs[0][(self.counter+1)]]
        values.append(value)
        if(arguments_o != [] and values_o != []):
          arguments.append("value")
          values.append(values_o[0])
        self.counter = self.counter + 2
        expression = self.get_expression()
        if(expression == ""):
          break
      else:
        self.counter = self.counter + 2
        expression = self.get_expression()
    #set the end of the expression to the new value after the option read in  
    if(expression.find("/select") != -1):
      values[1] = self.counter
    else:
      self.counter = self.counter - 1
    command_arguments=[arguments,values]
    return command_arguments
   
  # Analyse a textfield command
  def analyse_textarea(self,expression):
    arguments = []
    values = []
    expression = self.analyse_head(arguments, values, "textarea", expression)
    #print expression
    if(expression != ""):
      self.analyse_arguments(arguments,values,expression)
    command_arguments=[arguments,values]
    self.counter = self.counter + 1
    expression = self.get_expression()
    if(expression.find("/textarea") != -1):
      # Set the value of the end of the command to the new value
      values[1] = self.counter
    else:
      self.counter = self.counter - 1
    return command_arguments
  
  # Build the heads of the several commands in the template
  def analyse_head(self, arguments, values, commandtype, expression):
    self.position_command = expression.find(commandtype)
    self.len_expr = len(expression)
    # Save the begin and the end of the template to build later the new template with the alaises
    arguments.append("start")
    values.append(self.counter)
    arguments.append("end")
    values.append(self.counter)
    arguments.append("command")
    values.append(commandtype)
    commandlen = len(commandtype)
    expression = expression[(self.position_command+commandlen+1):self.len_expr]
    return expression
  
  #Analyse the arguments
  def analyse_arguments(self,arguments,values,expression):
    own_counter = 0
    arg_val_begin=0
    self.len_expr=len(expression)
    while(own_counter<self.len_expr):
      if(expression[own_counter] != ' ' and expression[own_counter] != '\n'):
        arg_val_begin = own_counter
        while(own_counter<self.len_expr):
          if(expression[own_counter] == ' ' or expression[own_counter] == '=' or expression[own_counter] == '\n'):
            argument=expression[arg_val_begin:own_counter]
            arguments.append(argument)
            while(expression[own_counter] != '=' and expression[own_counter] != ' ' and expression[own_counter] != '/' and own_counter<(self.len_expr-1)):
              own_counter = own_counter+1
            counter_for_equal = own_counter
            exist_value = 0
            while(counter_for_equal<(self.len_expr-1)):
              if(expression[counter_for_equal] == '='):
                exist_value = 1
                break
              counter_for_equal = counter_for_equal+1
              
            #print expression[own_counter]
            if(exist_value == 1):#expression[own_counter] == '='):
              own_counter = counter_for_equal
              # The next line is made to commit the own_counter by reference to the analyse_value function
              own_counter_value = [own_counter]
              value = self.analyse_value(expression,own_counter_value)
              own_counter = own_counter_value[0]
              values.append(value)  
            else:
              values.append(0)
            break
          elif(expression[own_counter] == '/'):
            if(own_counter != arg_val_begin):
              argument=expression[arg_val_begin:own_counter]
              arguments.append(argument)
              values.append(0)
            break
          elif(own_counter==(self.len_expr-1)):
            if(own_counter != arg_val_begin):
              argument=expression[arg_val_begin:(own_counter+1)]
              arguments.append(argument)
              values.append(0)
            break          
          own_counter = own_counter+1
      own_counter = own_counter+1
        
  #Analysiert die Werte der einzelnen Argumente
  def analyse_value(self,expression,own_counter):
    value=""
    own_counter[0]=own_counter[0]+1
    while(own_counter[0]<self.len_expr):
      if(expression[own_counter[0]] != ' ' and expression[own_counter[0]] != '\n'):
        if(expression[own_counter[0]] == '"'):
          own_counter[0]=own_counter[0]+1
          arg_val_begin = own_counter[0]
          while(own_counter[0]<self.len_expr and expression[own_counter[0]] != '"'):
            own_counter[0]=own_counter[0]+1
            #print "test" + expression
          value=expression[arg_val_begin:own_counter[0]]
          #print value
          break
        elif(expression[own_counter[0]] == "'"):
          own_counter[0]=own_counter[0]+1
          arg_val_begin = own_counter[0]
          while(own_counter[0]<self.len_expr and expression[own_counter[0]] != "'"):
            own_counter[0]=own_counter[0]+1
          value=expression[arg_val_begin:own_counter[0]]
          #print value
          break
        else:
          arg_val_begin = own_counter[0]
          while(own_counter[0]<self.len_expr and expression[own_counter[0]] != ' '):
            own_counter[0]=own_counter[0]+1
          value=expression[arg_val_begin:own_counter[0]]
          #print value
          break
      own_counter[0]=own_counter[0]+1
    return value
  
  def find_Mandatory(self,commands):
    self.counter = 2
    rule_msg = []	
    commands_len = len(commands[0])
    while(self.counter < commands_len):
      argument_upper = commands[0][self.counter].upper()
      if(argument_upper == 'RULE'):
        value = commands[1][self.counter].lower()
        if(value.find("alpha") != -1 or value.find("digit") != -1 
	  or value.find("notempty") != -1 
	  or value.find("email") != -1 
	  or value.find("datum") != -1):
          rule_msg.append(value)
          break;
        else:
          return rule_msg
      self.counter = self.counter + 1
    if(rule_msg != []):
      self.counter = 2
      while(self.counter < commands_len):
        argument_upper = commands[0][self.counter].upper()
        if(argument_upper == 'MSG'):
          rule_msg.append(commands[1][self.counter])
          break;
        self.counter = self.counter + 1
    return rule_msg
