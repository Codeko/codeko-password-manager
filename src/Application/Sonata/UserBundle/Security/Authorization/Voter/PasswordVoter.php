<?php

namespace Application\Sonata\UserBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class PasswordVoter implements VoterInterface {

    const VER = 'ROLE_MOSTRAR_PASSWORD';
    const EDITAR = 'ROLE_EDITAR_PASSWORD';

    public function supportsAttribute($attribute) {
//        return 'ROLE_EDITAR_PASSWORD' == $attribute;
        return in_array($attribute, array(
            self::VER,
            self::EDITAR,
        ));
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

            $vote = VoterInterface::ACCESS_DENIED;
            
            if ($attribute === 'ROLE_EDITAR_PASSWORD') {
                $user = $token->getUser();
                $idpasswordPropietario = $object->getId();
                
                if (!$user->isSuperAdmin()) {

                    // comprobar que la PASSWORD que se edita fue publicada por mismo usuario
                    /* @var $idpassword type */
                    if ($idpasswordPropietario != $user->getId()) {
                        $vote = VoterInterface::ACCESS_DENIED;
                        throw new \InvalidArgumentException(
                        'No eres el propietario'
                        );
                    }
                }
                
            }
        }

        return $vote;
    }

}
