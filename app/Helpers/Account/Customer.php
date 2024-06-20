<?php

namespace App\Helpers\Account;

use App\Events\SendEmailConfirmRestorePassword;
use App\Events\SendEmailRestorePassword;
use App\Events\SendMailIndex;
use App\Helpers\System\CoreHttp;
use App\Models\CustomersAccount;
use App\Models\Mailing;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helpers\SendMail;
use App\Helpers\SendMailMasive;
use App\Models\MailingCustomer;
use App\Models\MailingIndex;
use App\Models\PasswordReset;
use App\Models\WebSiteCustomer;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;

class Customer
{
    protected $coreHttp;

    public function __construct(CoreHttp $coreHttp)
    {
        $this->coreHttp = $coreHttp;
    }

    public function closeSession(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                $this->removeCookie("customer_backend");
                return [];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function removeCookie(string $key)
    {
        unset($_COOKIE[$key]);
    }

    public function setCookie(string $key, string $value)
    {
        $_COOKIE[$key] = $value;
    }

    public function getCustomerInformation(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                return $this->getCustomerArrayByEncryption($header["customer-key"][0]);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function customerValidateLogin(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($body) {
                $this->validateLoginParams($body);
                return $this->validateLoginAccount($body["mail"], $body["password"]);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function customerResetPassword(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($body) {
                $this->validateResetPasswordParams($body);
                return [];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    private function executeWithValidation(callable $callback, string $successMessage)
    {
        try {
            $result = $callback();
            return $this->coreHttp->constructResponse($result, $successMessage, 200, true);
        } catch (Exception $e) {
            return $this->coreHttp->constructResponse([], $e->getMessage(), 500, false);
        }
    }

    private function validateCustomerKey(array $header)
    {
        if (
            !isset($header["customer-key"]) ||
            !is_array($header["customer-key"]) ||
            count($header["customer-key"]) === 0
        ) {
            throw new Exception("Parametros no validos.");
        }

        $this->validateCustomerEncryption($header["customer-key"][0]);
    }

    private function validateLoginParams(array $body)
    {
        if (!isset($body["password"]) || !isset($body["mail"])) {
            throw new Exception("Parametros no validos.");
        }
    }

    public function sendConfirmRestorePassword($email)
    {
        new SendMail("mail.reset-password", $email, "Restauracion de contraseña.", [
            "title" => "Contraseña restaurada",
            "footer_text" => "Felicidades tu contraseña ha sido restaurada exitosamente."
        ]);
    }

    public function sendEventRestorePassword($mail)
    {
        Event::dispatch(new SendEmailRestorePassword($mail));
    }

    public function sendEventConfirmRestorePassword($mail)
    {
        Event::dispatch(new SendEmailConfirmRestorePassword($mail));
    }

    public function proccessRestorePassword($email)
    {
        $token = Str::random(60);
        PasswordReset::updateOrCreate(
            ['email' => $email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        new SendMail("mail.confirmation-password", $email, "Restauracion de contraseña.", [
            "title" => "Restaura tu contraseña",
            "description" => "Haga clic aquí para restablecer la contraseña.",
            "footer_text" => "Si esto fue un error, simplemente ignora este correo electrónico y no pasará nada.",
            "token" => $token
        ]);
    }

    private function validateResetPasswordParams(array $body)
    {
        if (!isset($body["mail"])) {
            throw new Exception("Parametros no validos.");
        }

        $customer = $this->getCustomerByMail($body["mail"]);

        if ($customer == null) {
            throw new Exception("Customer no identificado.");
        }

        $this->sendEventRestorePassword($customer->mail);
    }

    public function getCustomerByMail(string $mail)
    {
        return CustomersAccount::where('mail', $mail)->first();
    }

    private function validateCustomerEncryption(string $keyEncryption)
    {
        $descryptionMail = $this->decrypt($keyEncryption);
        $customer = $this->getCustomerByMail($descryptionMail);

        if (is_null($customer)) {
            throw new Exception("Customer no identificado.");
        }

        return true;
    }

    private function getCustomerByEncryption(string $keyEncryption)
    {
        $descryptionMail = $this->decrypt($keyEncryption);
        $customer = $this->getCustomerByMail($descryptionMail);

        if (is_null($customer)) {
            throw new Exception("Customer no identificado.");
        }

        return $customer;
    }

    private function getCustomerArrayByEncryption(string $keyEncryption)
    {
        $customer = $this->getCustomerByEncryption($keyEncryption);
        return $this->entityCustomerArray($customer);
    }

    private function entityCustomerArray(CustomersAccount $customer)
    {
        $customerAccountInformation = $customer->customerAccountInformation;

        return [
            'mail' => $customer->mail,
            'status' => $customer->status,
            'first_name' => $customerAccountInformation->first_name,
            'last_name' => $customerAccountInformation->last_name,
            'phone_number' => $customerAccountInformation->phone_number,
            'company' => $customerAccountInformation->company
        ];
    }

    private function validateLoginAccount(string $mail, string $password)
    {
        $customer = $this->getCustomerByMail($mail);

        if ($customer && $customer->password === $this->encryptedPawd($password)) {
            $encryptKey = $this->encrypt($mail);
            $this->setCookie("customer_backend", $encryptKey);

            return ["message" => 'Inicio de sesión exitoso.', "status" => true, 'customer' => $encryptKey];
        }

        return ["message" => 'Credenciales no válidas.', "status" => false];
    }

    public function validateBodyMail(array $body)
    {
        $requiredFields = [
            'name',
            'description',
            'mail_template',
            'selectedIndex',
            'timeExecute',
            'previewMail'
        ];

        foreach ($requiredFields as $field) {
            if (!isset($body[$field]) || $body[$field] === null) {
                throw new Exception("Parametros no validos.");
            }
        }
    }

    public function getAllCustomerMailing(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header, $body) {
                $this->validateCustomerKey($header);

                if (!isset($body["mail-id"])) {
                    throw new Exception("Parametros no validos.");
                }

                $mail = $this->getMailById($body["mail-id"]);

                if ($mail == null) {
                    throw new Exception("El mail solicitado no existe.");
                }

                $allCustomers = [];

                foreach ($mail->allMailingIndex as $mailIndex) {
                    $listCustomer = [];

                    foreach ($mailIndex->allCustomers as $mailCustomer) {
                        $webSiteCustomer = $mailCustomer->customerWebSite;

                        $listCustomer[] = [
                            "sender" => $mailCustomer->sending,
                            "created_at" => $mailCustomer->created_at,
                            "customer" => [
                                "id" => $webSiteCustomer->id,
                                "name" => $webSiteCustomer->name,
                                "email" => $webSiteCustomer->email,
                                "phone_number" => $webSiteCustomer->phone_number
                            ]
                        ];
                    }

                    $allCustomers[] = [
                        "index" => $mailIndex->index->name,
                        "customers" => $listCustomer
                    ];
                }

                return $allCustomers;
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getMailQuery(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header, $body) {
                $this->validateCustomerKey($header);

                if (!isset($body["mail-id"])) {
                    throw new Exception("Parametros no validos.");
                }

                $mail = $this->getMailById($body["mail-id"]);
                $countUsers = 0;

                if ($mail == null) {
                    throw new Exception("El mail solicitado no existe.");
                }

                return [
                    "id" => $mail->id,
                    "name" => $mail->name,
                    "description" => $mail->description,
                    "run_date" => $mail->run_date,
                    "template" => $mail->template,
                    "preview" => $mail->preview_mail,
                    "indexes" => $this->getAllIndexNameMailData($countUsers, $mail->allMailingIndex),
                    "total_index" => $mail->allMailingIndex()->count() ?? 0,
                    "total_users" => $countUsers,
                    "total_send" => $mail->send,
                    "created_at" => $mail->created_at,
                    "updated_at" => $mail->updated_at
                ];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getAllIndexNameMailData(&$countUsers, $listMailingIndex)
    {
        $data = [];

        foreach ($listMailingIndex as $mailingIndex) {
            $countUsers = $countUsers + ($mailingIndex->allCustomers()->where("sending", 1)->count() ?? 0);

            $data[] = [
                "index" => [
                    "id" => $mailingIndex->index->id,
                    "code" => $mailingIndex->index->code,
                    "name" => $mailingIndex->index->name
                ],
                "send" => $this->getCountMailingIndexSend($mailingIndex->index->id, $mailingIndex->id_mail),
                "customers" => $countUsers
            ];
        }

        return $data;
    }

    public function getCountMailingIndexSend($idIndex, $idMail)
    {
        return MailingIndex::where('id_index', $idIndex)->where('id_mail', $idMail)->sum('send') ?? 0;
    }

    public function getAllMailSender(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header, $body) {
                $this->validateCustomerKey($header);
                $customer = $this->getCustomerByEncryption($header["customer-key"][0]);
                $page = 1;

                if (isset($body["pagination"])) {
                    $page = $body["pagination"];
                }

                $mailings = $customer->client->allMailing()->orderBy('id', 'desc')->paginate(6, ['*'], 'page', $page);

                $dataMail = $mailings->map(function($mail) {
                    return [
                        "id" => $mail->id,
                        "name" => $mail->name,
                        "description" => $mail->description,
                        "run_date" => $mail->run_date,
                        "preview" => $mail->preview_mail,
                        "send" => $mail->send,
                        "indexes" => $this->getAllIndexNameMail($mail->allMailingIndex)
                    ];
                });

                return [
                    'data' => $dataMail,
                    'current_page' => $mailings->currentPage(),
                    'last_page' => $mailings->lastPage(),
                    'per_page' => $mailings->perPage(),
                    'total' => $mailings->total()
                ];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getAllIndexNameMail($listMailingIndex)
    {
        $names = [];

        foreach ($listMailingIndex as $mailingIndex) {
            $names[] = $mailingIndex->index->name;
        }

        return $names;
    }

    public function createMailMasive(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header, $body) {
                $this->validateCustomerKey($header);
                $customer = $this->getCustomerByEncryption($header["customer-key"][0]);
                $this->validateBodyMail($body);
                $this->createMail($body, $customer->client);

                return [];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    /**
     * @inheritDoc
     */
    public function createMail($data, $client)
    {
        try {
            $dateProgram = date("Y-m-d H:i:s");

            if ($data["timeExecute"] == "program") {
                $dateProgram = $data["date_program"];
            }

            $newMailing = new Mailing();
            $newMailing->name = $data["name"];
            $newMailing->description = $data["description"];
            $newMailing->run_date = $dateProgram;
            $newMailing->send = 0;
            $newMailing->template = $data["mail_template"];
            $newMailing->preview_mail = $data['previewMail'];
            $newMailing->id_client = $client->id;
            $newMailing->created_at = date("Y-m-d H:i:s");
            $newMailing->updated_at = null;
            $newMailing->save();

            foreach ($data["selectedIndex"] as $index) {
                $this->createMailIndex($client->id, $index, $newMailing->id);
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function createMailIndex($idClient, $idIndex, $idMail)
    {
        try {
            $newMailingIndex = new MailingIndex();
            $newMailingIndex->send = 0;
            $newMailingIndex->id_client = $idClient;
            $newMailingIndex->id_index = $idIndex;
            $newMailingIndex->id_mail = $idMail;
            $newMailingIndex->created_at = date("Y-m-d H:i:s");
            $newMailingIndex->updated_at = null;
            $newMailingIndex->save();
            Event::dispatch(new SendMailIndex($idClient, $idIndex, $idMail, $newMailingIndex->id));
        } catch (Exception $e) {
            return null;
        }
    }

    public function getMailById($idMail)
    {
        return Mailing::find($idMail);
    }

    public function getMailIndexById($idMail)
    {
        return MailingIndex::find($idMail);
    }

    public function proccessMailingIndex($idClient, $idIndex, $idMail, $idMailingIndex)
    {
        $allCustomers = $this->getCustomersByIndex($idClient, $idIndex);
        $mail = $this->getMailById($idMail);
        $mailIndex = $this->getMailIndexById($idMailingIndex);
        $countMailSender = 0;

        if ($mail == null) {
            return;
        }

        foreach ($allCustomers as $customer) {
            $this->createMailingCustomer($idMailingIndex, $customer->id, true);
            $this->sendMailingCustomer($mail->name, $customer->email, $mail->template);
            $customer->send_mail = $customer->send_mail + 1;
            $customer->save();
            $countMailSender++;
        }

        $mailIndex->send = $mailIndex->send + $countMailSender;
        $mailIndex->updated_at = date("Y-m-d H:i:s");
        $mailIndex->save();
        $mail->send = $mail->send + $countMailSender;
        $mail->updated_at = date("Y-m-d H:i:s");
        $mail->save();
    }

    public function sendMailingCustomer($name, $to, $template)
    {
        new SendMailMasive($name, $to, $template);
    }

    public function createMailingCustomer($idMailingIndex, $idCustomer, $status)
    {
        try {
            $newMailingCustomer = new MailingCustomer();
            $newMailingCustomer->id_mailing_index = $idMailingIndex;
            $newMailingCustomer->id_website_customer = $idCustomer;
            $newMailingCustomer->sending = $status;
            $newMailingCustomer->created_at = date("Y-m-d H:i:s");
            $newMailingCustomer->updated_at = null;
            $newMailingCustomer->save();
        } catch (Exception $e) {
            return null;
        }
    }

    public function getCustomersByIndex($idClient, $idIndex)
    {
        return WebSiteCustomer::where("id_client", $idClient)->where("id_index", $idIndex)->get();
    }

    public function generatePasswordCustomer(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($body) {
                if (!isset($body["password"])) {
                    throw new Exception("Parametros no validos.");
                }

                return ["password" => $this->encryptedPawd($body["password"])];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function encryptedPawd(string $password)
    {
        return hash_hmac('sha256', $password, env('ENCRYPTION_KEY'));
    }

    private function encrypt($data)
    {
        $iv = str_repeat('0', openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', env('ENCRYPTION_KEY'), 0, $iv);
        return base64_encode($encrypted);
    }

    private function decrypt($data)
    {
        $iv = str_repeat('0', openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted_data = base64_decode($data);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', env('ENCRYPTION_KEY'), 0, $iv);
    }

    public function getAllIndex(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                $customer = $this->getCustomerByEncryption($header["customer-key"][0]);
                return $this->getAllIndexData($customer);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getInfraestructureData(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                $customer = $this->getCustomerByEncryption($header["customer-key"][0]);
                return $this->getInfraestructureDataArray($customer);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getAplicationData(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                $customer = $this->getCustomerByEncryption($header["customer-key"][0]);
                return $this->getAplicationDataArray($customer);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getMyAccountData(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                $currentCustomer = $this->getCustomerByEncryption($header["customer-key"][0]);

                return [
                    "id" => $currentCustomer->id,
                    "mail" => $currentCustomer->mail,
                    "first_name" => $currentCustomer->customerAccountInformation->first_name,
                    "last_name" => $currentCustomer->customerAccountInformation->last_name,
                    "phone_number" => $currentCustomer->customerAccountInformation->phone_number,
                    "company" => $currentCustomer->customerAccountInformation->company,
                    "status" => $currentCustomer->status
                ];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getUsersTeamData(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                $currentCustomer = $this->getCustomerByEncryption($header["customer-key"][0]);
                $data = [];

                foreach ($currentCustomer->client->allCustomers as $key => $customer) {
                    $data[] = [
                        "id" => $customer->id,
                        "mail" => $customer->mail,
                        "first_name" => $customer->customerAccountInformation->first_name,
                        "last_name" => $customer->customerAccountInformation->last_name,
                        "phone_number" => $customer->customerAccountInformation->phone_number,
                        "company" => $customer->customerAccountInformation->company,
                        "status" => $customer->status
                    ];
                }

                return $data;
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getNotificationTeamData(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                $currentCustomer = $this->getCustomerByEncryption($header["customer-key"][0]);

                return [
                    "report_day" => false,
                    "report_month" => false,
                    "alert_usage" => false,
                    "alert_billing" => false,
                    "ai" => false
                ];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getContactTeamData(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                $currentCustomer = $this->getCustomerByEncryption($header["customer-key"][0]);

                return [
                    "name_privacy" => "",
                    "phone_privacy" => "",
                    "mail_privacy" => "",
                    "mail_security" => ""
                ];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getSupportTeamData(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                $currentCustomer = $this->getCustomerByEncryption($header["customer-key"][0]);

                return [
                    "access_type" => "",
                    "period" => ""
                ];
            },
            "Proceso ejecutado exitosamente."
        );
    }

    public function getAllIndexData(CustomersAccount $customer)
    {
        $data = [];

        foreach ($customer->client->indexes as $key => $index) {
            $data[] = array(
                "id" => $index->id,
                "code" => $index->code,
                "name" => $index->name
            );
        }

        return $data;
    }

    public function getInfraestructureDataArray(CustomersAccount $customer)
    {
        $data = [];

        foreach ($customer->client->indexes as $key => $index) {
            $data[] = array(
                "code" => $index->code,
                "name" => $index->name,
                "search" => $this->convertNumber(intval($index->recentMonthHistoryQuerySearch()->count() ?? 0)),
                "record" => $this->convertNumber(intval($index->recentMonthHistoryIndex()->sum("count") ?? 0))
            );
        }

        return $data;
    }

    public function getAplicationDataArray(CustomersAccount $customer)
    {
        $data = [];

        $data[] = array(
            "app" => $customer->client->name,
            "code" => $customer->client->code,
            "index" => $customer->client->indexes()->count(),
            "search" => $this->convertNumber(intval($customer->client->recentMonthHistoryQuerySearch()->count() ?? 0)),
            "record" => $this->convertNumber(intval($customer->client->recentMonthHistoryIndex()->sum("count") ?? 0))
        );

        return $data;
    }

    public function getDashboardData(array $body, array $header = [])
    {
        return $this->executeWithValidation(
            function() use ($header) {
                $this->validateCustomerKey($header);
                $customer = $this->getCustomerByEncryption($header["customer-key"][0]);
                return $this->getDataDashboard($customer);
            },
            "Proceso ejecutado exitosamente."
        );
    }

    private function getDataDashboard(CustomersAccount $customer)
    {
        $currentClient = $customer->client;

        return [
            "query" => $this->generateStructureDataBody($currentClient->recentMonthHistoryQuerySearch()),
            "suggestion" => $this->generateStructureSuggestionBody($currentClient->recentMonthHistoryQuerySearchSuggestion()),
            "data" => $this->generateStructureDataIndexes($currentClient)
        ];
    }

    private function generateStructureDataIndexes($currentClient)
    {
        return [
            "index" => $this->getDataIndexDashboard($currentClient),
            "counter" => $this->getCounterDataRecordArray($currentClient->recentMonthHistoryIndex())
        ];
    }

    private function getDataIndexDashboard($currentClient)
    {
        $dataIndex = [];

        foreach ($currentClient->indexes as $index) {
            $dataIndex[] = [
                "code" => $index->code,
                "query" => round($index->recentMonthHistoryQuerySearch()->count()),
                "record" => round($index->recentMonthHistoryIndex()->sum("count"))
            ];
        }

        return $dataIndex;
    }

    private function generateStructureSuggestionBody($collection)
    {
        return ["counter" => $this->getCounterSuggestionDataArray($collection)];
    }

    private function generateStructureDataBody($collection)
    {
        return [
            "counter" => $this->getCounterDataArray($collection),
            "time" => $this->getTimeDataArray($collection)
        ];
    }

    private function generateDateArray()
    {
        $datesArray = [];

        for ($i = 0; $i < 30; $i++) {
            $datesArray[] = Carbon::today()->subDays($i)->toDateString();
        }

        return ["value" => 0, "label" => $datesArray, "data" => []];
    }

    private function getCounterSuggestionDataArray($collection)
    {
        $structure = $this->generateDateArray();

        foreach ($structure["label"] as $date) {
            $newCollection = clone $collection;
            $structure["data"][] = round($newCollection->whereDate("created_at", "=", $date)->count() ?? 0);
        }

        $structure["value"] = $this->convertNumber(array_sum($structure["data"]));
        return $structure;
    }

    private function getCounterDataArray($collection)
    {
        $structure = $this->generateDateArray();

        foreach ($structure["label"] as $date) {
            $newCollection = clone $collection;
            $structure["data"][] = $newCollection->whereDate("created_at", "=", $date)->count() ?? 0;
        }

        $structure["value"] = $this->convertNumber(array_sum($structure["data"]));
        return $structure;
    }

    private function getCounterDataRecordArray($collection)
    {
        $structure = $this->generateDateArray();

        foreach ($structure["label"] as $date) {
            $newCollection = clone $collection;
            $structure["data"][] = round($newCollection->whereDate("created_at", "=", $date)->sum("count") ?? 0);
        }

        $structure["value"] = $this->convertNumber(array_sum($structure["data"]));
        return $structure;
    }

    private function getTimeDataArray($collection)
    {
        $structure = $this->generateDateArray();

        foreach ($structure["label"] as $date) {
            $newCollection = clone $collection;
            $structure["data"][] = round($newCollection->whereDate("created_at", "=", $date)->avg("time_execution") ?? 0);
        }

        $structure["value"] = round(array_sum($structure["data"]) / count($structure["data"]));
        return $structure;
    }

    private function convertNumber($number)
    {
        if ($number < 1000) {
            return $number;
        } elseif ($number < 1000000) {
            return round($number / 1000, 1) . 'K';
        } else {
            return round($number / 1000000, 1) . 'M';
        }
    }
}
