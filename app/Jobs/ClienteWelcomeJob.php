<?php

namespace App\Jobs;

use App\Mail\ClienteWelcomeEmail;
use App\Models\Cliente\Cliente;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ClienteWelcomeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Cliente $cliente,
        public string $senha
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->cliente->email)
            ->send(new ClienteWelcomeEmail(
                $this->cliente,
                $this->senha
            ));
    }
}
