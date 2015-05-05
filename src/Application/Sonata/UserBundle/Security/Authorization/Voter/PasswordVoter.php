<?php

namespace Application\Sonata\UserBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class PasswordVoter implements VoterInterface {

    public function supportsAttribute($attribute) {
        return 'ROLE_EDITAR_PASSWORD' == $attribute;
    }

    public function supportsClass($class) {
        return true;
    }

    public function vote(TokenInterface $token, $object, array $attributes) {
        
        $vote = VoterInterface::ACCESS_ABSTAIN;
        
        foreach ($attributes as $attribute) {
            if (false === $this->supportsAttribute($attribute)) {
                continue;
            }
            $user = $token->getUser();  
            $idpassword = $object->getId();
            
            $vote = VoterInterface::ACCESS_DENIED;

            if (!$user->isSuperAdmin()){

                // comprobar que la PASSWORD que se edita fue publicada por mismo usuario
                /* @var $idpassword type */
                if ($idpassword != $user->getId()) {
                    $vote = VoterInterface::ACCESS_DENIED;
                    throw new \InvalidArgumentException(
                            'No eres el propietario'
                        );
                }
                
            }
        } 
        
        return $vote;
    }

}
