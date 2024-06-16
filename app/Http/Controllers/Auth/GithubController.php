<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Helpers\Account\Customer;
use Exception;
use Illuminate\Http\Request;

class GithubController extends Controller
{
    /**
     * @var Customer
     */
    protected $customer;

    /**
     * Constructor Auth PasswordResetController
     */
    public function __construct(Customer $customer) {
        $this->customer = $customer;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        try {
            $githubUser = Socialite::driver('github')->stateless()->user();
            dd($githubUser);
            $customerAccount = $this->customer->getCustomerByMail($githubUser->getEmail());

            if ($customerAccount == null) {
                return redirect('/login')->with('error-danger', "El email ".$githubUser->getEmail()." no se encuentra asociado a una cuenta.");
            }

            $customerAccount->first_name = $githubUser->getName();
            $customerAccount->github_id = $githubUser->getId();
            $customerAccount->avatar = $githubUser->getAvatar();
            $customerAccount->token = $githubUser->token;
            $customerAccount->github_nickname = $githubUser->getNickname();
            $customerAccount->save();
        } catch (Exception $e) {
            print_r(['error' => $e->getMessage()]);
            //return redirect('/login')->with('error', 'No se pudo autenticar con GitHub. Error: ' . $e->getMessage());
        }
    }
}