import { con } from "./db_connect";

export const POST = async ({ request }) => {
	con.connect(function (err) {
		if (err) throw err;
        
		var sql = "SELECT * FROM users";

		con.query(sql, function (err, result) {
			if (err) throw err;
			console.log("yayyyyy yippiee");
		});
	});

	return new Response({ status: 200 });
};

