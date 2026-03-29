<?php

namespace App\Services;

use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use PragmaRX\Google2FA\Google2FA;

class GoogleTwoFactorService
{
    public function __construct(
        private Google2FA $google2fa
    ) {}

    public function generateSecret(): string
    {
        return $this->google2fa->generateSecretKey();
    }

    public function verify(string $secret, string $code): bool
    {
        $code = preg_replace('/\s+/', '', $code);

        return strlen($code) === 6 && ctype_digit($code)
            && $this->google2fa->verifyKey($secret, $code);
    }

    public function qrCodeSvg(string $email, #[\SensitiveParameter] string $secret): string
    {
        $url = $this->google2fa->getQRCodeUrl(config('app.name'), $email, $secret);
        $writer = new Writer(new ImageRenderer(
            new RendererStyle(210, 2),
            new SvgImageBackEnd
        ));

        return $writer->writeString($url);
    }
}
