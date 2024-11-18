<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;
use App\Mail\PHPMailerService;

class CompletePendingTransactions extends Command
{
    protected $signature = 'transactions:complete-pending';
    protected $description = 'Automatically completes pending transactions';
    protected $mailer;

    public function __construct(PHPMailerService $mailer)
    {
        parent::__construct();
        $this->mailer = $mailer; // Initialize PHPMailerService
    }

    public function handle()
{
    Log::info('Starting the command to process pending transactions.');

    // Find transactions that are still pending
    $pendingTransactions = Transaction::where('status', 'Pending')->get();

    Log::info('Number of pending transactions found: ' . $pendingTransactions->count());

    foreach ($pendingTransactions as $transaction) {
        Log::info('Processing transaction ID: ' . $transaction->transaction_id);

        // Check if the transaction has an associated user
        if ($transaction->user) {
            Log::info('Transaction ID ' . $transaction->transaction_id . ' has a user associated.');

            // Update transaction status to completed
            $transaction->update(['status' => 'Completed']);
            Log::info('Transaction status updated to Completed for transaction ID: ' . $transaction->transaction_id);

            // Send email notification using PHPMailerService
            $to = $transaction->user->email;
            $subject = "Your Payment has been Successfully Completed";
            $body = "Dear {$transaction->user->username},<br><br>
                      Your payment for Transaction ID {$transaction->transaction_id} has been completed successfully.<br><br>
                      Thank you for your purchase!";

            if ($this->mailer->sendEmail($to, $subject, $body)) {
                Log::info('Transaction email sent successfully to ' . $to);
            } else {
                Log::error('Failed to send transaction email to ' . $to);
            }

        } else {
            // Log an error about the missing user relationship
            Log::error('Transaction ID ' . $transaction->transaction_id . ' does not have an associated user.');
        }

        // Log transaction completion
        Log::info('Transaction completed automatically for transaction ID: ' . $transaction->transaction_id);
    }

    $this->info('Pending transactions have been processed.');
}

}