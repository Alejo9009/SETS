const mysql = require('mysql');
const fs = require('fs');
const path = require('path');


const sslCert = fs.readFileSync(path.join(__dirname, '../ssl/DigiCertGlobalRootCA.crt.pem'));

const db = mysql.createConnection({
  host: 'sets.mysql.database.azure.com',
  user: 'wolwerine24',
  password: 'Apartamento12',
  database: 'sets',
  ssl: {
    ca: sslCert, 
    rejectUnauthorized: true 
  },
  connectTimeout: 10000
});

db.connect((err) => {
  if (err) {
    console.error('Error de conexión a MySQL:', err.stack);
    process.exit(1);
  }
  console.log('Conectado a MySQL con SSL');
});

module.exports = db;