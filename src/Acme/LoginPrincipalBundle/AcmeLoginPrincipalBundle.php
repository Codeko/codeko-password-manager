<?php

namespace Acme\LoginPrincipalBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeLoginPrincipalBundle extends Bundle {
    
    public function getParent() {
        return 'ApplicationSonataUserBundle';
    }

}
