<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (Schema::hasTable('mails')) {
            $mail = DB::table('mails')->first();

            if ($mail) //checking if table is not empty
            {
                Config::set('mail.mailers.smtp.host', $mail->host);
                Config::set('mail.mailers.smtp.port', $mail->port);
                Config::set('mail.mailers.smtp.encryption', $mail->encryption);
                Config::set('mail.mailers.smtp.username', $mail->username);
                Config::set('mail.mailers.smtp.password', $mail->password);
                Config::set('mail.from', array('address' => $mail->from_address, 'name' => $mail->from_name));
            }
        }
    }
}
