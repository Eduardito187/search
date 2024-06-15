<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Helpers\Account\Customer;

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
    public function handleProviderCallback()
    {
        $githubUser = Socialite::driver('github')->user();
        /*
customer_account_information =>
id
id_customers_account
first_name
last_name
phone_number
company
created_at
updated_at

customer_accoun =>
id
id_client
mail
password
status
created_at
updated_at
github_id
avatar
github_nickname
token
        $user = CustomersAccount::updateOrCreate(
            ['email' => $githubUser->getEmail()],
            [
                'name' => $githubUser->getName(),
                'github_id' => $githubUser->getId(),
                'avatar' => $githubUser->getAvatar(),
                'token' => $githubUser->token,
                'github_nickname' => $githubUser->getNickname()
            ]
        );
*/
        return redirect()->intended('/home');
    }
}