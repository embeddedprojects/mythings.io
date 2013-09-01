import sys
import file_operations

class parse_template:
  def __init__(self, template, len_template):
    self.counter = 0                    # Counter for loops
    self.template = template            # Is the template which should be parsed  
    self.len_template = len_template    # Length of the template
    self.len_end_sign = 0               # Length of the array with the positions of the end signs 
    self.len_begin_sign = 0             # Length of the array with the positions of the begin signs
    self.position_command = 0           # Position of the command
    self.len_expr = 0                   # Length of the expression between the two signs
    self.position_signs = []            # Positions of the signs
    self.analysed_commands = []			# Array with the result of the analysis of the template commands
    self.len_analysed_commands = 0		# Length of the Array with the result of the analysis of the template commands
  
  # Construct the array with the Input and other boxes in the template
  def encrypt_template(self):
    parse_class.position_begin_end_sign("<", ">")
    
    if(self.len_end_sign == self.len_begin_sign):
      self.construct_array()
    else:
      print "Error: Syntax Error in the template file\n"
      sys.exit()
  
  # Write the new template with the aliases
  def write_new_template(self,out_file):
    partof_template_to_write = ""
    files = file_operations.Fileoperations()
    self.counter = 2
    argument_upper = ""
    found_name = 0
    no_name_counter = 1
    own_counter = 0
    while(own_counter < self.len_analysed_commands):
      self.counter = 2
      found_name = 0
      if(own_counter == 0):
        files.file_write(out_file,self.template[0:(self.analysed_commands[own_counter][1][0]-1)])
      else:
        files.file_write(out_file,self.template[(self.analysed_commands[(own_counter-1)][1][1]):(self.analysed_commands[own_counter][1][0]-1)])
      analysed_command_len = len(self.analysed_commands[own_counter][0])
      while(self.counter < analysed_command_len):
        argument_upper = self.analysed_commands[own_counter][0][self.counter].upper()
        if(argument_upper == 'NAME'):
          found_name = 1
          break
        self.counter = self.counter + 1
      if(found_name == 1):
        files.file_write(out_file,'[%s]' %self.analysed_commands[own_counter][1][self.counter])
      else:
        files.file_write(out_file,'[%s%s]' % (self.analysed_commands[own_counter][1][2],no_name_counter))
        no_name_counter = no_name_counter +1
      own_counter = own_counter + 1 
    files.file_write(out_file,self.template[(self.analysed_commands[(self.len_analysed_commands-1)][1][1]):self.len_template])
        
    #files.file_write(out_file,self.template)
  
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
      #print location_begin
      #print location_end
      sub_tp = tp[(location_begin+1):location_end]
      #print sub_tp
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
        #print self.template[position]
      if(location_begin < location_end):
        self.counter = self.counter + 1
    
    # Set the length of the len_begin_sign and len_end_sign to the new value and build the two dimension array 
    # of the positions
    self.len_begin_sign = len(begin)
    self.len_end_sign = len(end)
    self.position_signs = [begin,end]
    #print self.position_signs
  
  # Build only the array with the information of the Begin and end signs
  def construct_array(self):
    self.counter = 0
    command_arguments = []
    while(self.counter<self.len_end_sign):
      between_signs = self.template[(self.position_signs[0][self.counter]+1):self.position_signs[1][self.counter]]
      #print between_signs
      if(between_signs != ""):
        if(between_signs.find("input") != -1):
          command_arguments = self.analyse_input(between_signs)
          self.analysed_commands.append(command_arguments)
          #print test
        elif(between_signs.find("select") != -1):
          command_arguments = self.analyse_select(between_signs)
          self.analysed_commands.append(command_arguments)
          #print "select"  
      else:
        print "Error: No Content between to command signs"
      self.counter = self.counter + 1 
    print self.analysed_commands
    self.len_analysed_commands=len(self.analysed_commands)
  
  # Analyse a input command
  def analyse_input(self,expression):
    arguments = []
    values = []
    expression = self.analyse_head(arguments, values, "input", expression)
    #print expression
    if(expression != ""):
      self.analyse_arguments(arguments,values,expression)
    command_arguments=[arguments,values]
    return command_arguments
    
  # Analyse a select command
  def analyse_select(self,expression):
    arguments = []
    values = []
    expression = self.analyse_head(arguments, values, "select", expression)
    #print expression
    if(expression != ""):
      self.analyse_arguments(arguments,values,expression)
    self.counter = self.counter + 1
    expression = self.template[(self.position_signs[0][self.counter]+1):self.position_signs[1][self.counter]] 
    while(expression == "option"):
      #print "test"
      if(expression == "option"):
        arguments.append("option")
        value = self.template[(self.position_signs[1][self.counter]+1):self.position_signs[0][(self.counter+1)]]
        #print value
        values.append(value)
        self.counter = self.counter + 2
        expression = self.template[(self.position_signs[0][self.counter]+1):self.position_signs[1][self.counter]] 
    #set the end of the expression to the new value after the option read in  
    if(expression == "/select"):
      values[1] = (self.position_signs[1][self.counter]+1)
    command_arguments=[arguments,values]
    return command_arguments
  
  # Build the heads of the several commands in the template
  def analyse_head(self, arguments, values, commandtype, expression):
    self.position_command = expression.find(commandtype)
    self.len_expr = len(expression)
    # Save the begin and the end of the template to build later the new template with the alaises
    arguments.append("start")
    values.append(self.position_signs[0][self.counter]+1)
    arguments.append("end")
    values.append(self.position_signs[1][self.counter]+1)
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
      if(expression[own_counter] != ' '):
        arg_val_begin = own_counter
        while(own_counter<self.len_expr):
          if(expression[own_counter] == ' ' or expression[own_counter] == '='):
            argument=expression[arg_val_begin:own_counter]
            arguments.append(argument)
            while(expression[own_counter] == ' ' and expression[own_counter] != '/' and own_counter<(self.len_expr-1)):
              own_counter = own_counter+1
           
            if(expression[own_counter] == '='):
              # The next line is made to commit the own_counter by reference to the analyse_value function
              own_counter_value = [own_counter]
              #print own_counter
              value = self.analyse_value(expression,own_counter_value)
              #print own_counter_value[0]
              own_counter = own_counter_value[0]
              values.append(value)  
            else:
              values.append(0)
                
            #print argument
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
      if(expression[own_counter[0]] != ' '):
        if(expression[own_counter[0]] == '"'):
          own_counter[0]=own_counter[0]+1
          arg_val_begin = own_counter[0]
          while(own_counter[0]<self.len_expr and expression[own_counter[0]] != '"'):
            own_counter[0]=own_counter[0]+1
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
          while(own_counter[0]<len_expr and expression[own_counter[0]] != ' '):
            own_counter[0]=own_counter[0]+1
          value=expression[arg_val_begin:own_counter[0]]
          #print value
          break
      own_counter[0]=own_counter[0]+1
    return value

files = file_operations.Fileoperations()

in_file = files.file_open_read('/var/www/phpwfgen/pygen/','band.tpl')

template = files.file_read_complete(in_file)

parse_class = parse_template(template, len(template))

parse_class.encrypt_template()

out_file = files.file_open_write('/var/www/phpwfgen/pygen/','band_new.tpl')

parse_class.write_new_template(out_file)

# nur zu Entwicklungszwecken 
#print position_signs[0][276]
#print position_signs[1][0]

#print template