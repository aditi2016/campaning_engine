#!/usr/bin/python

import MySQLdb
from validate_email import validate_email



def validateEmailId( email ):
  if validate_email(email) == False and validate_email(email,check_mx=True) == False and validate_email(email,verify=True) == False:
    return "invalid"
      
  return "valid"

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
      #newStatus = "not done"
      newStatus =  validateEmailId ( email )
      sql = "UPDATE emails SET status = '%s'
                                WHERE id = '%d'" % (newStatus,id)
      cursor.execute(sql)
      db.commit()
      # Now print fetched result
      print "id=%s,email=%s,new status=%r" % \
             (id, email, newStatus )
except Exception, err:
   print Exception, err
   print "Error: unable to fecth data"

# disconnect from server
db.close()
