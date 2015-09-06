<?php
session_start();
include_once '../model/payment.php';
$payment = new payment(340, "USD");
$_SESSION['$payment'] = $payment;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="ISO-8859-1">
        <title>Checkout</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" >
    </head>
    <body>
        <div class="container-fluid">
            <h1>Checkout</h1>
            <form id="form-payment">
                <div class="form-group control-group">
                    <label for="exampleInputEmail1">First name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First name" maxlength="45" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Last name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last name" maxlength="45" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Credit card number</label>
                    <input type="number" class="form-control" id="creditCardNumber" name="creditCardNumber" placeholder="Credit card number" max="9999999999999999" min="0" required>
                </div>
                <div class="form-group">
                    <label>
                        Expiry date
                        <div class="">
                            <div style="float: left">
                                <select class="form-control" id="expiration_month" name="expiration_month">
                                    <option value="-1">-</option>
                                    <option data-code="1" value="1">01</option>
                                    <option data-code="2" value="2">02</option>
                                    <option data-code="3" value="3">03</option>
                                    <option data-code="4" value="4">04</option>
                                    <option data-code="5" value="5">05</option>
                                    <option data-code="6" value="6">06</option>
                                    <option data-code="7" value="7">07</option>
                                    <option data-code="8" value="8">08</option>
                                    <option data-code="9" value="9">09</option>
                                    <option data-code="10" value="10">10</option>
                                    <option data-code="11" value="11">11</option>
                                    <option data-code="12" value="12">12</option>
                                </select>
                            </div>
                            <div style="float: right">
                                <select class="form-control" id="expiration_year" name="expiration_year">
                                    <option value="-1">-</option>
                                    <option value="15">2015</option><option value="16">2016</option><option value="17">2017</option><option value="18">2018</option><option value="19">2019</option><option value="20">2020</option><option value="21">2021</option><option value="22">2022</option><option value="23">2023</option><option value="24">2024</option><option value="25">2025</option><option value="26">2026</option><option value="27">2027</option><option value="28">2028</option><option value="29">2029</option><option value="30">2030</option><option value="31">2031</option><option value="32">2032</option><option value="33">2033</option><option value="34">2034</option><option value="35">2035</option><option value="36">2036</option><option value="37">2037</option><option value="38">2038</option><option value="39">2039</option><option value="40">2040</option><option value="41">2041</option><option value="42">2042</option><option value="43">2043</option><option value="44">2044</option><option value="45">2045</option><option value="46">2046</option><option value="47">2047</option><option value="48">2048</option><option value="49">2049</option><option value="50">2050</option> 
                                </select>
                            </div>
                        </div>

                    </label>
                </div>
                <div class="form-group">
                    <label for="CCV">CCV</label>
                    <input type="number" class="form-control" id="ccv" name="ccv" placeholder="XXX" max="999" min="0" required>
                </div>

                <label for="Amount">Amount</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="amount" name="amount" disabled value="<?php echo ($payment->getAmount()); ?>">
                    <div class="input-group-addon"></div>
                    <select class="form-control" id="currency">
                        <option data-symbol="$" data-code="USD" value="1">USD</option>
                        <option data-symbol="?" data-code="EUR" value="1.123">EUR</option>
                    </select>
                </div>
                <div class="form-group">
                </div>
                <div class="input-group">
                    <button type="submit" id="pay" name="pay" class="btn btn-primary ">Pay</button>
                </div>                
            </form>
        </div>
        <div id="result"></div>
        <?php
        ?>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#pay").click(function (event) {
                    event.preventDefault();
                    console.log(checkInput());
                    if (checkInput()) {
                        sendPayment();
                    }

                });
                $("#currency").on('change', function () {
                    $.get("http://www.andreseloysv.com/epg/controller/updatecurrency.php", {currencyName: $("#currency option:selected").text()}).done(function (data) {
                        console.log(data);
                        $("#amount").val(data.toString());
                    });
                });
            });
            function sendPayment() {
                var firstName, lastName, creditCardNumber, ccv, expiration_month, expiration_year, amount;
                firstName = btoa($("#firstName").val());
                lastName = btoa($("#lastName").val());
                creditCardNumber = btoa($("#creditCardNumber").val());
                ccv = btoa($("#ccv").val());
                expiration_month = btoa($("#expiration_month option:selected").text());
                expiration_year = btoa($("#expiration_year option:selected").text());
                amount = btoa($("#amount").val());
                $.post("http://www.andreseloysv.com/epg/controller/sendPayment.php", {firstName: firstName, lastName: lastName, creditCardNumber: creditCardNumber, ccv: ccv, expiration_month: expiration_month, expiration_year: expiration_year, amount: amount}).done(function (data) {
                    console.log(data);
                    $("#result").html(data);
                });
            }
            function checkInput() {
                var result = true;
                $("input").each(function () {
                    if ($(this).val() === "") {
                        result = false;
                        $("#result").html("<div style='color: red;font-weight: bold;font-size: medium;padding: 15px;'>This field is required: " + $(this).attr("name") + "</div>");
                    }
                });
                if ($("#expiration_month").val() == -1) {
                    result = false;
                    $("#result").html("<div style='color: red;font-weight: bold;font-size: medium;padding: 15px;'>This field is required: Expiration month</div>");
                } else if ($("#expiration_year").val() == -1) {
                    result = false;
                    $("#result").html("<div style='color: red;font-weight: bold;font-size: medium;padding: 15px;'>This field is required: Expiration year</div>");
                }

                return result;
            }
        </script>
    </body>
</html>