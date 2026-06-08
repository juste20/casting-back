<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Str;

class AntiFraudService
{
    private const DISPOSABLE_DOMAINS = [
        'mailinator.com', 'guerrillamail.com', 'tempmail.com', '10minutemail.com',
        'throwaway.email', 'yopmail.com', 'trashmail.com', 'sharklasers.com',
        'burnermail.io', 'inboxbear.com', 'temp-mail.org', 'getnada.com',
        'maildrop.cc', 'mohmal.com', 'emailnator.com', 'tempmail.net',
    ];

    private const BOT_USER_AGENTS = [
        'curl', 'wget', 'python-requests', 'go-http-client', 'scrapy',
        'java/', 'libwww', 'nikto', 'sqlmap', 'nmap', 'masscan',
    ];

    private const PROXY_HEADERS = [
        'HTTP_X_FORWARDED_FOR', 'HTTP_X_REAL_IP', 'HTTP_CF_CONNECTING_IP',
        'HTTP_X_FORWARDED', 'HTTP_FORWARDED', 'HTTP_CLIENT_IP',
    ];

    public function __construct(
        private readonly RateLimiter $limiter
    ) {}

    public function check(Request $request): array
    {
        $issues = [];

        if ($violation = $this->checkIpReputation($request)) {
            $issues[] = $violation;
        }

        if ($violation = $this->checkUserAgent($request)) {
            $issues[] = $violation;
        }

        if ($violation = $this->checkEmailDisposable($request)) {
            $issues[] = $violation;
        }

        if ($violation = $this->checkRateLimit($request)) {
            $issues[] = $violation;
        }

        if ($violation = $this->checkHoneypot($request)) {
            $issues[] = $violation;
        }

        return $issues;
    }

    public function isFraudulent(Request $request): bool
    {
        return !empty($this->check($request));
    }

    private function checkIpReputation(Request $request): ?string
    {
        $ip = $request->ip();

        $ipKey = 'fraud_ip_' . $ip;
        if ($this->limiter->tooManyAttempts($ipKey, 50)) {
            return 'IP bannie pour cause d\'activité suspecte.';
        }

        foreach (self::PROXY_HEADERS as $header) {
            if (!empty($_SERVER[$header]) && $_SERVER[$header] !== $ip) {
                $this->limiter->hit('fraud_proxy_' . $ip, 3600);
                return 'Requête via proxy/VPN détectée.';
            }
        }

        return null;
    }

    private function checkUserAgent(Request $request): ?string
    {
        $ua = strtolower($request->userAgent() ?? '');

        if (empty($ua)) {
            return 'User-Agent manquant.';
        }

        foreach (self::BOT_USER_AGENTS as $bot) {
            if (Str::contains($ua, $bot)) {
                return 'User-Agent suspect : ' . $bot;
            }
        }

        return null;
    }

    private function checkEmailDisposable(Request $request): ?string
    {
        $email = $request->input('email');
        if (!$email) {
            return null;
        }

        $domain = strtolower(substr(strrchr($email, '@'), 1));

        if (in_array($domain, self::DISPOSABLE_DOMAINS)) {
            return 'Les emails jetables ne sont pas autorisés.';
        }

        $emailKey = 'fraud_email_' . sha1($email);
        $attempts = $this->limiter->attempts($emailKey);
        if ($attempts > 3) {
            return 'Trop de tentatives avec cet email.';
        }

        return null;
    }

    private function checkRateLimit(Request $request): ?string
    {
        $ipKey = 'fraud_' . $request->ip();

        if ($this->limiter->tooManyAttempts($ipKey, 20)) {
            return 'Trop de requêtes. Activité suspecte.';
        }

        $this->limiter->hit($ipKey, 60);

        return null;
    }

    private function checkHoneypot(Request $request): ?string
    {
        $honeypot = $request->input('website');
        if (!empty($honeypot)) {
            return 'Bot détecté (honeypot).';
        }

        $timestamp = $request->input('_timestamp');
        if ($timestamp && (time() - (int)$timestamp < 2)) {
            return 'Soumission trop rapide (bot).';
        }

        return null;
    }
}
