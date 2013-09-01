#!/usr/bin/python

import sys
import os

'''
phpwfgen:

config:

- absoluter anwendungspfad
- widgetvorlagen ordner
'''

root = sys.path[1]
htmldrafts = sys.path[1] + '/vorlagen'

print 'Application path: %s' % root
print 'HTML Drafts: %s' % htmldrafts

'''
liste mit seiten die primaer aus einem widget bestehen
      
#widget generieren
      
hole alle .htm oder .html dateien aus den widgetvorlagen ordner und mache
      
showband.html
  - widget/template/_gen/showband.tpl
  - wiget/_gen/widget.gen.showband.tpl
	  
wenn es das nicht gibt:
wiget/_gen/widget.showband.tpl
dann anlegen
'''

files = os.listdir(htmldrafts) 

for file in range (len(files)): 
  
  (name, extension) =  os.path.splitext(files[file])
  # only html files
  if extension==".html" or extension==".htm":
    print 'File: %s' % files[file]
    cmd = 'formgen.py %s vorlagen/%s widgets/templates/_gen/ widgets/_gen/' % (name,files[file])
    os.system(cmd)



# object api generieren
cmd = 'objapigen.py -u eproosystem -p msp430 -d eproosystem -a %s/objectapi/db/_gen/' % root
os.system(cmd)


'''
#seiten generieren
		    
liste mit seiten die hauptsaechlich aus einem widget bestehen.
diese dateien werden nur generier wenn sie nicht existieren:
		    
showband
veranstalter ....
		    
in pages/ datei anlegen wenn sie nicht existiert
		    
im pages/content templates anlegen wenn sie nicht existieren:
		    
showband_create.tpl
showband_summary.tpl
showband_edit.tpl
'''
os.system('../pygen/pagegen/pagegen.py adresse pages/')
os.system('../pygen/pagegen/pagegen.py artikel pages/')
os.system('../pygen/pagegen/pagegen.py projekt pages/')
#os.system('../pygen/pagegen/pagegen.py auftrag pages/')
os.system('../pygen/pagegen/pagegen.py bestellung pages/')
os.system('../pygen/pagegen/pagegen.py ticket pages/')
#os.system('pagegen.py showband pages/')
#os.system('pagegen.py agentur pages/')
#os.system('pagegen.py einzelperson pages/')
#os.system('pagegen.py veranstaltungsort pages/')
#os.system('pagegen.py veranstalter pages/')

os.system('../pygen/pagegen/pagegen.py emailbackup pages/')
