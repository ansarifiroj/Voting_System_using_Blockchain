<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Metamask connection</title>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.2.7-rc.0/web3.min.js"></script>
        <style> 
			body {
				background-color: #f0f0f0; /* Set the background color */
			}
            button {
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
            button:hover {
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
                -webkit-transform: scale(1.1);
                transform: scale(1.1);
            }
        </style>
    </head>
<body>
    <?php require 'partials/_nav.php'?>
    <button onclick="connectMetamask()" style="position: absolute; top: 100px; left: 700px;">connect to metamask</button><br>
    <p id="contractArea" style="position: absolute; top: 225px; left: 700px;"></p>

    <button onclick="voteA()" style="position: absolute; top: 350px; left: 575px;">Candidate A</button>

    <button onclick="voteB()" style="position: absolute; top: 350px; left: 825px;">Candidate B</button>

    <p id="voteArea" style="position: absolute; top: 455px; left: 760px;"></p>

    <button onclick="result()" style="position: absolute; top: 525px; left: 700px;">View Result</button><br>
    <p id="resultArea" style="position: absolute; top: 625px; left: 735px;"></p>
    <p id="resultArea2" style="position: absolute; top: 665px; left: 735px;"></p>


    <script>
        // 1- connect metamask
        let account;
        const connectMetamask = async() => {

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
				document.getElementById("contractArea").innerHTML = "CONNECTED TO METAMASK <br> NOW YOU CAN VOTE";
            }
			
        }       

        //3-read data from smart contract
        const voteA = async () => {
            <?php
                include "partials/_dbconnect.php";
                $userID = $_SESSION['userID'];
              
                $sql = "UPDATE voting_data SET status = 1 WHERE ID = '$userID'";
                mysqli_query($conn, $sql);
            ?>
            await window.contract.methods.voteCandiA(<?php echo $_SESSION['userID']?>).send({ from: account});
            document.getElementById("voteArea").innerHTML = "Voted to A";
        }
        const voteB = async () => {
            <?php
                include "partials/_dbconnect.php";
                $userID = $_SESSION['userID'];
              
                $sql = "UPDATE voting_data SET status = 1 WHERE ID = '$userID'";
                mysqli_query($conn, $sql);
            ?>
            await window.contract.methods.voteCandiB(<?php echo $_SESSION['userID']?>).send({ from: account});
            document.getElementById("voteArea").innerHTML = "Voted to B";
        }
        const result = async () => {
            const data = await window.contract.methods.viewVotes().call();
            const {0: a, 1: b} = data;
            document.getElementById("resultArea").innerHTML = `Candidate A = ${a}`;
            document.getElementById("resultArea2").innerHTML = `Candidate B = ${b}`;
        }
    </script>
</body>
</html>