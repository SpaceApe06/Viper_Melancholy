import mysql from "mysql2";

var con = mysql.createConnection({
	host: "localhost",
	user: "root",
	password: "ADMIN",
	database: "viperdb",
});

export { con };
