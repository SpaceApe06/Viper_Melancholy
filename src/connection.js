var mysql = require('ViperDB');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "Admin"
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
});