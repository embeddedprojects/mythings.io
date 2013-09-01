#!/usr/bin/python
import sys
import file_operations

def writefile(path,name,content):
  file = file_operations.Fileoperations()
  out_file = file.file_open_write(path,name)
  if(out_file == 0):
    sys.exit()
  file.file_write(out_file,content)


# Liest die Datei ein
length = len(sys.argv)
if(length != 3):
  print 'pagename (first arguement)'
  print 'pages folder (second arguement)'
  
pagename = sys.argv[1]
pagesfolder = sys.argv[2]

  
# create page
classheader = '<? \n\nclass Gen%s { \n\n' % pagename.title()
constructor = '  function Gen%s(&$app) { \n\n    $this->app=&$app;\n' % pagename.title()
actionhandler = '    $this->app->ActionHandlerInit($this);\n\n'
actionhandler += '    $this->app->ActionHandler("create","%sCreate");\n' % pagename.title()
actionhandler += '    $this->app->ActionHandler("edit","%sEdit");\n' % pagename.title()
actionhandler += '    $this->app->ActionHandler("copy","%sCopy");\n' % pagename.title()
actionhandler += '    $this->app->ActionHandler("list","%sList");\n' % pagename.title()
actionhandler += '    $this->app->ActionHandler("delete","%sDelete");\n\n' % pagename.title()
actionhandler += '    $this->app->Tpl->Set(HEADING,"%s");' % pagename.title()
actionhandler += '    $this->app->ActionHandlerListen(&$app);\n' 
actionhandler += '  }\n\n' 



body = '  function %sCreate(){\n' % pagename.title()
body += '    $this->app->Tpl->Set(HEADING,"%s (Anlegen)");\n  ' % pagename.title()
body += '    $this->app->PageBuilder->CreateGen("%s_create.tpl");\n  }\n\n' % pagename

body += '  function %sEdit(){\n' % pagename.title()
body += '    $this->app->Tpl->Set(HEADING,"%s (Bearbeiten)");\n  ' % pagename.title()
body += '    $this->app->PageBuilder->CreateGen("%s_edit.tpl");\n  }\n\n' % pagename

body += '  function %sCopy(){\n' % pagename.title()
body += '    $this->app->Tpl->Set(HEADING,"%s (Kopieren)");\n  ' % pagename.title()
body += '    $this->app->PageBuilder->CreateGen("%s_copy.tpl");\n  }\n\n' % pagename

body += '  function %sDelete(){\n' % pagename.title()
body += '    $this->app->Tpl->Set(HEADING,"%s (L&ouml;schen)");\n  ' % pagename.title()
body += '    $this->app->PageBuilder->CreateGen("%s_delete.tpl");\n  }\n\n' % pagename

body += '  function %sList(){\n' % pagename.title()
body += '    $this->app->Tpl->Set(HEADING,"%s (&Uuml;bersicht)");\n  ' % pagename.title()
body += '    $this->app->PageBuilder->CreateGen("%s_list.tpl");\n  }\n\n' % pagename

classfooter = '} \n?>'

path= pagesfolder+'_gen/'
name = pagename+'.php'
content = classheader + constructor + actionhandler + body + classfooter
writefile(path,name,content)

#print classheader + constructor + actionhandler + body + classfooter


#templates generieren

#create 
tpl = '<table border="0" width="100%">\n'
tpl +='<tr><td><table width="100%"><tr><td>[WIDGET_'+pagename.upper() +'_CREATE]</td></tr></table></td></tr>\n' 
tpl +='</table>'

path= pagesfolder+'content/_gen/'
name = pagename+'_create.tpl'
writefile(path,name,tpl)


#list
tpl = '<table border="0" width="100%">\n'
tpl +='<tr><td><table width="100%"><tr><td>[WIDGET_'+pagename.upper() +'_SEARCH]</td></tr></table></td></tr>\n' 
tpl +='<tr><td><table width="100%"><tr><td>[WIDGET_'+pagename.upper() +'_TABLE]</td></tr></table></td></tr>\n' 
tpl +='</table>'

path= pagesfolder+'content/_gen/'
name = pagename+'_list.tpl'
writefile(path,name,tpl)

#edit
tpl = '<table border="0" width="100%">\n'
tpl +='<tr><td><table width="100%"><tr><td>[WIDGET_'+pagename.upper() +'_EDIT]</td></tr></table></td></tr>\n' 
tpl +='</table>'

path= pagesfolder+'content/_gen/'
name = pagename+'_edit.tpl'
writefile(path,name,tpl)

#copy
tpl = '<table border="0" width="100%">\n'
tpl +='<tr><td><table width="100%"><tr><td>[WIDGET_'+pagename.upper() +'_COPY]</td></tr></table></td></tr>\n' 
tpl +='</table>'

path= pagesfolder+'content/_gen/'
name = pagename+'_copy.tpl'
writefile(path,name,tpl)
