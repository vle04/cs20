const fs = require('fs');
const readline = require('readline');
const MongoClient = require('mongodb').MongoClient;

// connection string
const url = 'mongodb+srv://vle04:tohruai9894@cluster0.gfpfgzd.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0';
const filePath = 'companies.csv';

async function run() {
  try {
    // wait to connect to db
    const client = await MongoClient.connect(url);
    var dbo = client.db("Stock");
    var coll = dbo.collection('PublicCompanies');

    // for testing, clear existing documents
    await coll.deleteMany({});
    console.log("cleared existing documents in PublicCompanies");

    // read in the file
    const fileStream = fs.createReadStream(filePath);
    const rl = readline.createInterface({
      input: fileStream,
    });

    // skip the first header line
    let isFirstLine = true;
    for await (const line of rl) {
      if (isFirstLine) {
        isFirstLine = false;
        continue;
      }

      // read in the data from the file and create a new document
      const [name, ticker, price] = line.split(',');
      const doc = {
        name: name.trim(),
        ticker: ticker.trim(),
        price: parseFloat(price),
      };

      // print to the console and insert a new 
      console.log(doc);
      await coll.insertOne(doc);
    }

    console.log("new document inserted");
    await client.close();
  } catch (err) {
    console.error("error inserting document: ", err);
  }
}

run();