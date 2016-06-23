#!/usr/bin/python

import MySQLdb
from validate_email import validate_email



def validateEmailId( email ):
  if validate_email(email) == false and validate_email(email,check_mx=True) == false and validate_email(email,verify=True) == false:
    return false
      
  return true

db = MySQLdb.connect("localhost","root","redhat@11111p","campaning_engine" )

cursor = db.cursor()

sql = "SELECT * FROM emails where status != 'valid' "

try:
   # Execute the SQL command
   cursor.execute(sql)
   # Fetch all the rows in a list of lists.
   results = cursor.fetchall()
   for row in results:
      id = row[0]
      email = row[1]
      newStatus = "not done"
      #newStatus =  validateEmailId ( email )
      # Now print fetched result
      print "id=%s,email=%s,new status=%s" % \
             (id, email, newStatus )
except Exception, err:
   print Exception, err
   print "Error: unable to fecth data"

# disconnect from server
db.close()
