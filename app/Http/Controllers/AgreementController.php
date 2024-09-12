<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agreement;
use Illuminate\Support\Facades\File;
use PDF;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AgreementController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_address' => 'required|string|max:255',
            'client_phone' => 'required|string|max:20',
            'client_email' => 'required|email|max:255',
            'project_name' => 'required|string|max:100',
            'project_type' => 'required|string|max:255',
            'project_start_date' => 'required|date',
            'project_delivery_date' => 'required|date',
            'quotation_confirmation' => 'required|string|max:255',
            'total_amount' => 'required|numeric',
            'advance_amount' => 'required|numeric',
            'payment_method' => 'required|string|in:cash,bank,mobile_banking',
            'remaining_project_amount' => 'required|numeric',
            'documents' => 'nullable|array',
            'document_file.*' => 'nullable|mimes:jpg,jpeg,pdf,png,bmp,gif,xps,doc,docx|max:20480',
            'cash_transaction_name' => 'nullable|string|max:255',
            'cash_transaction_to' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'mobile_banking' => 'nullable|string|in:bkash,nogod,rocket,upay',
            'bank_transaction_id' => 'nullable|string|max:255',
            'mobile_banking_id' => 'nullable|string|max:255',
        ]);

        $agreement = new Agreement();
        $agreement->client_name = $validated['client_name'];
        $agreement->client_address = $validated['client_address'];
        $agreement->client_phone = $validated['client_phone'];
        $agreement->client_email = $validated['client_email'];
        $agreement->project_name = $validated['project_name'];
        $agreement->project_type = $validated['project_type'];
        $agreement->project_start_date = $validated['project_start_date'];
        $agreement->project_delivery_date = $validated['project_delivery_date'];
        $agreement->quotation_confirmation = $validated['quotation_confirmation'];
        $agreement->total_amount = $validated['total_amount'];
        $agreement->advance_amount = $validated['advance_amount'];
        $agreement->payment_method = $validated['payment_method'];
        $agreement->remaining_project_amount = $validated['remaining_project_amount'];
        $agreement->cash_transaction_name = $validated['cash_transaction_name'];
        $agreement->cash_transaction_to = $validated['cash_transaction_to'];
        $agreement->bank_name = $validated['bank_name'];
        $agreement->account_number = $validated['account_number'];
        $agreement->bank_transaction_id = $validated['bank_transaction_id'];
        $agreement->mobile_banking = $validated['mobile_banking'];
        $agreement->mobile_banking_id = $validated['mobile_banking_id'];
        $agreement->save();

        $documentPaths = [];
        if ($request->hasFile('document_file')) {
            $folderPath = public_path("uploads/agreements/{$agreement->id}");

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
            }

            foreach ($request->file('document_file') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($folderPath, $filename);
                $documentPaths[] = "uploads/agreements/{$agreement->id}/{$filename}";
            }
        }


        $allDocuments = $validated['documents'] ?? [];
        $allDocuments = array_merge($allDocuments, $documentPaths);


        $agreement->documents = !empty($allDocuments) ? json_encode($allDocuments) : null;

        $agreement->save();


        $pdf = PDF::loadView('pdfs', ['data' => $validated])
        ->setPaper('A4', 'portrait')
        ->setOption('margin-left', 0)
        ->setOption('margin-right', 0)
        ->setOption('margin-top', 0)
        ->setOption('margin-bottom', 0);

        $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = env('MAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = env('MAIL_PORT');
        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->addAddress($validated['client_email']);
        $mail->isHTML(true);
        $mail->Subject = 'Thank You for Contacting Us';
        $mail->Body = 'Thank you for contacting us. Your agreement has been successfully processed.';
        $mail->send();
    } catch (Exception $e) {

    }

        return $pdf->download('agreement.pdf');
    }
}
