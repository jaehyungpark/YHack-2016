######################################################################
# CLOUD SERVER API DOCUMENTATION
#
# Name: listServers
# Language: Python
#
# Description: returns a list with servers of Cloud Panel
######################################################################
from urllib.request import Request, urlopen
import urllib

#ID access to API
TOKEN = "f8a09371ec0f3348ce6d79b4d28c0660" # e.g.: "f03c3c76cc853ee690b879909c9c6f2a"
url = "https://cloudpanel-api.1and1.com/v1"

def _listServers():
	#Configure the request
	_command = url + "/servers"
	_method = 'GET'
	request = Request(_command,  
					headers={'X-TOKEN':TOKEN, 'content-type':'application/json'},
					method=_method)

	#Try to get the response
	try:
		response = urlopen(request)
		content = response.read()
		return (content.decode())
	#Fetch error
	except urllib.error.URLError as e:
		return("Error " + str(e.code) + ":" + e.reason)

#PARAMETERS

#List servers
print(_listServers())
