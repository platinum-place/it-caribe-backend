<?php

namespace Modules\Common\Domain\Contracts;

interface SignManagerInterface
{
    public function sign(string $certPath, string $certPassword, string $documentContent, string $storagePath): string;
}
