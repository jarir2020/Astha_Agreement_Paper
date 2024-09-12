<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agreement Form</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .hidden {
            display: none;
        }
        .read-only {
            pointer-events: none;
            opacity: 0.5;
        }
    </style>
</head>

<body style="margin: 0; padding: 0;">
@if(session('success'))
    <div id="success-alert" class="alert alert-success show">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div id="error-alert" class="alert alert-danger show">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="container">
        <img src="{{ asset('image/banner.png') }}" width="101%" style="margin-top:-20px; margin-right:-5px"></img>
        <h1 style="text-align: center;">Agreement Papers</h1>
        <form action="{{ route('agreement.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <section class="client-info">
                <h2>Client Info</h2>
                <label>Name: <input type="text" placeholder="Your Name(max:255)" name="client_name" required></label>
                <label>Address: <input type="text" placeholder="Your Address(max:255)" name="client_address" required></label>

                <style>
                    .email-transactions{
                        display: flex;
                        gap:2px;
                    }
                    .email-input-container{
                        width: 580px;
                        height: 30px;
                    }
                    @media (min-width: 768px) {
                        .email-transactions{
                            display: flex;
                            gap:30px;
                        }
                        .email-input-container{
                            width: 600px;
                            height: 30px;
                        }
                    }
                </style>

                <label>Phone: <input type="text" name="client_phone" placeholder="Phone(max:20)" class="email-input-container" required></label>
                <label>Email: <input type="email" name="client_email" placeholder="Email" class="email-input-container" required></label>

            </section>
        <section class="project-info">
            <h2>Project Info:</h2>
            <label for="project_name">Project Name:(max:100)</label>
            <input type="text" id="project_name" name="project_name" required>

            <label for="project_type">Type of Project:(max:255)</label>
            <input type="text" id="project_type" name="project_type" required>

            <div style="display: flex; gap:20px;">
            <label for="project_start_date">Start Date:</label>
            <input type="date" id="project_start_date" name="project_start_date" style="width: 580px; height: 30px;" required>

            <label for="project_delivery_date">Delivery Date:</label>
            <input type="date" id="project_delivery_date" name="project_delivery_date" style="width: 580px; height: 30px;" required>

            </div>
            <style>
                .media-fonts{
                    margin-top: 20px;
                }
                @media (max-width: 767px) {
                    .media-fonts{
                        margin-top: 20px;
                        font-size:10px;
                    }
                }
            </style>
            <div style="display:flex;gap:20px; font-size:17px;">
                <h5>Attachment of Documents:(max:20mb)</h5>
                <label  class="media-fonts">
                    <input type="checkbox" name="documents[]" value="NID"> NID
                </label>
                <label  class="media-fonts">
                    <input type="checkbox" name="documents[]" value="Passport"> Passport
                </label>
                <label  class="media-fonts">
                    <input type="checkbox" name="documents[]" value="Driving License"> Driving License
                </label>
            </div>
                <label style="margin-top: -5px; font-size:14px;">
                    Upload(Image or Document, multiple allowed):
                    <input type="file" name="document_file[]" accept=".bmp,.jpg,.jpeg,.png,.gif,.doc,.docx,.pdf,.xps" multiple>
                </label>

            <label for="quotation_confirmation">Undertaking that I speak to Astha Insight and get their quotation and documentation and confirm my work with them:</label>
            <input type="text" placeholder="Write Yes I agree if you agree"  id="quotation_confirmation" name="quotation_confirmation" required>

            <label for="total_amount">I agree to abide by all the terms and conditions of Astha Insight Total:</label>
            <input type="text" id="total_amount" name="total_amount" placeholder="$ $" required>

            <label for="advance_amount">Today Total as Advance:</label>
            <input type="text" id="advance_amount" name="advance_amount" placeholder="$ $" required>

            <label for="payment_method">Sent by cash/bank/mobile banking:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="">Select...</option>
                <option value="cash">Cash</option>
                <option value="bank">Bank</option>
                <option value="mobile_banking">Mobile Banking</option>
            </select><br><br>

            <label for="remaining_project_amount">I will take the project with the time to take delivery of the remaining:</label>
            <input type="text" id="remaining_project_amount" name="remaining_project_amount" placeholder="$ $" required>
        </section>

            <section id="cash-transaction" class="transaction-info hidden">
                <h2>Cash Transaction</h2>
                <div style="display: flex; gap:7px; ">
                    <label style="width: 590px; height: 30px;">From: <input type="text" name="cash_transaction_name"></label>
                    <label style="width: 590px; height: 30px;">To: <input type="text" name="cash_transaction_to"></label>
                </div>
            </section>

            <section id="bank-transaction" class="transaction-info hidden">
                <h2 class="bank-container">Bank Transaction</h2>
                <div class="bank-transactions">
                    <label>Bank Name: <input type="text" class="bank-input-container" name="bank_name"></label>
                    <label>Account Number: <input type="text" class="bank-input-container" name="account_number"></label>
                    <label>Transaction ID: <input type="text" class="bank-input-container" name="bank_transaction_id"></label>
                </div>
            </section>

            <section id="mobile-banking" class="transaction-info hidden">
                <h2>Mobile Banking Transactions</h2>
                <div style="display: flex; gap:5px;">
                    <label style="width: 580px; height: 30px;">Select One:
                        <select name="mobile_banking">
                            <option value="bkash">Bkash</option>
                            <option value="nogod">Nogod</option>
                            <option value="rocket">Rocket</option>
                            <option value="upay">Upay</option>
                        </select>
                    </label>
                    <label style="width: 580px; height: 30px;">Transaction ID: <input type="text" name="mobile_banking_id"></label>
                </div>
            </section>
            <center><button type="submit" style="margin-top:40px;">Submit</button></center>
        </form>
        <hr>
        <center><img src="{{ asset('image/footer.png') }}" width="101%" style="margin-top:1px;margin-bottom:-20px;margin-left:-35px;margin-right:-35px;"></img></center>
    </div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
