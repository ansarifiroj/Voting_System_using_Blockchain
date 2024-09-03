<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.2.7-rc.0/web3.min.js"></script>
        <style>
            body {
              background-color: #f0f0f0; /* Set the background color */
            }
            .image{
              text-align: center;
            }
            .i1{
              width: 60%;
              box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
            button {
                position: absolute; 
                top: 100px; 
                left: 700px;
                font-family: "Roboto", sans-serif;
                font-size: 18px;
                font-weight: bold;
                background: #1E90FF;
                width: 200px;
                padding: 20px;
                text-align: center;
                text-decoration: none;
                text-transform: uppercase;
                color: #fff;
                border-radius: 5px;
                cursor: pointer;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                -webkit-transition-duration: 0.3s;
                transition-duration: 0.3s;
                -webkit-transition-property: box-shadow, transform;
                transition-property: box-shadow, transform;
            }
            button:hover, button:focus, button.active {
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
                -webkit-transform: scale(1.1);
                transform: scale(1.1);
            }
        </style>
  </head>
  <body>
    <?php require 'partials/_nav.php'?>
    <div>
      <strong>Notice:</strong> You can see the results by clicking on the view result button or to vote follow the instruction bellow.
    </div>
    <button onclick="result()">View Result</button><br>
    <p id="resultArea" style="position: absolute; top: 200px; left: 735px;"></p>
    <p id="resultArea2" style="position: absolute; top: 240px; left: 735px;"></p>
    <div class="container">
      <div class="steps">
        <div class="first-step" style="position: absolute; top: 250px;">
          <h3>Instructions to vote.<h3>
          <h3>1. Login</h3>
          <p> To access your account, simply log in using your unique user ID and mobile number. Your user ID serves as your personal identifier, while your phone number ensures the security of <br> your account. By entering this information, you can securely access your account and enjoy the benefits of our platform.</p>
          <div class="image"><img class="i1" src="./login.png" alt="" style="top: 300px;"></div>
      </div>
        <div class="second-step" style="position: absolute; top: 800px;">
          <h3>2. Connect to MetaMask</h3>
          <p style="text-align: justify">To connect to MetaMask, a popular cryptocurrency wallet and gateway to decentralized applications (dApps), simply install the MetaMask extension on your web browser. Once installed, <br> create an account and securely store your digital assets. With MetaMask, you can seamlessly interact with Ethereum-based dApps and manage your cryptocurrency transactions. By <br> connecting to MetaMask, you gain access to a world of decentralized finance and blockchain innovation, empowering you to participate in the future of finance with ease and security.</p>
          <div class="image"><img class="i1" src="./login1.png" alt="" style="top: 900px;"></div>
        </div>
        <div class="third-step" style="position: absolute; top: 1350px;">
          <h3>3. Vote</h3>
          <p>Voting using a blockchain system offers a revolutionary approach to democracy, ensuring transparency, security, and trust in the electoral process. Through blockchain technology, each vote <br> is recorded as a tamper-proof transaction on a distributed ledger, providing an immutable and auditable record of the voting process. This eliminates the risk of fraud or manipulation, as <br> votes cannot be altered or deleted once cast. </p>
          <div class="image"><img class="i1" src="./login2.png" alt="" style="top: 1450px;"></div>
        </div>
        <footer style="margin-bottom: 50px; position: absolute; top:2000px; left:700px">
          2024 VSB. All rights reserved.
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
      // 1- connect metamask
      let account;
        const result = async() => {

            if(window.ethereum !== "undefined"){
                const accounts = await ethereum.request({method: "eth_requestAccounts"});
                account = accounts[0];
                const ABI = [
                  {
                    "inputs": [
                      {
                        "internalType": "int256",
                        "name": "_id",
                        "type": "int256"
                      }
                    ],
                    "name": "map",
                    "outputs": [],
                    "stateMutability": "nonpayable",
                    "type": "function"
                  },
                  {
                    "inputs": [],
                    "stateMutability": "nonpayable",
                    "type": "constructor"
                  },
                  {
                    "inputs": [
                      {
                        "internalType": "int256",
                        "name": "_id",
                        "type": "int256"
                      }
                    ],
                    "name": "voteCandiA",
                    "outputs": [],
                    "stateMutability": "nonpayable",
                    "type": "function"
                  },
                  {
                    "inputs": [
                      {
                        "internalType": "int256",
                        "name": "_id",
                        "type": "int256"
                      }
                    ],
                    "name": "voteCandiB",
                    "outputs": [],
                    "stateMutability": "nonpayable",
                    "type": "function"
                  },
                  {
                    "inputs": [
                      {
                        "internalType": "int256",
                        "name": "",
                        "type": "int256"
                      }
                    ],
                    "name": "idToVoteCount",
                    "outputs": [
                      {
                        "internalType": "bool",
                        "name": "",
                        "type": "bool"
                      }
                    ],
                    "stateMutability": "view",
                    "type": "function"
                  },
                  {
                    "inputs": [],
                    "name": "viewVotes",
                    "outputs": [
                      {
                        "internalType": "int256",
                        "name": "",
                        "type": "int256"
                      },
                      {
                        "internalType": "int256",
                        "name": "",
                        "type": "int256"
                      }
                    ],
                    "stateMutability": "view",
                    "type": "function"
                  }
                ];
                const Address = "0xC093C5e3dD309c3e14aa4A08962BDf250Dc550B3";
                window.web3 = await new Web3(window.ethereum);
                window.contract = await new window.web3.eth.Contract(ABI, Address);
                const data = await window.contract.methods.viewVotes().call();
                const {0: a, 1: b} = data;
                document.getElementById("resultArea").innerHTML = `Candidate A = ${a}`;
                document.getElementById("resultArea2").innerHTML = `Candidate B = ${b}`;
            }			
        }
    </script>
  </body>
</html>
</html>
</body>
</html>