<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agreement Form</title>
    <link href="https://fonts.cdnfonts.com/css/writing-signature" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}">
</head>

<body style="margin: 0; padding: 0;">
    <div class="container">
        <img src="{{ public_path('image/banner.png') }}" style="width: 100%; height: auto;"></img>
        <h1 style="text-align: center;">Agreement Papers</h1>
            <section class="client-info">
                <h2>Client Info:</h2>
                <label><b>Name:</b> {{ $data['client_name'] }}</label>
                <label><b>Address:</b> {{ $data['client_address'] }}</label>

                <style>
                    @font-face {
                        font-family: 'signature';
                        src: url('{{ asset('css/signature.otf')}}') format('opentype');
                    }

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

                        .footer-container {
                            position: relative;
                            text-align: center;
                            width: 100%;
                        }

                        .footer-image {
                            width: 75%;
                            height: auto;
                        }

                        .client-name {
                            position: absolute;
                            bottom: 20px; /* Adjust the bottom value as needed */
                            left: 50%;
                            transform: translateX(-50%);
                            background-color: rgba(255, 255, 255, 0.5); /* Optional: add a semi-transparent background for better readability */
                            padding: 5px;
                            border-radius: 3px;
                            color: black; /* Adjust text color for better readability */
                            font-size: 16px; /* Adjust font size as needed */
                        }

                </style>

                <label><b>Phone:</b> {{ $data['client_phone'] }}</label>
                <label><b>Email:</b> {{ $data['client_email'] }}<label>


            </section>
        <section class="project-info">
            <h2>Project Info:</h2>
            <label for="project_name"><b>Project Name:</b> {{ $data['project_name'] }}</label>
            <label for="project_type"><b>Type of Project:</b> {{ $data['project_type'] }}</label>

            <div style="display: flex; gap:20px;">
            <label for="project_start_date"><b>Start Date:</b> {{ $data['project_start_date'] }}</label>

            <label for="project_delivery_date"><b>Delivery Date:</b> {{ $data['project_delivery_date'] }}</label>

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

            <label for="quotation_confirmation">Undertaking that I speak to Astha Insight and get their quotation and documentation and confirm my work with them:<b> {{ $data['quotation_confirmation'] }}</b> I agree to abide by all the terms and conditions of Astha Insight. Total: <b>${{ $data['total_amount'] }}.</b>Today Total as Advance: <b>${{ $data['advance_amount'] }}.</b>I will take the project with the time to take delivery of the remaining: <b>${{ $data['remaining_project_amount'] }}.</b> </label>
        </section>

            <section class="transaction-info">
                @if($data['payment_method'] == 'cash')
                <h2>Cash Transaction</h2>
                <div style="display: flex; gap:7px; ">
                <label style="width: 590px; height: 30px;"><b>From:</b> {{ $data['cash_transaction_name'] }}
                <label style="width: 590px; height: 30px;"><b>To:</b> {{ $data['cash_transaction_to'] }}
                </div>
                @elseif($data['payment_method'] == 'bank')
                <style>
                    .bank-transactions{
                        display: flex;
                        gap:3px;
                    }
                    .bank-input-container{
                        width: 590px;
                        height: 30px;
                    }
                    @media (min-width: 768px) {
                        .bank-transactions{
                            display: flex;
                            gap:30px;
                        }
                        .bank-input-container{
                            width: 600px;
                            height: 30px;
                        }
                    }
                </style>
                <h2 class="bank-container">Bank Transaction</h2>
                <div class="bank-transactions">
                <label><b>Bank Name:</b> {{ $data['bank_name'] }}</label>
                <label><b>Account Number:</b> {{ $data['account_number'] }}</label>
                <label><b>Transaction ID:</b> {{ $data['bank_transaction_id'] }}</label>
                </div>
                @elseif($data['payment_method'] == 'mobile_banking')
                <h2>Mobile Banking Transactions</h2>
                <div style="display: flex; gap:5px;">
                <label style="width: 580px; height: 30px;"><b>Mobile Banking Service:</b> {{ $data['mobile_banking'] }}</label>
                <label style="width: 580px; height: 30px;"><b>Transaction ID:</b> {{ $data['mobile_banking_id'] }}</label>
                @endif
            </div>
            </section>

         @if (!empty($data['documents']) && count($data['documents']) > 0)
            <section>
                <h2 style="margin-block: 10px;">Attached Documents</h2>
                <div>
                    <ul>
                        @foreach($data['documents'] as $document)
                                <li>{{ basename($document) }}</li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif

        <section>
        <hr>
        <center><img src="{{ public_path('image/footer_pdf.png') }}" style="width: 75%; height: auto;" />
            <p style="font-family: 'signature', sans-serif; position: relative; margin-top:-140px; margin-left:-15px;">{{ $data['client_name'] }}</p>
            </p></center>
        </section>
    </div>

</body>
</html>

