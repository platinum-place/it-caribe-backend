<?php

namespace Modules\Common\Domain\ValueObjects;

class DocumentSigned
{
    public function __construct(
        public string    $path {
            get {
                return $this->path;
            }
        },
        public string $content {
            get {
                return $this->content;
            }
        },
    )
    {
    }
}
