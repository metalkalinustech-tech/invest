<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposite</title>
        <link rel="icon" href="images/header/logo2.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body style="background-color: rgb(14, 7, 7);">
    <div class="container mt-5">
        <div class="header-wrap" style="border-bottom: 1px solid #a7c7e0; font-weight: bold"><h2 class="text-info ">Deposite</h2>
        <p class="text-warning" style="cursor: pointer;" title="Close" onclick="window.history.back()"><i class="bi bi-x-circle-fill h3 close-btn"></i></p>
        </div><br>

        <!-- select payment method -->
        <h5 class="text-light">Select payment method to add funds into your Account</h5>
        <div class="payment-methods mt-4">
            <div class="method mb-3 p-5 bg-dark rounded" id="method">
                <div class="row">
                    <div id="conTextWrap"></div>
                    <div class="col-sm" id="methodCol">
                        <h4 class="text-info">Select Payment Method</h4><br><br>
                        <div class="buttons d-flex flex-column gap-4"style="max-width: 300px;"> 
                        <button class="btn p-3 deposit-btn" title="Deposit via Bank Transfer"> <i class="bi bi-bank"></i> Deposit via Bank Transfer</button> 
                        <button class="btn p-3 deposit-btn" title="Deposit Crypto" onclick="showCryptoInfo()"> <i class="bi bi-wallet2"></i> Deposit Crypto</button>  
                        </div> 
                    </div>
                    <div class="col-sm justify-content-center d-flex align-items-center mt-5" id="cryptoInfo">
                        <p class="text-dark bg-light p-3 rounded">Payment method is not selected <i class="bi bi-slash-circle"></i></p>
                    </div>
            </div>
            </div>
        </div>

    </div>


    <style>
        .header-wrap{
            display:flex;
            justify-content: space-between;
            align-items: center;
            padding:5px;
        }
        .close-btn{
            color: #fcee70ee;
        }
        .close-btn:hover{
            color: #fcee70;
        }
        .deposit-btn{
            background-color: #398db8;
            font-weight: bold;
            color: #fff;
            box-shadow: 0px 0px 3px 3px #201f1f;
            transition: background-color 0.3s ease;
        }
        .deposit-btn:hover{
            background-color: #6ec4f0;
            color: #464444;
            box-shadow: none;
        }
        .scan_img{
            margin-top: 20px;
            width: 250px;
            height: 250px;
        }
        .coin-type{
            text-transform: uppercase;
            color: #f0c134;
        }
        .select-tag{
            width: 250px;
            font-weight: bold;
        }   
        .coin-text{
            display:flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }
        #conTextWrap{
            padding: 5px;
            margin:0;
        }
    </style>


<script>

    function Amount(){
                    var amount = '<div class="crypto-wrap">'+
                    '<p class="text-warning"> <i class="bi bi-check2-circle"></i> Enter Amounts </p>'+
                    '<input type="text" oninput="showCryptoInfo()" name="amount" class="form-control p-3" placeholder="Amount"/>'+'</div>';
                    document.getElementById('cryptoInfo').innerHTML = amount;
    }

    /*function amount_limit(){
        if(this.value.length>4){
            document.getElementById('network').disabled='none';
        }
    }*/
    function showCryptoInfo(){
        var cryptos = '<div class="crypto-wrap">'+
                    '<p class="text-warning"> <i class="bi bi-check2-circle"></i> Enter $Amounts </p>'+
                    '<input type="number" required name="amount" class="form-control p-3" placeholder="$1000" id="amounts"/>'+
                    '<p class="text-warning mt-2"> <i class="bi bi-check2-circle"></i> Crypto Currency </p>'+
                    '<select onchange="showCryptoAddress(this.value)" class="form-control select-tag p-3 bg-light text-dark border-0" id="network">'+
                    '<option selected disable >Click to Select </option>'+
                    '<option value="bitcoin">Bitcoin (BTC)</option>'+
                    '<option value="usdt">Dollar (USDT)</option>'+
                    '<option value="ethereum">Ethereum (ETH)</option>'+
                    '</select>'+
                '</div>';
        document.getElementById('cryptoInfo').innerHTML = cryptos;
        }
        
        function showCryptoAddress(coin_type){
            var deposit_amount = document.getElementById('amounts').value;
            var bitcoin = {
                "scan":"address/btc-scan.jpg",
                "id":"13GkjgTr626taRJpjCx8YEJXHXirYdgBUb"
            };
            var usdt = {
                "scan":"address/usdt-trc20-scan.jpg",
                "id":"TEnGtM9cqhw6vGTxbowgSjNFk37XQ5wDzc"
            };
            var ethereum = {
                "scan":"address/ethereum-erc20-scan.jpg",
                "id":"0x8ebb83d3e1301a6f7a795a84c8b6c839fcbe5303"
            };

            var crypto_address = '';

            if(deposit_amount == ''){
                alert("please enter Amount!");
                return;
            }else if(deposit_amount<500){
                alert('Please your minimum deposit amount is $500 above!');
                return;
            }else{
                if(coin_type === 'bitcoin'){
                crypto_address = bitcoin;
            } else if(coin_type === 'usdt'){
                crypto_address = usdt;
            } else if(coin_type === 'ethereum'){
                crypto_address = ethereum;
            }
            }

         
            var coinText =  '<h3 class="text-white coin-text"><p> Deposit <span class="coin-type">'+'$'+ deposit_amount +' '+coin_type +'</span> into your VirexaTrust </p> <p class=""></p></h3>';
            var cryptoAddress = '<div class="text-light">'+' <p> <img src="' + crypto_address.scan + '" class="scan_img"> </p>' +'<p class="mt-2 d-flex justify-content align-items-center gap-3">'+ '<span id="cryptoIdCopy">'+ crypto_address.id +'</span>'+'<button onclick="copyText()" class="btn btn-light text-dark btn-sm" title="Copy"><i class="bi bi-copy"></i> Copy</button> <a href="' + crypto_address.scan + '" download="'+coin_type+'-scan.jpg"><button class="btn btn-light text-dark btn-sm copy-btn"  title="Save"><i class="bi bi-save"></i> Save</button></a></p>'+ '</div>';
            
            var complete = '<div> <h4 class="m-2 p-2 text-light border-0"><span class="text-danger">(Optional)</span>Upload payment proof</h4> <form class="form-control p-3 bg-dark text-light border-0" action="deposit_config.php" method="POST" enctype="multipart/form-data"><input type="hidden" value="'+deposit_amount+'" name="amount" required/><input type="file" class="form-control bg-dark text-light border-0" accept="image/*" name="reciept_img" required></br><button class="btn btn-success" name="deposit_btn">Complete Payment</button></form></div>';
            
            console.log(cryptoAddress);
            document.getElementById('conTextWrap').innerHTML = coinText;
            document.getElementById('methodCol').innerHTML = cryptoAddress;
            document.getElementById('cryptoInfo').innerHTML = complete;
            document.getElementById('cryptoInfo').style.backgroundColor = '#000';
            document.getElementById('cryptoInfo').style.borderRadius = '10px';
        }

        // Add event listener for copy button address
            function copyText() {
                var textToCopy = document.getElementById('cryptoIdCopy').textContent;
                navigator.clipboard.writeText(textToCopy).then(function() {
                    alert('Crypto address copied to clipboard!');
                }, function(err) {
                    console.error('Could not copy text: ', err);
                });
            };
            
</script>
</body>
</html>