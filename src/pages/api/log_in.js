// log_in.js
import { con } from "./db_connect";

export const POST = async ({ request }) => {
    const { loggInn_username, loggInn_password } = await request.json();

    var sql = 'SELECT * FROM users WHERE username = ? AND password = ?';
    con.query(sql, [loggInn_username, loggInn_password], (err, result) => {
        if (err) throw err;
        if (result.length > 0) {
            return new Response(JSON.stringify({ status: 'Login successful' }), { status: 200 });
        } else {
            return new Response(JSON.stringify({ status: 'Invalid username or password' }), { status: 401 });
        }
    });
};