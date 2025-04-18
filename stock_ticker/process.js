const fs = require('fs');
const readline = require('readline');
const MongoClient = require('mongodb').MongoClient;
const http = require('http');
const qs = require('querystring');

// connection string
const url = 'mongodb+srv://vle04:tohruai9894@cluster0.gfpfgzd.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0';
const filePath = 'companies.csv';

// only want mongodb to run when user submits the form
http.createServer(async (req, res) => {
  // parse the url, detect the route
  urlObj = url.parse(req.url, true);
  path = urlObj.pathname;

  if (path == "/" || path == "home") {
    file = "home.html";
    fs.readFile(file, function(err, home) {
      if (err) {
        res.writeHead(500);
        return res.end("error loading home page");
      }
      res.writeHead(200, {'Content-Type': 'text/html'});
      res.write(home);
      res.end();
    })
  }

  try {
    // wait to connect to db
    const client = await MongoClient.connect(url);
    var dbo = client.db("Stock");
    var coll = dbo.collection('PublicCompanies');

    // console.log("new document inserted");
    // await client.close();
  } catch (err) {
    // console.error("error inserting document: ", err);
  }
}).listen(8080);