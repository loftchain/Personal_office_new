<?php

namespace App\Exceptions;

use App\Models\InvestorPersonalFields;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $investor = Auth::user();
        $personal = InvestorPersonalFields::where('investor_id', $investor['id'])->first();
        $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        date_default_timezone_set('Europe/Moscow');

        $send_obg = [
            'error_message' => '[ ' . $exception->getMessage() . ' ]',
            'code' => '**Code: **' . app('Illuminate\Http\Response')->status(),
            'path' => '**Path: **' . $exception->getFile(),
            'line' => '**Line: **' . $exception->getLine(),
            'url' => '**URL: **' . $url,
            'user_id' => '**investor_id: **' . $investor['id'],
            'email' => '**email: **' . $investor['email'],
            'name' => '**name: **' . $personal['name_surname'],
            'phone' => '**phone: **' . $personal['phone'],
            'telegram_login' => '**telegram_login: **' . $personal['telegram'],
            'ip' => '**ip: **' . $_SERVER['REMOTE_ADDR'],
            'user_agent' => '**user_agent: **' . $request->header('User-Agent'),
            '**-----------------------------------------------------------------------------------------------------------**',
        ];

        if (env('APP_ENV') !== 'local') {
            $str = implode("\n", $send_obg);
            $client = new Client();
            if (
                $exception->getMessage() !== 'Unauthenticated.' &&
                $send_obg['error_message'] != '[ The given data was invalid. ]' &&
                strpos($send_obg['url'], 'apple') == false &&
                strpos($send_obg['url'], 'glyphicon') == false &&
                strpos($send_obg['url'], 'assetlinks.json') == false &&
                strpos($send_obg['url'], '.map') == false &&
                strpos($send_obg['url'], 'misc.js') == false
            ) { // If someone didn`t pass the validation process of any form.
                try {
                    $client->request('POST', 'https://discordapp.com/api/webhooks/513770864169320448/dw-iDdbskx5NNcB4UcZWxKuOtRDlNFBT6WjsuNYOuO5rYdofLYzNuvqRh6Cq4foWR4Tv', [
                        'json' => [
                            'content' => $str,
                        ]
                    ]);
                } catch (GuzzleException $e) {
                }

            }
        }

        return parent::render($request, $exception);
    }
}
