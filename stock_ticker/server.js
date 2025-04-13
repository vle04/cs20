var http = require('http');
var fs = require('fs');

http.createServer(function (req, res) {
  const file = "companies.csv";
  fs.readFile(file, 'utf8', function(err, txt) {
    if (err) {
        res.writeHead(500, {'Content-Type': "text/html"});
        res.end("error reading the file");
        return;
    }

    const rows = txt.trim().split('/\r?/n');
    const headers = rows[0].split(',');

    let html = `<html><head><title>public companies</title></head><body>`;
    html += `<h1>public companies</h1><table border="1"><tr>`;
    //<th>name</th><th>ticker</th><th>price</th></tr>';

    headers.forEach(h => html += `<th>${h}</th>`);
    html += `</tr>`

    // skip the header row
    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].split(",");
        html += `<tr>`;
        cells.forEach(cell => {
            html += `<td>${cell.trim()}</td>`;
        });
        html += `</tr>`;
    }

    // rows.forEach(row => {
    //     const [name, ticker, price] = row.split(',');
    //     html += `<tr><td>${name}</td><td>${ticker}</td><td>${price}</td><tr>`;
    // });

    html += '</table></body></html>';

    res.writeHead(200, {'Content-Type': 'text/html'});
    res.write(html);
    res.end();
  });
}).listen(8080);

console.log("server is running on local host 8080");