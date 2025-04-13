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

    // const newData = {"title": "title", "ticker": "ticker", "price": 0.00};
    // const result = await coll.insertOne(newData);

    const fileStream = fs.createReadStream(filePath);
    const rl = readline.createInterface({
      input: fileStream,
    });

    let isFirstLine = true;
    for await (const line of rl) {
      if (isFirstLine) {
        isFirstLine = false; // skip header line
        continue;
      }

      const [name, ticker, price] = line.split(',');
      const doc = {
        name: name.trim(),
        ticker: ticker.trim(),
        price: parseFloat(price),
      };

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