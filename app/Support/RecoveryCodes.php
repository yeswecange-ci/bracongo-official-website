<?php

namespace App\Support;

class RecoveryCodes
{
    /**
     * @return list<string>
     */
    public static function generatePlain(int $count = 8): array
    {
        $codes = [];
        for ($i = 0; $i < $count; $i++) {
            $codes[] = sprintf(
                '%s-%s',
                strtoupper(substr(bin2hex(random_bytes(5)), 0, 5)),
                strtoupper(substr(bin2hex(random_bytes(5)), 0, 5))
            );
        }

        return $codes;
    }

    /**
     * @param  list<string>  $plainCodes
     * @return list<string>
     */
    public static function hash(array $plainCodes): array
    {
        return array_values(array_map(
            fn (string $c) => password_hash($c, PASSWORD_BCRYPT),
            $plainCodes
        ));
    }

    /**
     * @param  list<string>  $hashes
     * @return array{0: bool, 1: list<string>}
     */
    public static function verifyAndConsume(string $input, array $hashes): array
    {
        $normalized = strtoupper(str_replace(' ', '', trim($input)));
        if (! str_contains($normalized, '-') && strlen($normalized) === 10) {
            $normalized = substr($normalized, 0, 5).'-'.substr($normalized, 5, 5);
        }
        foreach ($hashes as $i => $hash) {
            if (password_verify($normalized, $hash)) {
                unset($hashes[$i]);

                return [true, array_values($hashes)];
            }
        }

        return [false, $hashes];
    }
}
