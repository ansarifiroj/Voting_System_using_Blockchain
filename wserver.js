const express = require("express");
const path = require("path");
const app = express();

app.get("/", (req, res) => {
    res.sendFile(path.join(__dirname +"/welcome.php"));
})

const server = app.listen(3000);
const portNumber = server.address().port;
console.log(`port is open on ${portNumber}`);
