<?php
/**
 * This Middleware checks to see if the url is currently a sub-domain,
 * and then gets the whitelabel community information if it's a
 * valid subdomain.
 *
 * If the subdomain is valid, we add that community info to an object
 * called $request->valid_whitelabel, which is available in the blades and
 * and available to any controller method as long as the Request $request
 * is passed as a controller method parameter.
 *
 * PHP version 5.5.9
 *
 * @package AnyShare
 * @version v1.0
 */
namespace App\Http\Middleware;

use Closure;
use App\Account;
use Log;
use Route;
use Redirect;

 function extract_domain($domain)
{
    if(preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", $domain, $matches))
    {
        return $matches['domain'];
    } else {
        return $domain;
    }
}

 function extract_subdomains($domain)
{
    $subdomains = $domain;
    $domain = extract_domain($subdomains);
    $subdomains = rtrim(strstr($subdomains, $domain, true), '.');
    return $subdomains;
}


class SubdomainMiddleware
{
    /**
     * Check if the whitelabel group is valid
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */


    public function handle($request, Closure $next)
    {

        $parsed_app_url = parse_url(config('app.url'));
        $parsed_request_url = parse_url($request->url());

        $app_domain = extract_domain($parsed_app_url['host']);
        $request_domain = extract_domain($parsed_request_url['host']);

        $app_subdomain = extract_subdomains($parsed_app_url['host']);
        $request_subdomain = extract_subdomains($parsed_request_url['host']);

        // Check for regular subdomain
        if ($app_domain != $request_domain) {
            \Log::debug($request_domain.' != '.$app_domain);
            $account = Account::where('custom_domain', $parsed_request_url['host'])->whereNotNull('custom_domain')->first();
        } elseif ($request_subdomain!='') {
            $account = Account::where('subdomain', $request_subdomain)
                ->whereNotNull('subdomain')->first();
        }


        if (isset($account)) {
            session(['account_id' => $account->id]);
            $request->current_account = $account;
            view()->share('current_account', $account);
            return $next($request);
        }

        return $next($request);



    }
}
