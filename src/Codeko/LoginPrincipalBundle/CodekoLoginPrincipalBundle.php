<?php

namespace Codeko\LoginPrincipalBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CodekoLoginPrincipalBundle extends Bundle {
    
    public function getParent() {
        return 'ApplicationSonataUserBundle';
    }

}
