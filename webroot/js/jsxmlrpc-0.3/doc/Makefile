# $Id: Makefile,v 1.7 2007/06/26 12:58:40 ggiunta Exp $

### USER EDITABLE VARS ###

WEB=/var/www/jsxmlrpc/doc


#### DO NOT TOUCH FROM HERE ONWARDS ###

install:
	mkdir -p ${WEB}
	cp *.html ${WEB}
	cp *.css ${WEB}
	#cp *.pdf ${WEB}
	@echo HTML version of the manual has been installed to ${WEB}


### the following targets are to be used for library development ###

doc: out/index.html jsxmlrpc.pdf js_docs_out/index.html

out/index.html jsxmlrpc.pdf: xmlrpc_js.xml 
	-mkdir out
	-rm -rf out/*
	# custom php script that does the xslt magic
	php convert.php xmlrpc_js.xml custom.xsl out/
	# fix link to api in html docs
	sed -e 's/href=\"???\"/href=\"api\/index.html\"/' out/ch07.html > out/ch07b.html && cp -f out/ch07b.html out/ch07.html && rm out/ch07b.html
	
	# convert to fo and then to pdf using apache fop
	php convert.php xmlrpc_js.xml custom.fo.xsl xmlrpc_js.fo.xml
	fop xmlrpc_js.fo.xml jsxmlrpc.pdf
	#-rm xmlrpc_js.fo.xml

js_docs_out/index.html: ../xmlrpc_lib.js ../jsonrpc_lib.js
	-mkdir js_docs_out
	-rm -rf js_docs_out/*
	# command for jsdoc javadoc parser for javascript
	jsdoc.pl --project-name=js-xmlrpc ../xmlrpc_lib.js ../jsonrpc_lib.js ../xmlrpc_wrappers.js

dist: doc
	mkdir -p ../jsxmlrpc-${VERSION}/doc
	-cp out/*.html ../jsxmlrpc-${VERSION}/doc
	-cp out/*.css ../jsxmlrpc-${VERSION}/doc
	cp xmlrpc_js.xml ../jsxmlrpc-${VERSION}/doc
	-cp jsxmlrpc.pdf ../jsxmlrpc-${VERSION}/doc
	cp Makefile ../jsxmlrpc-${VERSION}/doc
	# jsdocs
	mkdir -p ../jsxmlrpc-${VERSION}/doc/api
	-cp js_docs_out/*.html ../jsxmlrpc-${VERSION}/doc/api
	-cp js_docs_out/*.css ../jsxmlrpc-${VERSION}/doc/api

clean:
	-rm -f out/*.html
	-rm -f out/*.css
	-rm -f js_docs_out/*.html
	-rm -f js_docs_out/*.css
	-rm xmlrpc_js.fo.xml
	-rm jsxmlrpc.pdf
