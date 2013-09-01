from xml.etree.cElementTree import ElementTree

""" read Configfile """
class configFile:
  def __init__(self,file):
    self.file = file
    self.tree = ElementTree.parse(file, parser=None)

  def GetContent(self,tag):
    if self.tree.getroot().findall(tag):
      return self.tree.getroot().findall(tag)[0].text
    return ""

  def GetParameter(self,tag,para):
    for paras in self.tree.getiterator(tag):
      return paras.get(para)

