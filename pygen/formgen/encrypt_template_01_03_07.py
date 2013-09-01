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
  
  # Construct the array with the Input and other boxes in the template
  def encrypt_template(self):
    parse_class.position_begin_end_sign("<", ">")
    
    if(self.len_end_sign == self.len_begin_sign):
      self.construct_array()
    else:
      print "Error: Syntax Error in the template file\n"
      sys.exit()
    
    #nur zu Entwicklungszwecken 
    a=len(self.position_signs[0])
    #print a
    #print position_signs[1][276]
    #print template[position_signs[0][276]]

  
  # Find the Positions of the begin and end signs
  def position_begin_end_sign(self, begin_sign, end_sign):
    begin = []
    end = [] 
    self.counter = 0
    position = 0
    location = 0
    len_array = self.len_template
    tp = self.template
  
    # Find the positions of the begin and end signs in the template and write it in the begin and end arrays
    while(position < self.len_template and location != -1):
      location = tp.find(begin_sign)
      if(location != -1 and self.counter != 0):
        begin.append(location + end[self.counter-1]+1)
      elif(location != -1):
        begin.append(location)

      location = tp.find(end_sign)
      if(location != -1 and self.counter != 0):
        end.append(location + end[self.counter-1]+1)
      elif(location != -1):
        end.append(location)
  
      if(location != -1):
        tp = tp[(location+1):len_array]
        len_array = len_array - (location+1)
        position = end[self.counter]
      self.counter = self.counter + 1
    
    # Set the length of the len_begin_sign and len_end_sign to the new value and build the two dimension array 
    # of the positions
    self.len_begin_sign = len(begin)
    self.len_end_sign = len(end)
    self.position_signs = [begin,end]
  
  # Build only the array with the information of the Begin and end signs
  def construct_array(self):
    self.counter = 0
    test = []
    command_arguments = []
    while(self.counter<self.len_end_sign):
      between_signs = self.template[(self.position_signs[0][self.counter]+1):self.position_signs[1][self.counter]]
      #print between_signs
      if(between_signs != ""):
        if(between_signs.find("input") != -1):
          command_arguments = self.analyse_input(between_signs)
          test.append(command_arguments)
          #print test
        elif(between_signs.find("select") != -1):
          command_arguments = self.analyse_select(between_signs)
          test.append(command_arguments)
          #print "select"  
      else:
        print "Error: No Content between to command signs"
      self.counter = self.counter + 1 
    print test
  
  # Analyse a input command
  def analyse_input(self,expression):
    arguments = []
    values = []
    self.len_expr=len(expression)
    self.position_command = expression.find("input")
    arguments.append("command")
    values.append("input")
    expression = expression[(self.position_command+6):self.len_expr]
    #print expression
    if(expression != ""):
      self.analyse_arguments(arguments,values,expression)
    command_arguments=[arguments,values]
    return command_arguments
    
  def analyse_select(self,expression):
    arguments = []
    values = []
    self.position_command = expression.find("select")
    self.len_expr = len(expression)
    arguments.append("command")
    values.append("select")
    expression = expression[(self.position_command+7):self.len_expr]
    #print expression
    if(expression != ""):
      self.analyse_arguments(arguments,values,expression)
    command_arguments=[arguments,values]
    self.counter = self.counter + 1
    expression = self.template[(self.position_signs[0][self.counter]+1):self.position_signs[1][self.counter]] 
    while(expression == "option"):
      print "test"
      if(expression == "option"):
        arguments.append("option")
        value = self.template[(self.position_signs[1][self.counter]+1):self.position_signs[0][(self.counter+1)]]
        print value
        values.append(value)
        self.counter = self.counter + 2
        expression = self.template[(self.position_signs[0][self.counter]+1):self.position_signs[1][self.counter]] 
    return command_arguments
  
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
            while(expression[own_counter] == ' ' and expression[own_counter] != '/' and own_counter<(len_expr-1)):
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
    
  
  def test(self, counter):
    counter[0] = counter[0] + 10

  
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


# nur zu Entwicklungszwecken 
int=len(template)


#print position_signs[0][276]
#print position_signs[1][0]

#print template

  